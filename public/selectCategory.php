<!DOCTYPE html>
<?php
include "utilities.php";

$conn = createConnection();

$selectSql = "SELECT id, name FROM category";
$result = mysqli_query($conn, $selectSql);

?>

<html lang="es-BO">
  <head>
    <title>El ahorcado - Seleccionar categoria</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/users.css">
  </head>
  <body>
  	<h1>Seleccionar categoria</h1>
<?php
       			if (mysqli_num_rows($result) > 0) 
	   			{
		   			while( $row = mysqli_fetch_assoc($result) )
		   			{ ?>
			  			<li><a href="index.php?id=<?= $row["id"] ?>"><?= $row["name"] ?></a></li> 
					</br>
	 				<?php
           			}
	   			}
	  		?>
	  </body>
</html>