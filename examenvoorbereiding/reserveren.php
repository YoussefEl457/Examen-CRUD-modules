<?php
include 'database.php';
$obj = new database();
$kamers = $obj->getKamers();
    
    if(isset($_POST['submit'])){
        
        $fieldnames = ['naam', 'adres', 'plaats', 'postcode', 'telefoon', 'kamernummer', 'start_datum', 'eind_datum'];
        $error = false;
        
        foreach($fieldnames as $fieldname){
            if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
                $error = true; 
            }

        }

        
        
        


        if(!$error){
            $obj->reserveren($_POST['naam'], $_POST['adres'], $_POST['plaats'], $_POST['postcode'], $_POST['telefoon'], $_POST['kamernummer'], $_POST['start_datum'], $_POST['eind_datum']);
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
                <a class="navbar-brand" >Examen Voorbereiding</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link" href="index.php">Terug</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>

        <form method="post">

            <div class="mb-3" style="width: 15%;">
                <input type="text" name="naam" class="form-control-sm" placeholder="Naam" required>
            </div>

            <div class="mb-3" style="width: 15%;">
                <input type="text" name="adres" class="form-control-sm" placeholder="Adres" required>
            </div>

            <div class="mb-3" style="width: 15%;">
                <input type="text" name="plaats" class="form-control-sm" placeholder="Plaats" required>
            </div>

            <div class="mb-3" style="width: 15%;">
                <input type="text" name="postcode" class="form-control-sm" placeholder="Postcode"required>
            </div>

            <div class="mb-3" style="width: 15%;">
                <input type="text" name="telefoon" class="form-control-sm" placeholder="Telefoon nummer" required>
            </div>

            <div class="mb-3" style="width: 15%;">
                <select class="mb-3" name="kamernummer">
                    <option selected>Kies een Kamer</option>
                    <?php  
                    foreach($kamers as $kamer) { ?>
                    <option value="<?php echo $kamer["kamerID"]?>"> <?php echo $kamer["kamerID"]?> </option>
                    <?php }?>
                </select>
            </div>
            

            <div class="mb-3" style="width: 15%;">
                <input type="date" name="start_datum" class="form-control-sm" placeholder="Start datum" required>
            </div>

            <div class="mb-3" style="width: 15%;">
                <input type="date" name="eind_datum" class="form-control-sm" placeholder="Eind datum" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">reserveren</button>
        </form>
    </body>
</html>