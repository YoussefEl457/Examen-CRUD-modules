<?php
session_start();
include 'database.php';
$DB = new database();
$klanten = $DB->getAllKlanten();

    if(!isset($_SESSION['user'])) {
        header('Location: medewerker_login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>examenvoorbereiding</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                
                <a class="navbar-brand" href="#">Examen Voorbereiding</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="logout.php">Uitloggen</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">reserveringsnummer</th>
                    <th scope="col">kamernummer</th>
                    <th scope="col">klantnummer</th>
                    <th scope="col">naam</th>
                    <th scope="col">adres</th>
                    <th scope="col">plaats</th>
                    <th scope="col">postcode</th>
                    <th scope="col">telefoon</th>
                    <th scope="col">Start datum </th>
                    <th scope="col">Eind datum</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($klanten as $klant):?>
                <tr>
                    <th scope="row"><?php echo $klant["reserveringID"];?></th>
                    <td><?php echo $klant["kamerID_rs"];?></td>
                    <td><?php echo $klant["klantID_rs"];?></td>
                    <td><?php echo $klant["naam"];?></td>
                    <td><?php echo $klant["adres"];?></td>
                    <td><?php echo $klant["plaats"];?></td>
                    <td><?php echo $klant["postcode"];?></td>
                    <td><?php echo $klant["telefoon"];?></td>
                    <td><?php echo $klant["start_datum"];?></td>
                    <td><?php echo $klant["eind_datum"];?></td>
                    <td><a class="btn btn-primary" href="editklant.php?klantID_rs=<?php echo $klant["klantID_rs"]; ?>">Edit</button></td>
                    <td><a class="btn btn-danger" href="deleteklant.php?klantID_rs=<?php echo $klant["klantID_rs"];  ?>">Delete</button></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>