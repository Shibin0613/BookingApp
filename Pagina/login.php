<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login.html</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<style>
    /* login pagina */

    .gradient-custom-2 {
        /* fallback for old browsers */
        background: #fccb90;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
    }

    @media (min-width: 768px) {
        .gradient-form {
            height: 100vh !important;
        }
    }

    @media (min-width: 769px) {
        .gradient-custom-2 {
            border-top-right-radius: .3rem;
            border-bottom-right-radius: .3rem;
        }
    }
</style>

<body>
    <form method="post" action="">
        <section class="h-100 gradient-form" style="background-color: #eee;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-xl-10">
                        <div class="card rounded-3 text-black">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="card-body p-md-5 mx-md-4">

                                        <div class="text-center">
                                            <h4 class="mt-1 mb-5 pb-1">booking.com</h4>
                                        </div>

                                        <form>
                                            <p>Log hier in</p>

                                            <div class="form-outline mb-4">
                                            <label class="form-label" for="form3Example3">Email</label>
                                            <input type="email" name="email" class="form-control form-control-lg" placeholder="Uw emailadres" />    
                                            </div>

                                            <div class="form-outline mb-4">
                                            <label class="form-label" for="form3Example4">wachtwoord</label>
                                            <input type="password" name="wachtwoord" class="form-control form-control-lg" placeholder="Uw wachtwoord" />    
                                            </div>

                                            <div class="text-center pt-1 mb-5 pb-1">
                                                <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" input type="submit" id="submit"> Log
                                                    in</button>
                                            </div>


                                        </form>

                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                    <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                        <h4 class="mb-4">Welkom terug</h4>
                                        <p class="big mb-0"><a href="accommodatieoverzicht.php">Terug naar accommodatieoverzicht</a></p>
                                    </div>
    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </section>
</body>

</html>


<?php
include "../Classes/AdminClass.php";
require_once "../vendor/autoload.php";

use Controllers\DB;

DB::connect();
if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST['email'] !== null && $_POST['wachtwoord'] !== null) {

    $user = DB::select('admin', ['email' => $_POST['email'], 'password' => $_POST['wachtwoord']], 'Admin');

    if ($user) {
        session_start();
        $_SESSION['userId'] = $user[0]->id;
        header("location:planbord.php");
        exit;
    } else {
        echo '<script>alert("uw inlog gegevens kloppen niet.")</script>';
    }
}


?>