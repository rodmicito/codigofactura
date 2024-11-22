<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Facturación - Acceso</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url ?>Assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url ?>Assets/css/googlecss.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url ?>Assets/css/sb-admin-2.min.css" rel="stylesheet" type="text/css">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img class="img-profile rounded-circle" src="<?= base_url ?>Assets/img/undraw_profile.svg">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Acceder al sistema</h1>
                                    </div>
                                    <form id="frmLogin" class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="nick" name="nick" placeholder="Nick de usuario">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="clave" name="clave" placeholder="Clave de usuario">
                                        </div>
                                        <div id="alerta" class="alert alert-danger d-none" role="alert">
                                        </div>
                                        <button type="submit" onclick="frmLogin(event)" class="btn btn-primary btn-user btn-block">
                                            Ingresar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url ?>Assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url ?>Assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url ?>Assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url ?>Assets/js/sb-admin-2.min.js"></script>
    <script>
        const base_url = "<?= base_url ?>"
    </script>
    <script src="<?= base_url ?>Assets/js/login.js"></script>

</body>

</html>