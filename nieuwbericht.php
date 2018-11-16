<?php
/**
 * @author Bas van Evelingen <BasvanEvelingen@me.com>
 * Weekopdracht 2 maak een blog
 * (C)RUD opzet <- Create 
 * Een nieuw bericht in de database zetten
 * DB name = basblog Table = berichten
 * Veldnamen BerichtID|BerichtTitel|BerichtOmschrijving|BerichtInhoud|Auteur|BerichtDatum 
 * TODO: Auteur functionaliteit invoegen (de ingelogde user).
 */
session_start();

// Include config bestand
require_once "config.php";

// Variabelen declareren en initialiseren
$berichtTitel = "";
$berichtOmschrijving = "";
$berichtInhoud = "";
$auteur = $_SESSION["username"];

$titel_error = "";
$omschrijving_error = "";
$inhoud_error = "";

// sleutels van google voor reCaptcha.
$rcfg = include "cfg.php";
$siteKey = $rcfg['v2-standard']['site'];
$secret = $rcfg['v2-standard']['secret'];

// Data uit formulier verwerken 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // reCaptcha response gegeven
    if (isset($_POST['g-recaptcha-response'])) {
        // Vragen aan google om de response te controleren
        $request = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='. $secret .'&response='.$_POST['g-recaptcha-response']);
        // Het resultaat is in JSON dus decoderen
        $response = json_decode($request);
        // Wanneer succes verder gaan met opslaan
        if($response->success) {
            // valideer titel, netjes maken met trim
            $input_titel = trim($_POST["titel"]);
            // wanneer leeg foutmelding
            if (empty($input_titel)) {
                $titel_error = "Voer een titel in.";
                //reguliere expressie filter uitvoeren op nette titel, wanneer false teruggeeft foutmelding.
            //} elseif(!filter_var($input_titel, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9a-zA-Z.,\?\s]+$/")))) {
                //$titel_error = "Voer een goede titel in.";
            } else {
                $berichtTitel = $input_titel;
            }
            // Valideer omschrijving , mag niet leeg zijn.
            $input_omschrijving = trim($_POST["omschrijving"]);
            if(empty($input_omschrijving)) {
                $omschrijving_error = "Voer een omschrijving in.";     
            } else {
                $berichtOmschrijving = $input_omschrijving;
            }
            
            // Valideer inhoud van bericht, mag ook niet leeg zijn.
            $input_inhoud = trim($_POST["inhoud"]);
            if(empty($input_inhoud)) {
                $inhoud_error = "Bericht mag niet leeg zijn.";     
            } else {
                $berichtInhoud = $input_inhoud;
            }
    
            // Kijken of er fouten zijn gemaakt bij invoeren blogbericht 
            if(empty($titel_error) && empty($omschrijving_error) && empty($inhoud_error)) {
                // insert statement declareren voor toevoegen bericht aan database tabel
                $sql = "INSERT INTO berichten (BerichtTitel,BerichtOmschrijving,BerichtInhoud,Auteur) VALUES (?, ?, ?, ?)"; 
                // statement voorbereiden en trachten uit te voeren
                if($stmt = $mysqli->prepare($sql)) {
                    // variabelen aan statement binden met parameters, drie keer een string vandaar "sss" als argument
                    $stmt->bind_param("ssss", $param_titel, $param_omschrijving, $param_inhoud, $param_auteur);
                    
                    // Parameters zetten
                    $param_name = $berichtTitel;
                    $param_omschrijving = $berichtOmschrijving;
                    $param_inhoud = $berichtInhoud;
                    $param_auteur = $auteur;
            
                    // Poging wagen om data te schrijven naar databse
                    if($stmt->execute()) {
                        // Hoera gelukt, terug naar aanroep pagina
                        header("location: index.php");
                        exit();
                    } else {
                        echo "Er ging iets fout, probeer later nog eens.";
                    }
                }
                // sluit statement
                $stmt->close();
            }
            else
            {
                echo "Geen goede titel";
            }
    
    
        } else {
            echo "Probeer het nogmaals, u dient de reCaptcha aan te klikken.";

        }
    } else {
        echo "U moet de reCaptcha aanklikken.";
    }
    // sluit connectie
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bericht aanmaken</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet">
        <link href="style.css" type="text/css" rel="stylesheet">
        <script src="script.js"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
    <body>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header">
                            <h2>Blogbericht aanmaken</h2>
                        </div>
                        <p>Maak een bericht aan.</p>
                        <!-- begin van formulier -->
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group <?php echo (!empty($titel_error)) ? 'heeft een fout' : ''; ?>">
                                <label>Titel</label>
                                <input type="text" name="titel" class="form-control" value="<?php echo $berichtTitel; ?>">
                                <span class="help-block"><?php echo $titel_error;?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($omschrijving_error)) ? 'heeft een fout' : ''; ?>">
                                <label>Omschrijving</label>
                                <input type="text" name="omschrijving" class="form-control" value="<?php echo $berichtOmschrijving; ?>">
                                <span class="help-block"><?php echo $omschrijving_error;?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($inhoud_error)) ? 'heeft een fout' : ''; ?>">
                                <label>Inhoud</label>
                                <textarea name="inhoud" class="form-control"><?php echo $berichtInhoud; ?></textarea>
                                <span class="help-block"><?php echo $inhoud_error;?></span>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Submit">
                            <a href="index.php" class="btn btn-default">Cancel</a>
                            <div class="g-recaptcha rec" data-sitekey="<?php echo $siteKey ?>"></div>
                        </form>
                        <div id="idError" class="error_box"> <p class="error_text"><p></div>
                    </div>
                </div>        
            </div>
        </div>
    </body>
</html>
