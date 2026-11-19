<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= DESKRIPSI; ?>">
    <meta name="keywords" content="<?= KEYWORD; ?>">
    <meta name="author" content="hdev.web.id">
    <link rel="icon" href="<?= BASEURL; ?>assets/img/icon/icon32x32.png" type="image/png" />
    <link rel="shortcut icon" href="<?= BASEURL; ?>assets/img/icon/icon32x32.png" type="image/png"/>
    <link rel="manifest" href="<?= BASEURL."web.manifest"; ?>">
    <title><?= TITLE; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.3/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.3/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
      * { font-family: "Inter", sans-serif; -webkit-font-smoothing: antialiased; }
    </style>
  </head>
  <body style="background-color:#f7fafc;">
    <script>
      $(function(){
        $("#form_login").on("submit", function(e) {
          var data_form = $("#form_login").serialize();
          console.log(data_form);
          e.preventDefault();
          if($('input', this).val().trim() == ''){
            console.log("");
          }else{
            $.ajax({
              url: '<?= BASEURL; ?>login/checkLogin',
              type: 'post',
              data: data_form,
              dataType: "json",
              success: function(r) {
                console.log(r.respons);
                if(r.respons=="200"){
                  swal.fire({
                    icon: "success",
                    text: r.notif,
                    timer: 2000,
                    showCancelButton: false,
                    showConfirmButton: false
                  })
                  setTimeout(function(){ location.reload(); }, 2000);
                }else{
                  swal.fire({
                    icon: "warning",
                    text: r.notif,
                    timer: 2000,
                    showCancelButton: false,
                    showConfirmButton: false
                  })
                }
              }
            });
          }
        });
      });
    </script>

    <div class="min-vh-100 d-flex align-items-center justify-content-center py-5 px-3">
      <div class="w-100" style="max-width:420px;">
        <!-- Logo & Brand -->
        <div class="text-center mb-4">
          <img src="<?=BASEURL;?>assets/img/logo.png" alt="Logo" style="height:56px;" class="mb-3">
          <h4 class="fw-bold mb-1" style="color:#2d3748;">Disapu</h4>
          <p class="text-muted" style="font-size:0.9rem;">Digital Sampah Purworejo</p>
        </div>

        <!-- Login Card -->
        <div class="card border-0" style="border-radius:16px;box-shadow:0 4px 24px rgba(0,0,0,0.06);">
          <div class="card-body p-4">
            <h5 class="fw-semibold mb-1" style="color:#2d3748;">Masuk</h5>
            <p class="text-muted mb-4" style="font-size:0.85rem;">Masuk ke akun Anda untuk melanjutkan</p>

            <form id="form_login" onsubmit="return false">
              <input type="hidden" name="inputtoken" id="inputtoken" value="<?= $data['token_screetkey']; ?>">

              <div class="mb-3">
                <label class="form-label fw-medium" style="font-size:0.85rem;color:#2d3748;" for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" style="border:1.5px solid #cbd5e0;border-radius:10px;padding:11px 14px;font-size:0.9rem;" placeholder="Masukkan username" required/>
              </div>

              <div class="mb-4">
                <label class="form-label fw-medium" style="font-size:0.85rem;color:#2d3748;" for="password">Password</label>
                <input type="password" id="form2Example27" name="password" class="form-control" style="border:1.5px solid #cbd5e0;border-radius:10px;padding:11px 14px;font-size:0.9rem;" placeholder="Masukkan password" required/>
              </div>

              <button class="btn w-100 text-white fw-semibold" type="submit" name="proses" id="proses" style="background:linear-gradient(135deg,#2d6a4f,#40916c);border:none;border-radius:10px;padding:12px;font-size:0.95rem;transition:all 0.2s;">
                Masuk
              </button>
            </form>

            <div class="text-center mt-3">
              <a href="<?= BASEURL; ?>" class="text-decoration-none" style="color:#2d6a4f;font-size:0.85rem;font-weight:500;">
                <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
              </a>
            </div>
          </div>
        </div>

        <p class="text-center text-muted mt-4" style="font-size:0.75rem;">&copy; <?= date('Y'); ?> Disapu. All rights reserved.</p>
      </div>
    </div>
  </body>
</html>
