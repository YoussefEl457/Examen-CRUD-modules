<?php
    class database {
        private $host;
        private $dbh;
        private $user;
        private $pass;
        private $db;


        function __construct(){
            $this->host = 'localhost';
            $this->user = 'root';
            $this->pass = '';
            $this->db = 'examenvoorbereiding';

            try{
                $dsn = "mysql:host=$this->host;dbname=$this->db";
                $this->dbh = new PDO($dsn, $this->user, $this->pass); 
            }catch(PDOException $e){
                die("Unable to connect: " . $e->getMessage());
            }
        }



        function login($gebruikersnaam, $wachtwoord){
            $sql="SELECT * FROM medewerker WHERE gebruikersnaam = :gebruikersnaam";
    
            $stmt = $this->dbh->prepare($sql); 
            $stmt->execute(['gebruikersnaam'=>$gebruikersnaam]); 
    
            $result = $stmt->fetch(PDO::FETCH_ASSOC); 
            if($result){
                if($wachtwoord == $result["wachtwoord"]) {
                    SESSION_START();
                    $_SESSION['user'] = $result;
                    echo "Valid Password!";
                    header("Location:medewerker_overzicht.php");
                } else {
                    echo "Invalid Password!";
                }
            } else {
                echo "Invalid Login";
            }
    
        }



        function getAllKlanten(){

            $sql = "SELECT * FROM reservering JOIN klant on reservering.klantID_rs = klant.klantID";
            
    
            
            $statement = $this->dbh->prepare($sql);
    
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
    
        }



        function getKamers(){

            $sql = "SELECT * FROM kamer";
 
            $statement = $this->dbh->prepare($sql);
    
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
    
        }



        function reserveren($naam, $adres, $plaats, $postcode, $telefoon, $kamernummer, $start_datum, $eind_datum){
            $sql = "INSERT INTO klant(klantID, naam, adres, plaats, postcode, telefoon) VALUES (:klantID, :naam, :adres, :plaats, :postcode, :telefoon);";
            


            $stmt = $this->dbh->prepare($sql);

            $stmt->execute([
                'klantID'=>NULL,
                'naam'=>$naam,
                'adres'=>$adres,
                'plaats'=>$plaats,
                'postcode'=>$postcode,
                'telefoon'=>$telefoon
            ]);

            $klantID = $this->dbh->lastInsertId();

            $sql = "INSERT INTO reservering(reserveringID, kamerID_rs, klantID_rs, start_datum, eind_datum) VALUES (:reserveringID, :kamerID_rs, :klantID_rs, :start_datum, :eind_datum)";
            
            $stmt = $this->dbh->prepare($sql);

            $stmt->execute([
                'reserveringID'=>NULL,
                'kamerID_rs'=>$kamernummer,
                'klantID_rs'=>$klantID,
                'start_datum'=>$start_datum,
                'eind_datum'=>$eind_datum
            ]);
        }



        function deleteKlant($klantID){
            $query = $this->dbh->prepare(
                "DELETE FROM reservering
                WHERE klantID_rs = :klantID_rs;"
            );

                $query->execute([
                    'klantID_rs' => $klantID
                ]);
    
                header("Location: medewerker_overzicht.php");
        }



        function getKlant($klantID_rs){
            $query = "SELECT * FROM reservering WHERE klantID_rs = :klantID_rs;";
    
            $prep = $this->dbh->prepare($query);
    
            $prep->execute([
                'klantID_rs' => $klantID_rs
            ]);
    
            $row = $prep->fetch(PDO::FETCH_ASSOC);
            
            return $row;
        }


        
        function updateKlant($klantID_rs, $kamernummer, $start_datum, $eind_datum){
                $query = "UPDATE reservering SET kamerID_rs = :kamerID_rs, start_datum = :start_datum, eind_datum = :eind_datum WHERE klantID_rs = :klantID_rs;";
    
                $prep = $this->dbh->prepare($query);
    
                $prep->execute([
                    'klantID_rs' => $klantID_rs,
                    'kamerID_rs' => $kamernummer,
                    'start_datum' => $start_datum,
                    'eind_datum' => $eind_datum
                ]);
    
                header("Location: medewerker_overzicht.php");
        }
    }
?>