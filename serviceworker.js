var CACHE_NAME = 'disapu.v1';
var urlsToCache = [
  '/',
  'http://localhost/disapuppk/serviceworker.js',
  'http://localhost/disapuppk/manifest.json',
  'http://localhost/disapuppk/assets/img/icon/icon32x32.png',
  'http://localhost/disapuppk/assets/img/icon/icon64x64.png',
  'http://localhost/disapuppk/assets/img/icon/icon256x256.png',
  'http://localhost/disapuppk/assets/img/icon/icon512x512.png'
];

self.addEventListener('install', function(event) {
  event.waitUntil(
      caches.open(CACHE_NAME)
      .then(function(cache) {
          return cache.addAll(urlsToCache)
      })
      .then(self.skipWaiting())
  )
});

self.addEventListener('fetch', function(event) {
  event.respondWith(
      fetch(event.request)
      .catch(() => {
          return caches.open(CACHE_NAME)
          .then((cache) => {
              return cache.match(event.request)
          })
      })
  )
});

self.addEventListener('activate', function(event) {
  event.waitUntil(
      caches.keys()
      .then((keyList) => {
          return Promise.all(keyList.map((key) => {
          if (key !== CACHE_NAME) {
              console.log('[ServiceWorker] Hapus cache lama', key)
              return caches.delete(key)
          }
          }))
      })
      .then(() => self.clients.claim())
  )
});