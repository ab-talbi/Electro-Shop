<?php

if(!isset($_GET['ajouter_produit'])){
  header('Location: ../index.php');
}


?>


<?php

    require_once('../includes/connect.php');

    if(isset($_POST['ajouter_produit_btn'])){

        $nom_produit = htmlspecialchars($_POST['nom_produit']);
        $description_produit = htmlspecialchars($_POST['description_produit']);
        $mots_cles = htmlspecialchars($_POST['mots_cles']);
        $produit_categorie = htmlspecialchars($_POST['produit_categorie']);
        $produit_marque = htmlspecialchars($_POST['produit_marque']);

        $produit_image1 = htmlspecialchars($_FILES['produit_image1']['name']);
        $produit_image2 = htmlspecialchars($_FILES['produit_image2']['name']);
        $produit_image3 = htmlspecialchars($_FILES['produit_image3']['name']);
        $produit_image4 = htmlspecialchars($_FILES['produit_image4']['name']);
        $produit_image5 = htmlspecialchars($_FILES['produit_image5']['name']);

        $temp_image1 = htmlspecialchars($_FILES['produit_image1']['tmp_name']);
        $temp_image2 = htmlspecialchars($_FILES['produit_image2']['tmp_name']);
        $temp_image3 = htmlspecialchars($_FILES['produit_image3']['tmp_name']);
        $temp_image4 = htmlspecialchars($_FILES['produit_image4']['tmp_name']);
        $temp_image5 = htmlspecialchars($_FILES['produit_image5']['tmp_name']);

        $stock = htmlspecialchars($_POST['stock']);
        if($stock>0){
            $status_produit = 'disponible';
        }else{
            $status_produit = 'pas disponible';
        }
        $prix_produit = htmlspecialchars($_POST['prix_produit']);

        if($nom_produit == '' ||$description_produit == '' ||$mots_cles == '' ||$produit_categorie == '' ||$produit_marque == '' ||$prix_produit == '' || $produit_image1 == '' || $stock == ''){
            echo "<script>Swal.fire({position: 'center',
                icon: 'error',
                title: 'Remplir les champs obligatoire!',
                showConfirmButton: false,
                timer: 3000});
                </script>";
        }else{
            move_uploaded_file($temp_image1,"./produits_images/$produit_image1");
            if($produit_image2 != ''){
                move_uploaded_file($temp_image2,"./produits_images/$produit_image2");
            }
            if($produit_image3 != ''){
                move_uploaded_file($temp_image3,"./produits_images/$produit_image3");
            }
            if($produit_image4 != ''){
                move_uploaded_file($temp_image4,"./produits_images/$produit_image4");
            }
            if($produit_image5 != ''){
                move_uploaded_file($temp_image5,"./produits_images/$produit_image5");
            }

                /* ajout du produit ?? la base de donnes*/

            $insert = $con->prepare('INSERT INTO produits(nom_produit,description_produit,mots_cles,id_categorie,id_marque,produit_image1,produit_image2,produit_image3,produit_image4,produit_image5,prix_produit,status_produit,stock) VALUES(:nom_produit,:description_produit,:mots_cles,:id_categorie,:id_marque,:produit_image1,:produit_image2,:produit_image3,:produit_image4,:produit_image5,:prix_produit,:status_produit,:stock)');
            $insert->execute(array(":nom_produit"=>$nom_produit,":description_produit"=>$description_produit,":mots_cles"=>$mots_cles,":id_categorie"=>$produit_categorie,":id_marque"=>$produit_marque,":produit_image1"=>$produit_image1,":produit_image2"=>$produit_image2,":produit_image3"=>$produit_image3,":produit_image4"=>$produit_image4,":produit_image5"=>$produit_image5,":prix_produit"=>$prix_produit,"status_produit"=>$status_produit,":stock"=>$stock));
            
            if($insert){
                echo "<script>Swal.fire({position: 'center',
                    icon: 'success',
                    title: 'Le Produit ?? ??t?? enregistr?? avec succ??s',
                    showConfirmButton: false,
                    timer: 3000});
                    </script>";
            }

        }

    }

?>
<div class="container mt-3">
        <h1 class="text-center">Ajouter un Produit</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="nom_produit" class="form-label">Nom du Produit <span style="color:red">*</span></label>
                <input type="text" name="nom_produit" id="nom_produit" class="form-control" placeholder="Nom du produit" autocomplete="off">
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <!-- <label for="description_produit" class="form-label">Description <span style="color:red">*</span></label>
                <input type="text" name="description_produit" id="description_produit" class="form-control" placeholder="Description du produit" > -->

                <label for="description_produit" class="form-label">Description <span style="color:red">*</span></label>
                <textarea class="form-control w-100" name="description_produit" id="description_produit" cols="30" rows="10" placeholder="Description du produit"></textarea>
            </div>
            

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="mots_cles" class="form-label">Mots Cl??s <span style="color:red">*</span></label>
                <input type="text" name="mots_cles" id="mots_cles" class="form-control" placeholder="Mots Cl??s" autocomplete="off">
            </div>

            <div class="form-outline mb-4 w-50 m-auto">

                <select name="produit_categorie" id="produit_categorie" class="form-select">
                    <option value="">Choisir une Cat??gorie</option>
                    <?php
                    
                    $select_categories = $con->query('SELECT * FROM categories');
                    if($select_categories){
                        while($ligne = $select_categories->fetch(PDO::FETCH_OBJ)){
                            echo "<option value='$ligne->id_categorie'>$ligne->nom_categorie</option>";
                        }
                    }else{
                        echo "Essayer d'ajouter une cat??gorie d'abord";  
                    }
                    
                    ?>
                </select>

            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                

                <select name="produit_marque" id="produit_marque" class="form-select">
                    <option value="">Choisir une Marque</option>
                    <?php
                    
                    $select_marques = $con->query('SELECT * FROM marques');
                    if($select_marques){
                        while($ligne = $select_marques->fetch(PDO::FETCH_OBJ)){
                            echo "<option value='$ligne->id_marque'>$ligne->nom_marque</option>";
                        }
                    }else{
                        echo "Essayer d'ajouter une marque d'abord";  
                    }
                    
                    ?>
                </select>

            </div>

            
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="produit_image1" class="form-label">Image 1 <span style="color:red">*</span></label>
                <input type="file" name="produit_image1" id="produit_image1" class="form-control">
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="produit_image2" class="form-label">Image 2</label>
                <input type="file" name="produit_image2" id="produit_image2" class="form-control">
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="produit_image3" class="form-label">Image 3</label>
                <input type="file" name="produit_image3" id="produit_image3" class="form-control">
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="produit_image4" class="form-label">Image 4</label>
                <input type="file" name="produit_image4" id="produit_image4" class="form-control">
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="produit_image5" class="form-label">Image 5</label>
                <input type="file" name="produit_image5" id="produit_image5" class="form-control">
            </div>
            
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="stock" class="form-label">Quantit?? stock?? <span style="color:red">*</span></label>
                <input type="number" name="stock" id="stock" class="form-control" placeholder="Nembre du Produit en stock" autocomplete="off">
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="prix_produit" class="form-label">Prix du Produit <span style="color:red">*</span></label>
                <input type="text" name="prix_produit" id="prix_produit" class="form-control" placeholder="Prix du Produit" autocomplete="off">
            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="ajouter_produit_btn" class="btn btn-info mb-3 px-3" value="Ajouter le Produit">
            </div>
            
        </form>
</div>
