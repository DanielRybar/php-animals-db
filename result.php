<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
    $name = $telephone = $species = $gender = $agreement = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = format_data($_POST["name"]);
        $telephone = format_data($_POST["tel"]);
        $species = format_data($_POST["species"]);
        $gender = format_data($_POST["radio"]);
        $agreement = format_data($_POST["agreement"]);
    }
    ?>
    <div class="container mt-4">
        <h1>Gratulujeme!</h1>
        <h2>Váš mazlíček byl úspěšně přidán na naše stránky!</h2>
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
                        <td><?php 
                            switch($species) {
                                case "dog": echo "Pes"; break;
                                case "cat": echo "Kočka"; break;
                                case "fish": echo "Ryba"; break;
                                case "parrot": echo "Papoušek"; break;
                                case "other": echo "Jiné"; break;
                                default: echo $species; break;
                            }?>
                        </td>
                        <td><?php echo $gender?></td>
                        <td><?php echo $agreement ? "Ano" : "Ne"?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <a class="btn btn-secondary" href="./index.php">Zpět na formulář</a>
        </div>
    </div>
</body>
</html>