<?php
$currentUrl = $_GET['url'] ?? '';
$urlSegments = explode('/', trim($currentUrl, '/'));
$lastvalue = $urlSegments[0] ?? '';
?>
<nav class="fixed-bottom" style="z-index:1030;">
  <div class="container-fluid px-0">
    <div class="bottom-nav d-flex justify-content-around align-items-center" style="background:var(--dark);border-radius:16px 16px 0 0;padding:10px 0 12px;box-shadow:0 -2px 12px rgba(0,0,0,0.08);">

      <a href="<?= BASEURL; ?>" class="bottom-nav-item text-center text-decoration-none <?= ($lastvalue == 'Home' || $lastvalue == '') ? 'active' : ''; ?>">
        <i class="bi bi-house-door" style="font-size:1.3rem;"></i>
        <span>Home</span>
      </a>

      <a href="<?= BASEURL; ?>Shop" class="bottom-nav-item text-center text-decoration-none <?= ($lastvalue == 'Shop') ? 'active' : ''; ?>">
        <i class="bi bi-shop" style="font-size:1.3rem;"></i>
        <span>Shop</span>
      </a>

      <a href="<?= BASEURL; ?>Setor" class="bottom-nav-item text-center text-decoration-none <?= ($lastvalue == 'Setor') ? 'active' : ''; ?>">
        <i class="bi bi-box-arrow-in-down" style="font-size:1.3rem;"></i>
        <span>Setor</span>
      </a>

      <a href="<?= BASEURL; ?>Profile" class="bottom-nav-item text-center text-decoration-none <?= ($lastvalue == 'Profile') ? 'active' : ''; ?>">
        <i class="bi bi-person" style="font-size:1.3rem;"></i>
        <span>Profil</span>
      </a>

    </div>
  </div>
</nav>

<style>
.bottom-nav-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 2px;
  color: var(--gray-500);
  transition: var(--transition);
  padding: 4px 16px;
  border-radius: 10px;
}
.bottom-nav-item span {
  font-size: 0.65rem;
  font-weight: 500;
  letter-spacing: 0.02em;
}
.bottom-nav-item.active {
  color: var(--primary-lighter);
}
.bottom-nav-item:hover {
  color: var(--primary-lighter);
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-2.1.0/datatables.min.js"></script>
<script src="<?= BASEURL . "main.js"; ?>"></script>
</body>

</html>
