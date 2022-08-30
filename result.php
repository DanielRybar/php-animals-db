<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./site.css">
    <title>Výsledek</title>
</head>
<body>
    <?php
    function format_data($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function insert_data() {
        global $name, $telephone, $species, $gender, $agreement;
        $query = "INSERT INTO `animals` (Name, Telephone, Species, Gender, Agreement) VALUES
            ('$name', '$telephone', '$species', '$gender', '$agreement')";
        return $query;
    }

    $name = $telephone = $species = $gender = $agreement = "";
    $result = "";
    $is_valid = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = format_data($_POST["name"]);
        $telephone = format_data($_POST["tel"]);
        $species = format_data($_POST["species"]);
        $gender = format_data($_POST["radio"]);
        $agreement = format_data($_POST["agreement"]);
    }
    switch($species) {
        case "dog": $species = "Pes"; break;
        case "cat": $species = "Kočka"; break;
        case "fish": $species = "Ryba"; break;
        case "parrot": $species = "Papoušek"; break;
        default: $species = "Jiné"; break;
    }

    try {
        $connection = new mysqli("localhost", "root", "", "animals");
    } catch(Exception) {
        $connection = new mysqli("localhost", "root", "");
        $create_db = "CREATE DATABASE IF NOT EXISTS animals";
        if($connection->query($create_db)) {
            $connection = new mysqli("localhost", "root", "", "animals");
            $result = "Databáze vytvořena. ";
        }
    }
    if(!$connection->connect_error) {
        try {
            $sql = insert_data();
            if($connection->query($sql)) {
                $result = "Váš mazlíček byl úspěšně vložen do databáze!";
                $is_valid = true;
            } else {
                $result = "Neúspěch!";
            }
        } catch(Exception) {
            $sql = "CREATE TABLE IF NOT EXISTS animals (
                PetID int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                Name varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci DEFAULT NULL,
                Telephone varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci DEFAULT NULL,
                Species varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci DEFAULT NULL,
                Gender varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci DEFAULT NULL,
                Agreement bit(1) DEFAULT b'0'
              )";
            if($connection->query($sql)) {
                $insertion = insert_data();
                if($connection->query($insertion)) {
                    $result .= "Tabulka byla vytvořena a mazlíček byl vložen.";
                    $is_valid = true;
                }
            } else {
                $result = "Neúspěch!";
            }
        }
    }
    ?>
    <div class="container mt-4">
        <h1>Výsledek</h1>
        <h2><?php echo $result ?></h2>
        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Jméno</th>
                        <th>Telefon majitele</th>
                        <th>Druh</th>
                        <th>Pohlaví</th>
                        <th>Souhlas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $name?></td>
                        <td><?php echo $telephone?></td>
                        <td><?php echo $species?></td>
                        <td><?php echo $gender?></td>
                        <td><?php echo $agreement ? "Ano" : "Ne"?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <a class="btn btn-secondary" href="./index.php">Zpět na formulář</a>
        </div>
        <h2>Vložené hodnoty</h2>
        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Jméno</th>
                        <th>Telefon majitele</th>
                        <th>Druh</th>
                        <th>Pohlaví</th>
                        <th>Souhlas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if($is_valid) {
                            $view = $connection->query("SELECT * FROM animals ORDER BY animals.PetID desc LIMIT 5");
                            while($row = mysqli_fetch_array($view)) {
                            ?>
                            <tr>
                                <td><?php echo $row['PetID']?></td>
                                <td><?php echo $row['Name']?></td>
                                <td><?php echo $row['Telephone']?></td>
                                <td><?php echo $row['Species']?></td>
                                <td><?php echo $row['Gender']?></td>
                                <td><?php echo ($row['Agreement'] == 1 ? "Ano" : "Ne")?></td>
                            </tr>
                        <?php
                            }
                        }
                        ?>
                </tbody>
            </table>
        </div>
        <a class="btn btn-warning" href=<?php echo $is_valid ? "'./list.php'" : ""?>>Úplný seznam</a>
    </div>
</body>
</html>