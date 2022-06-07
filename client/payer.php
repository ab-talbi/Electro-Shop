<?php

    @session_start();
    include('../includes/connect.php');
    include('../fonctions/fonctions.php');
    $adresse_ip = getIPAddress();
    $select_utilisateur = $con->query("SELECT * FROM `utilisateurs` WHERE ip_utilisateur like '$adresse_ip'");
    $id_utilisateur = ($select_utilisateur->fetch(PDO::FETCH_OBJ))->id_utilisateur;


    $montant = number_format($_SESSION['total'],2)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electro Shop - Payer</title>
</head>
<body>
    <div class="container">
        <div class="row mt-3 mb-3">
            <h2>Vous avez <strong style='color:red'><?php echo $_SESSION['total'] * 9.8 .' MAD' ?></strong> à payer, Choisir le mode de payement pour completer la commande</h2>
        </div>
    </div>
    <div class="container">
        <div class="row mt-3 mb-3">
            <div id="paypal-button-container" class="col-sm-12 col-lg-6"></div>
            <div class="col-sm-12 col-lg-6 m-auto"><a href="./les_commandes.php?id_utilisateur=<?php echo $id_utilisateur ?>">
            <button id="offline" class="rounded-pill w-100 pt-3 pb-2 mb-1"><strong>Après Livraison</strong></button>
            </a></div>
        </div>
    </div>
    
    <!-- paypal script  SMAIL-->
    <!-- <script src="https://www.paypal.com/sdk/js?client-id=AfaLemrF5KCyRixbyUz3rVNbI09pS1cSEKeCKgPjqVccV_YyFECFcujBTQkABa_nHcKBAO9squeZb7eq&disable-funding=card"></script> -->

    <!-- paypal script  AYOUB-->
    <script src="https://www.paypal.com/sdk/js?client-id=AYFLwtsdN8wZS45-S4grGpbW7J8vXRA3CF8EwLy89wVYcujbGLNx7wf3iL1MB1cHVr3QQsPy-yiWw_Yx&disable-funding=card"></script>

    <script>

        
paypal.Buttons({
    style:{
        color:'blue',
        shape:'pill'
    },
    createOrder: function(data,actions){
        return actions.order.create({
            purchase_units:[{
                amount:{
                    value:'<?php echo $montant; ?>'
                }
            }]
        });
    },
    onApprove: function(data,actions){
        return actions.order.capture().then(function(details){
        //    console.log(details);
            alert("Payment effectuée par "+ details.payer.name.given_name);
            window.location.replace("/Electro-Shop/client/verifier_mzn_avec_paypal.php?mode=paypal&id=<?php echo $id_utilisateur ?>")
        })
    },
    onCancel: function(data){
        alert("Un Problème se produite au niveau de paiement");
        window.location.replace("/Electro-Shop/carte.php")
    }
}).render('#paypal-button-container')

    </script>

</body>
</html>