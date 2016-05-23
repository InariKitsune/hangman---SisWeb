<!DOCTYPE html>
<?php
include "utilities.php";

function getUserPass($usId, $conn)
{
  $sql = "SELECT password FROM users WHERE Name=?";

    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql))
    {
      mysqli_stmt_bind_param($stmt, "s", $usId);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_bind_result($stmt, $password);
      mysqli_stmt_fetch($stmt);
      mysqli_stmt_close($stmt);

      return $password;
    }
    else
      return null;
}
function getUserId($usId, $conn)
{
  $sql = "SELECT idUsuario FROM users WHERE Name=?";

    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql))
    {
      mysqli_stmt_bind_param($stmt, "s", $usId);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_bind_result($stmt, $uid);
      mysqli_stmt_fetch($stmt);
      mysqli_stmt_close($stmt);

      return $uid;
    }
    else
      return null;
}

$conn = createConnection();

if (isset($_POST["loginButton"]))
{
 	$ingresado=$_POST["PaswordTextBox"];
 	$userNick = $_POST["NickTextBox"];
	$userPass = getUserPass($userNick, $conn);
    if(password_verify($ingresado, $userPass))
      {
		  $userId = getUserId($userNick, $conn);
		  header("Location: selectCategory.php?id=".$userId);
		  exit();
      }
      else
      {
        echo '<script language="javascript">alert("Passwod erroneo");</script>';        
      }
}
?>
<html>
  <head>
  	 <meta charset="UTF-8">
     <link rel="stylesheet" type="text/css" href="css/users.css">
  </head>
  <body>
    <form method="POST" >
    	<input type ="text" id="NickTextBox" name="NickTextBox"/></br>
    	<input type ="password" id="PaswordTextBox" name="PaswordTextBox"/></br>       
      	<input type="submit" name="loginButton" value="Login" />
    </form>

  </body>
</html>
