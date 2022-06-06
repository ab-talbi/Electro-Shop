<?php 
    session_start();
    include('./includes/connect.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification du compte</title>
    <!-- google font -->
    <link href='https://fonts.googleapis.com/css?family=Alice' rel='stylesheet'>

    <!-- bootstrap-css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- sweetalert2 -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.all.min.js"></script>
   
    <!-- css file -->
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
</head>
<body>
<main class="login-form mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-light">Verifier Votre Compte</div>
                    <div class="card-body">
                        <form action="" method="POST" class='mr-0 mt-4 text-right m-auto'>

                            <div class="form-group row mb-3">
                                <label for="code" class="col-md-4 col-form-label text-md-right">Code de Verfication</label>
                                <div class="col-md-6 text-right">
                                    <input type="text" id="code" class="text-right form-control" name="otp_code" required autofocus placeholder='Le code que vous avez recu via email'>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4 text-center">
                                <input class='ml-3 btn btn-success' style='width:93%' type="submit" value="Verifier le compte" name="verifie_compte">
                            </div>
                    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>



<?php 
    
    if(isset($_POST["verifie_compte"])){
        $otp = $_SESSION['otp'];
        $email = $_SESSION['mail'];
        $otp_code = $_POST['otp_code'];

        if($otp != $otp_code){

            echo "<script>Swal.fire({position: 'center',
                icon: 'error',
                title: 'Le code de verification est incorrecte',
                showConfirmButton: true});
                </script>";

        }else{


            $modifier_utilisateur = "UPDATE utilisateurs SET verifie=:verifie WHERE email_utilisateur=:email_utilisateur";
            $modifier= $con->prepare($modifier_utilisateur);
            $modifier->execute(array('verifie' => 1,'email_utilisateur' => $email));
            session_destroy();
           

            echo "<script>Swal.fire({position: 'center',
                icon: 'success',
                title: 'Vous avez verifier votre email avec succes, Vous pouver se connecter',
                showConfirmButton: true}).then((result) => {
                            if (result.isConfirmed) {
                    Swal.fire(
                            window.open('./login.php','_self')
                            )
                                }else{
                    window.open('./login.php','_self')
                }
            });</script>";
        }

    }

?>



    <!-- bootstrap-JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>