 <?php
 //le fichier config.php
 $servername="localhost";
 $username="root";
 $password="";
$dbname="gestionventlicda";
$conn=mysqli_connect($servername,$username,$password,$dbname) or die(mysqli_error($conn));
if(!$conn)
{
	echo 'erreur de connexion à la base de données ';
}

?>