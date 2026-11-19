<!DOCTYPE html>
<html lang="en">
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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <!-- Sweet Alert CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.3/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- sweet alert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.3/dist/sweetalert2.all.min.js"></script>
    <!-- JQuery JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  </head>
  <body>
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
    <section class="vh-100" style="background-color: #e3e5d8">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-xl-10">
            <div class="card" style="border-radius: 1rem">
              <div class="row g-0">
                <div class="col-md-6 col-lg-5 d-none d-md-block">
                  <img src="<?=BASEURL;?>assets/img/Logo Utama.png" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem"/>
                </div>
                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                  <div class="card-body p-4 p-lg-5 text-black">
                    <form class="form-horizontal" id="form_login" onsubmit="return false">
                      <div class="d-flex align-items-center mb-3 pb-1">
                        <img src="<?=BASEURL;?>assets/img/wiga.png" alt="Logo Wiga" width="50px" class="me-3"/>
                        <span class="h1 fw-bold mb-0">Disapu</span>
                      </div>
                      <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px">Masuk Ke Akun Anda</h5>
                      <div data-mdb-input-init class="form-outline mb-4">
                        <input type="hidden" name="inputtoken" id="inputtoken" value="<?= $data['token_screetkey']; ?>">
                        <input type="text" id="username" name="username" class="form-control form-control-lg" required/>
                        <label class="form-label" for="form2Example17">Username</label>
                      </div>
                      <div data-mdb-input-init class="form-outline mb-4">
                        <input type="password" id="form2Example27" class="form-control form-control-lg" name="password" required/>
                        <label class="form-label" for="form2Example27">Password</label>
                      </div>
                      <div class="pt-1 mb-4">
                        <button class="btn btn-dark btn-lg btn-block" type="submit" name="proses" id="proses">Login</button> 
                      </div>
                    </form>
                    <a href="<?= BASEURL; ?>">Go Back</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
