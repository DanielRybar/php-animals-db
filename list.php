<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Data</title>
</head>
<body>
    <div class="container mt-4">
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
                        $connection = new mysqli("localhost", "root", "", "animals");
                        if(!$connection->connect_error) {
                            $view = $connection->query("SELECT * FROM animals");
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
    </div>
</body>
</html>