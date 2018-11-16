<!--
/**
 * @author Bas van Evelingen <BasvanEvelingen@me.com>
 * Weekopdracht 2 maak een blog
 * View zonder controls
 * De zogenaamde bloglezer.
 * DB name = basblog Table = berichten
 * Veldnamen BerichtID|BerichtTitel|BerichtOmschrijving|BerichtInhoud|Auteur|BerichtDatum 
 */
-->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Bas Blog</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="bootstrap.css" type="text/css" rel="stylesheet">
        <link href="style.css" type="text/css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="container">
            <img class="blogpicture" src="images/BasBlog.png" />
        </div>
    <?php
        // Include config file
        require_once "config.php";

        $titel = $omschrijving = $inhoud =  $auteur = $datum = "";
        // Query proberen uit te voeren
        $sql = "SELECT * FROM berichten ORDER BY BerichtDatum DESC";
        if ($result = $mysqli->query($sql)) {
            if ($result->num_rows > 0) { 
                while($row = mysqli_fetch_array($result)) {
                    $titel = $row['BerichtTitel']; 
                    $omschrijving = $row['BerichtOmschrijving'];
                    $inhoud = $row['BerichtInhoud'];
                    $auteur = $row['Auteur'];
                    $datum =  $row['BerichtDatum'];
                    echo "<div class='container'>";
                        echo "<div class='row'>";
                            echo "<div class='col-lg-8'>";
                                // titel
                                echo "<h1 class='mt-4'>" . $titel . "</h1>";
                                // auteur
                                echo "<p class='lead'>Door: " . $auteur . "</p";
                                echo "<hr>";
                                // datum
                                echo "<p> Posted on: " . $datum . "</p>";
                                echo "<hr>";
                                // omschrijving
                                echo "<h3>" . $omschrijving . "</h3>";
                                // inhoud
                                echo "<p class='lead'>" . $inhoud . "</p";
                                echo "<hr>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                }
            }
        }
        ?>
    </body>
</html>
