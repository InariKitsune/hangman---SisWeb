<!DOCTYPE html>
<?php
include_once "utilities.php";


function validarDatos($conf,$password)
{
  $resp = false;
  if($conf === $password)
    $resp = true;
  return $resp;
}

$conn = createConnection();

if (isset($_POST["createNewUserButton"]))
{


    $email=$_POST["EmailTextBox"];
    $password=$_POST["PaswordTextBox"];
    $confpass=$_POST["ConfPaswordTextBox"];
    $name=$_POST["NameTextBox"];
    $lastName=$_POST["lastNameTextBox"];
    $creditCard=$_POST["creditCardTextBox"];
    if($_POST["creditCardtype"]==="visa")
      $creditCardtype=true;
    else
      $creditCardtype=false;
    $Securitycode=$_POST["CodigoDeSeguridad"];
    $creditCardExpiration=$_POST["creditCardExpirationTextBox"];

    $valido=validarDatos($confpass, $password);

    if($valido)
    {
      $sql = "INSERT INTO users (email, password, Name, LastName, CreditCard,visa,securityCode, expiration) VALUES (?, ?, ?, ?, ?,?,?, ?)";

      $password = password_hash($confpass, PASSWORD_DEFAULT);
      $stmt = mysqli_stmt_init($conn);
      if (mysqli_stmt_prepare($stmt, $sql))
      {
        mysqli_stmt_bind_param($stmt,"ssssiiis", $email,$password,$name,$lastName,$creditCard,$creditCardtype,$Securitycode,$creditCardExpiration);

        mysqli_stmt_execute($stmt);


        $success = true;
      }
    }
}

$selectSql = "SELECT idUsuario,Name, LastName, Puntos, email FROM users";
$result = mysqli_query($conn, $selectSql);
?>
<html lang="es-BO">
  <head>
    <title>El ahorcado - Usuarios</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/users.css">
  </head>
  <body>

  <h1>New User</h1>
    <form method="POST">
      Email:
      <input type="email" name="EmailTextBox"/>
      </br>
      Password:
      <input type="password" name="PaswordTextBox"/>
      </br>
      Confirm your password:
      <input type="password" name="ConfPaswordTextBox" />
      </br>
      Name:
      <input type="text" name="NameTextBox" maxlength="50" />
      </br>
      Last Name:
      <input type="text" name="lastNameTextBox" maxlength="50" />
      </br>
      Credit card's number:
      <input type="number" name="creditCardTextBox" maxlength="16" />
      </br>
      Credit card type:
      <input type="radio" name="creditCardtype" value="Visa" checked>Visa
      <input type="radio" name="creditCardtype" value="MasterCArd" >MasterCArd
    <br>
    <br>
      Security code:
      <input type="number" name="CodigoDeSeguridad" maxlength="4" />
      </br>
      Credit Card's expiration:
      <input type="date" name="creditCardExpirationTextBox"  />
      </br>
      <input type="submit" name="createNewUserButton" value="Crear" />
    </form>
    <h1>Users</h1>
      <ul>
      <?php
        if (mysqli_num_rows($result) > 0)
        {
         ?>
        <h2>Name, email, Points</h3>
          <?php
        while( $row = mysqli_fetch_assoc($result) )
        { ?>
          <li><a href="Login.php?id=<?= $row["idUsuario"] ?>"><?= $row["Name"] ?>, <?= $row["email"] ?>, <?= $row["Puntos"] ?></a></li>
        <?php
           }
     }
    ?>
    <ul>
    </li>
  </ul>
  </body>
</html>
