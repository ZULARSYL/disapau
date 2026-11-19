$(function() {
  $("#defaultdtables").DataTable({
    "bPaginate": true,
    "bLengthChange": false,
    "bFilter": true,
    "bInfo": false,
    "bAutoWidth": true
  });
});

if ('serviceWorker' in navigator) {
  window.addEventListener('load',function(){
    navigator.serviceWorker.register("http://localhost/ppk/serviceworker.js").then(function(registration){
      console.log('Service worker registration successful with scope:', registration.scope);
    }, function(err){
      console.log('service worker registration failed : ',err);
    });
  });
}

// document.addEventListener('DOMContentLoaded', init, false);

// function init() {
//     if ('serviceWorker' in navigator && navigator.onLine) {
//         navigator.serviceWorker.register('http://localhost/disapuppk/serviceworker.js')
//         .then((reg) => {
//             console.log('Registrasi service worker Berhasil', reg);
//         }, (err) => {
//             console.error('Registrasi service worker Gagal', err);
//         });
//     }
// }