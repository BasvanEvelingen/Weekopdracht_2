
<?php
// Initialiseer session
session_start();
 
// Kijk of de gebruiker al ingelogd is?
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Welkom Pagina</title>
        <link href="https://fonts.googleapis.com/css?font=Bitter" rel="stylesheet">
        <link href="../bootstrap.css" rel="stylesheet">
        <link href="../style.css" type="text/css" rel="stylesheet">
        <style type="text/css">
            body{ font: 14px sans-serif; text-align: center; }
        </style>
    </head>
    <body>

        <div class="page-header">
            <img src="../images/BasBlog.png" />
            <h3>Hallo, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welkom bij mijn Blog.</h3>
        </div>
        <p>
            <a href="../index.php" class="btn btn-primary">Blog Administratie</a>
            <a href="../blogview.php"  class="btn btn-info">Blog View</a> 
            <a href="reset-password.php" class="btn btn-warning">Herstel uw wachtwoord</a>
            <a href="logout.php" class="btn btn-danger">Uitloggen</a>
        </p>
        <p class="lead"> P.S. de Blog View is voor gasten en heeft geen interface om hier terug te komen.</p>
    </body>
</html>
