<!--
 * @author Bas van Evelingen <BasvanEvelingen@me.com>
 * Weekopdracht 2 maak een blog
 * CRUD opzet Hoofdpagina
 * Berichten uit blog en userinterface weergeven
 * DB name = basblog Table = berichten
 * Veldnamen BerichtID|BerichtTitel|BerichtOmschrijving|BerichtInhoud|Auteur|BerichtDatum 
-->
<?php 

session_start();

// Kijk of de gebruiker al ingelogd is?
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: user/login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Bas Blog</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="bootstrap.css" rel="stylesheet">
        <link href="style.css" type="text/css" rel="stylesheet"> 
        <link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header clearfix">
                            <h1>Bas Blog</h1>
                            <h2 class="pull-left">Berichten</h2>
                            <a href="user/welkom.php" class="btn btn-warning pull-right blogbutton">Hoofdmenu</a>
                            <a href="nieuwbericht.php" class="btn btn-primary pull-right blogbutton">Nieuw Bericht</a>
                        </div>
                        <?php
                            // Include config file
                            require_once "config.php";
                            // Query proberen uit te voeren
                            $sql = "SELECT * FROM berichten ORDER BY BerichtDatum DESC";
                            if ($result = $mysqli->query($sql)) {
                                if ($result->num_rows > 0) {
                                    // Berichten tabel beginnend met de koppen van de kolommen
                                    echo "<table class='table table-borderer table-striped'>";
                                        echo "<thead>";
                                            echo "<tr>";
                                                echo "<th>nummer</th>";
                                                echo "<th>titel</th>";
                                                echo "<th>omschrijving</th>";
                                                echo "<th>inhoud</th>";
                                                echo "<th>auteur</th>";
                                                echo "<th>datum</th>";
                                                echo "<th>acties</th>";
                                            echo "</tr>";
                                        echo "</thead>";
                                        // hier komen de details van de berichten
                                        echo "<tbody>";
                                        while($row = mysqli_fetch_array($result)) {
                                            echo "<tr>";
                                                echo "<td>" . $row['BerichtID'] . "</td>";
                                                echo "<td>" . $row['BerichtTitel'] . "</td>";
                                                echo "<td>" . $row['BerichtOmschrijving'] . "</td>";
                                                echo "<td>" . $row['BerichtInhoud'] . "</td>";
                                                echo "<td>" . $row['Auteur'] . "</td>";
                                                echo "<td>" . $row['BerichtDatum'] . "</td>";
                                                echo "<td>";
                                                    echo "<a href='leesbericht.php?id=" . $row['BerichtID'] . "' title='Lees Bericht' data-toggle='tooltip'><i class='far fa-eye fa-2x'></i></a>";
                                                    echo "<a href='updatebericht.php?id=" . $row['BerichtID'] . "' title='Bewerk Bericht' data-toggle='tooltip'><i class='far fa-edit fa-2x'></i></a>";
                                                    echo "<a href='verwijderbericht.php?id=" . $row['BerichtID'] . "' title='Verwijder Bericht' data-toggle='tooltip'><i class='far fa-trash-alt fa-2x'></i></a>";
                                                echo "</td>";
                                            echo "</tr>";
                                        }
                                        echo "</tbody>";
                                    echo "</table>";
                                    // result vrijgeven
                                    $result->free();
                                } else {
                                    echo "Geen berichten gevonden.</em></p>";
                                }
                            } else {
                                echo "ERROR: Kon volgende query niet uitvoeren: $sql. " . mysqli_error($link);
                            }
                            // sluit connectie
                            $mysqli->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
