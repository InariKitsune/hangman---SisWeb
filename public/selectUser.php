<!DOCTYPE html>
<?php
include "utilities.php";

$conn = createConnection();

$selectSql = "SELECT idUsuario,Name, LastName, email FROM users";
$result = mysqli_query($conn, $selectSql);

if (isset($_POST["newUserButton"]))
{
   header("Location: newuser.php");
  exit();
}
if (isset($_POST["LogInButton"]))
{
   header("Location: Login.php");
  exit();
}

?>

<html lang="es-BO">
  <head>
    <title>El ahorcado - Seleccionar usuario</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/users.css">
  </head>
  <body>  	
    <form method="POST">
    	<input type="submit" name="LogInButton" value="Log In" />
      	<input type="submit" name="newUserButton" value="New User" />
    </form>
  </body>
</html>
