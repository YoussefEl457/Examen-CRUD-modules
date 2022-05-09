<?php
include 'database.php';

    if(isset($_POST['submit'])){

        $fieldnames = ['gebruikersnaam', 'wachtwoord'];
        $error = false;

        foreach($fieldnames as $fieldname){
            if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
                $error = true; 
            }
        }

        if(!$error){
            $obj = new database();
            $obj->login($_POST['gebruikersnaam'], $_POST['wachtwoord']);
        }
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
                        <a class="nav-link" href="index.php">Terug</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <form method="post">
            <div class="mb-3" style="width: 15%;">
                <label  class="form-label">Gebruikersnaam</label>
                <input type="text" name="gebruikersnaam" class="form-control" required>
            </div>

            <div class="mb-3" style="width: 15%;">
                <label  class="form-label">Wachtwoord</label>
                <input type="password" name="wachtwoord" class="form-control" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </body>
</html>