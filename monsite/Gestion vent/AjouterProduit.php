<?php
//ajouter le fichier de configuration config.php
include_once("config.php");
//maintenant on doit créer un formulaire pour ajouter:
// produit(idpro,libelle,prix,qtestock , marque,image)
//je dois vérifier si on cliquer sur le bouton AjouterProduit
//isset:vérifier si on a reçu une le paramètres AjouterProduit vide ou remplis
$erreur="";//sera utilisé pour afficher les errurs
$ok="";
if(isset($_POST['AjouterProduit']))
{
	//vérifier si tous les champs sont remplis
	//empty :permet de vérifier si le paramètre est vide ou pas
	if(!empty($_POST['libelle']) and  !empty($_POST['qtestock']) and !empty($_POST['prix']) and !empty($_POST['marque']) )
	{
		//exécuter la requêtes insert ...
		$libelle=$_POST['libelle'];
		$qtestock=$_POST['qtestock'];
		$prix=$_POST['prix'];
		$marque=$_POST['marque'];
		//l'image sera stockée dans le dossier images , et dans la colonne image on va
		//sauvegarder le chemin 
		$chemin="images/".$_FILES['image']['name'];
		//sauvegarder l'image dans le serveur
		if(move_uploaded_file($_FILES['image']['tmp_name'],$chemin))
		{
			//l'images est sauvegardée
			//maintenant on peut créer la requête SQL
			$sql="insert into produit(libelle,prix,marque,qtestock,image) values
			('$libelle','$prix','$marque','$qtestock','$chemin')";
			
			//exécuter la requête
			$res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
			//si insert is ok
			if($res>0)
			{
				$ok="le produit ".$libelle." est bien ajouté";
			}
			else
			{
				$erreur="LE produit n'est pas ajouté";
			}
		}
		else
		{
			//erreur de sauvegarde de l'image
			$erreur="erreur de sauvegarde de l'image";
		}
	}
	else
	{
		//afficher une erreur :tous les champs sont obligatoires
		$erreur="tous les champs sont obligatoires";
	}
	
	
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">

    <title>Ajouter un produit</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">GesionVente <span class="sr-only">(current)</span></a>
      </li>
     
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Produits
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Ajouter</a>
          <a class="dropdown-item" href="#">Afficher</a>
         
        </div>
      </li>
	  
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Clients
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Ajouter</a>
          <a class="dropdown-item" href="#">Afficher</a>
         
        </div>
      </li>
    
	
	<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Ventes
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Vendre</a>
          <a class="dropdown-item" href="#">Statistiques</a>
         
        </div>
      </li>
	  </ul>
	    <ul class="navbar-nav" style="float:right;">
	 <li class="nav-item" style="float:right;">
        <a class="nav-link" href="#">Connexion</a>
      </li>
	   <li class="nav-item" style="float:right;">
        <a class="nav-link" href="#">Créer compte</a>
      </li>
    </ul>
   
  </div>
</nav>

    <style type="text/css">
    .divider-text {
    position: relative;
    text-align: center;
    margin-top: 15px;
    margin-bottom: 15px;
}
.divider-text span {
    padding: 7px;
    font-size: 12px;
    position: relative;   
    z-index: 2;
}
.divider-text:after {
    content: "";
    position: absolute;
    width: 100%;
    border-bottom: 1px solid #ddd;
    top: 55%;
    left: 0;
    z-index: 1;
}

.btn-facebook {
    background-color: #405D9D;
    color: #fff;
}
.btn-twitter {
    background-color: #42AEEC;
    color: #fff;
}    </style>
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">





<article class="card-body mx-auto" >
	<h4 class="card-title mt-3 text-center">Ajouter Produit</h4>
	
	<?php
	if($erreur!="")
	{
		?>
		<div class="alert alert-danger" role="alert">
<?php echo $erreur;?>
</div>
		<?php
	}
	
	?>
	
	<?php
	if($ok!="")
	{
		?>
		<div class="alert alert-success" role="alert">
<?php echo $ok;?>
</div>
		<?php
	}
	
	?>
	<form enctype="multipart/form-data" method="post" action="AjouterProduit.php">
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-info"></i> </span>
		 </div>
        <input  class="form-control" name="libelle" placeholder="libelle" type="text" required>
    </div> 
	
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-dollar-sign"></i> </span>
		 </div>
        <input  class="form-control" name="prix" placeholder="prix" type="number" required>
    </div> 
	
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-warehouse"></i> </span>
		 </div>
        <input  class="form-control" name="qtestock" placeholder="qtestock" type="number" required>
    </div> 
	
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-list"></i> </span>
		 </div>
	<select  name="marque" class="custom-select" style="max-width: 120px;" required>
		    <option selected="">hp</option>
		    <option value="1">del</option>
		    <option value="2">sumsung</option>
		</select>    </div> 
	
	
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-image"></i> </span>
		 </div>
        <input  class="form-control" name="image" placeholder="image" type="file" required>
    </div> 
	
                                
    <div class="form-group">
        <input type="submit" name="AjouterProduit" class="btn btn-primary btn-block" value="Ajouter"/>
    </div>                                                               
</form>
</article>

</body>
</html>
