<?php

	include('../includes/connect.php');
	include('../fonctions/fonctions.php');
	session_start();
	if(!isset($_SESSION['nom_utilisateur'])){
		header("Location: login.php");
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Electro Shop</title>

    
    <!-- bootstrap-css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
	<!-- sweetalert2 -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.all.min.js"></script>

    <!-- css file -->
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
</head>
<body>

    <header class="header" style="width:100%; height:80px; position:fixed">
		<h2 class="u-name">Electro <b>Shop</b>
			<label for="checkbox">
				<i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
			</label>
			<input type="checkbox" id="checkbox">
		</h2>
		<a href="" class="nav-link">Bienvenue <?php echo $_SESSION['nom_utilisateur']?></a>
		<a href='./logout.php' class='nav-link'><i class='fa fa-power-off' aria-hidden='true'></i></a>
	</header>
	
	
	<div class="container p-0 m-0 " >
		<div class="row">
			<div class="body col-lg-3 col-sm-12">
				<nav class="side-bar" style="margin-top:80px;overflow-y:scroll; height:100%; position:fixed">
					<div id="user-p">
						<?php
							if(isset($_SESSION['id_utilisateur'])){
								getProfilImage($_SESSION['id_utilisateur']);
							}else{
								getProfilImage(0);
							}
                		?>
						<h4><?php echo $_SESSION['nom_utilisateur']?></h4>
					</div>
					<ul>
						<li>
							<a href="index.php?dashboard">
								<i class="fa fa-desktop" aria-hidden="true"></i>
								<span>Dashboard</span>
							</a>
						</li>
						<li>
							<a href="./index.php?ajouter_produit">
								<i class="fa-solid fa-circle-plus" aria-hidden="true"></i>
								<span>Ajouter Produits</span>
							</a>
						</li>
						<li>
							<a href="index.php?liste_produits">
								<i class="fa-brands fa-product-hunt" aria-hidden="true"></i>
								<span>Produits</span>
							</a>
						</li>
						<li>
							<a href="./index.php?ajouter_categories">
								<i class="fa-solid fa-circle-plus" aria-hidden="true"></i>
								<span>Ajouter Catégories </span>
							</a>
						</li>
						<li>
							<a href="index.php?liste_categories">
								<i class="fa-solid fa-list" aria-hidden="true"></i>
								<span>Catégories</span>
							</a>
						</li>
						<li>
							<a href="./index.php?ajouter_marques">
								<i class="fa-solid fa-circle-plus" aria-hidden="true"></i>
								<span>Ajouter Marques </span>
							</a>
						</li>
						<li>
							<a href="index.php?liste_marques">
								<i class="fa-solid fa-list" aria-hidden="true"></i>
								<span>Marques</span>
							</a>
						</li>
						<li>
							<a href="./index.php?liste_utilisateurs">
								<i class="fa-solid fa-users" aria-hidden="true"></i>
								<span>Les Utilisateurs</span>
							</a>
						</li>
						<li>
							<a href="./index.php?liste_commandes">
								<i class="fa-solid fa-cart-plus" aria-hidden="true"></i>
								<span>Les Commandes</span>
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-cog" aria-hidden="true"></i>
								<span>Modifier vos Données</span>
							</a>
						</li>
						<li>
							<a href="./logout.php">
								<i class="fa fa-power-off" aria-hidden="true"></i>
								<span>Déconnexion</span>
							</a>
						</li>
						
					</ul>
					<div style="height:60px"></div>
				</nav>
			</div>
<<<<<<< HEAD
			<div class="col-lg-9" style="margin-top:62px">


				<!-- Dashboar -->
				<?php
					if(isset($_GET['dashboard'])){
				?>
						<div class="row pt-4 d-flex flex-row justify-content-around text-center">
							<!-- Produit -->
							<div class="col-3 m-3" style="width:200px; height:200px;">
								<div style="border-bottom: #000318 solid 2px; background-color:red;"><strong class="fs-2" >Produits</strong><br/>
					</div><?php
									getStatistique("produits");
								?>
							</div>

							<!-- utilisateurs -->
							<div class="col-3 m-3" style="width:200px; height:200px;">
								<div style="border-bottom: #000318 solid 2px; background-color:red;"><strong class="fs-2" >Clients</strong><br/>
					</div><?php
									getStatistique("utilisateurs");
								?>
							</div>

							<!-- commande -->
							<div class="col-3 m-3" style="width:200px; height:200px;">
								<div style="border-bottom: #000318 solid 2px; background-color:red;"><strong class="fs-3" >Commandes</strong><br/>
					</div><?php
									getStatistique("commande");
								?>
							</div>

							<!-- marques -->
							<div class="col-3 m-3" style="width:200px; height:200px;">
								<div style="border-bottom: #000318 solid 2px; background-color:red;"><strong class="fs-2" >Marques</strong><br/>
					</div><?php
									getStatistique("marques");
								?>
							</div>

							<!-- categories -->
							<div class="col-3 m-3" style="width:200px; height:200px;">
								<div style="border-bottom: #000318 solid 2px; background-color:red;"><strong class="fs-2" >Categories</strong>	<br/>
					</div><?php
									getStatistique("categories");
								?>
							</div>
						</div>
				<?php
					}
				?>
=======
			<div class="col-lg-9 col-sm-12" style="margin-top:90px">
				
>>>>>>> 08437952519ef506a0d5934375c32f27fad1fd68
				<!-- espace pour ajouter les categories -->
				<?php
					if(isset($_GET['ajouter_categories'])){
						include('./ajouter_categories.php');
						$request = htmlspecialchars($_GET['ajouter_categories']);
						switch($request)
						{
							case 'success':
								echo "<script>Swal.fire({position: 'center',
									icon: 'success',
									title: 'La catégorie ajouté avec succès',
									showConfirmButton: false,
									timer: 3000});
									</script>";
								break;

							case 'error':
								echo "<script>Swal.fire({position: 'center',
									icon: 'error',
									title: 'La catégorie éxiste déjà',
									showConfirmButton: false,
									timer: 3000});
									</script>";
								break;

								case 'empty':
									echo "<script>Swal.fire({position: 'center',
										icon: 'error',
										title: 'Donnez une categorie valide svp',
										showConfirmButton: false,
										timer: 3000});
										</script>";
									break;
						}
					}
				?>		

				<!-- espace pour lister les categories -->
				<?php

					if(isset($_GET['liste_categories'])){
					include('liste_categories.php');
					}
				?>

				<!-- espace pour modifier les categories -->
				<?php

					if(isset($_GET['modifier_categorie'])){
					include('modifier_categorie.php');
					}
				?>

				<!-- espace pour supprimer les categories -->
				<?php

					if(isset($_GET['supprimer_categorie'])){
					include('supprimer_categorie.php');
					}
				?>


				<!-- espace pour ajouter les marques -->
				<?php
					if(isset($_GET['ajouter_marques'])){
						include('./ajouter_marques.php');
						$request = htmlspecialchars($_GET['ajouter_marques']);
						switch($request)
						{
							case 'success':
								echo "<script>Swal.fire({position: 'center',
									icon: 'success',
									title: 'La marque ajouté avec succès',
									showConfirmButton: false,
									timer: 3000});
									</script>";
								break;

							case 'error':
								echo "<script>Swal.fire({position: 'center',
									icon: 'error',
									title: 'La marque éxiste déjà',
									showConfirmButton: false,
									timer: 3000});
									</script>";
								break;
							
								case 'empty':
									echo "<script>Swal.fire({position: 'center',
										icon: 'error',
										title: 'Donnez une marque valide svp',
										showConfirmButton: false,
										timer: 3000});
										</script>";
									break;

						}
					}
				?>

				<!-- espace pour ajouter les marques -->
				<?php
				
					if(isset($_GET['liste_marques'])){
						include('liste_marques.php');
					}
				?>

				<!-- espace pour modifier les marques -->
				<?php

					if(isset($_GET['modifier_marque'])){
					include('modifier_marque.php');
					}
				?>

				<!-- espace pour supprimer les marques -->
				<?php

					if(isset($_GET['supprimer_marque'])){
					include('supprimer_marque.php');
					}
				?>





				<?php
				
					if(isset($_GET['ajouter_produit'])){
						include('./ajouter_produit.php');
					}
				?>

				<!-- espace pour lister les produits -->

				<?php
				
					if(isset($_GET['liste_produits'])){
						include('liste_produits.php');
					}
				?>

				<!-- espace pour supprimer les produits -->

				<?php
				
					if(isset($_GET['supprimer_produit'])){
						include('supprimer_produit.php');
					}
				?>

					<!-- espace pour editer les produits -->
				<?php
				
					if(isset($_GET['modifier_produit'])){
						include('modifier_produit.php');
					}
				?>
					<!-- espace pour afficher les commandes-->
					<?php
				
				if(isset($_GET['liste_commandes'])){
					include('liste_commandes.php');
				}
			?>

				<!-- espace pour supprimer les commandes -->
				<?php

					if(isset($_GET['supprimer_commande'])){
					include('supprimer_commande.php');
					}
				?>

				<!-- espace pour afficher les utilisateurs-->
				<?php
					if(isset($_GET['liste_utilisateurs'])){
						include('liste_utilisateurs.php');
					}
				?>

			</div>
		</div>
	</div>


	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-body">
			<h4>Êtes-vous sûr de vouloir le supprimer ?</h4>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-success" data-bs-dismiss="modal">Non</button>
			<button type="button" class="btn btn-danger" id="idConfirme"></button>
		</div>
		</div>
	</div>
	</div>

	
	<!-- js linck -->
	<script src="js/confirme.js"></script>
	<script src="../js/navbtn.js?v=<?php echo time(); ?>"></script>
    <!-- bootstrap-JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    
</body>
</html>