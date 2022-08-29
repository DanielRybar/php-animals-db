<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./site.css">
    <title>Příklad validace formuláře</title>
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
        $name_error = $telephone_error = $species_error = $agreement_error = "";
        $validation_action = htmlspecialchars($_SERVER["PHP_SELF"]);
        $validation_redirection = "";
        $validations = array(
            "name" => false,
            "telephone" => false,
            "species" => false,
            "agreement" => false,
        );

        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            if(empty($_POST["name"])) {
                $name_error = "Jméno je vyžadováno.";
            } else {
                $name = format_data($_POST["name"]);
                $validations["name"] = true;
            } if (!preg_match("/^.{3,}$/", $name)) {
                $name_error = "Jméno musí obsahovat minimálně 3 znaky.";
                $validations["name"] = false;
            }

            if(empty($_POST["tel"])) {
                $telephone_error = "Telefonní číslo je vyžadováno.";
            } else {
                $telephone = format_data($_POST["tel"]);
                $validations["telephone"] = true;
            } if (!preg_match("/^(\+420)? ?[1-9][0-9]{2} ?[0-9]{3} ?[0-9]{3}$/", $telephone)) {
                $telephone_error = "Chybný formát telefonního čísla.";
                $validations["telephone"] = false;
            }

            if($_POST["species"] === "default") {
                $species_error = "Vyberte platnou možnost z nabídky.";
                $validations["species"] = false;
            } else {
                $species = $_POST["species"];
                $validations["species"] = true;
            } 

            $gender = $_POST["radio"];

            if(!isset($_POST["agreement"])) {
                $agreement_error = "Je nutné souhlasit s podmínkami.";
                $validations["agreement"] = false;
            } else {
                $agreement = $_POST["agreement"];
                $validations["agreement"] = true;
            } 
        }
        $fuse = [];
        foreach($validations as $key => $value) {
            if($value)
                array_push($fuse, $value);
        }
        //echo var_dump($fuse);
        if(empty($name_error) && empty($telephone_error) 
            && empty($species_error) && empty($gender_error) 
            && empty($agreement_error) && count($validations) === count($fuse)) 
        {        
            $validation_action = "result.php";
            //header("Location: result.php");
            $validation_redirection = "<script>document.getElementsByTagName('form')[0].submit()</script>";
        }
    ?>
    <div class="container mt-4">
        <h1>Registrace nového mazlíčka</h1>
        <form method="post" action="<?php echo "$validation_action"?>">
            <div>
                <label for="name" class="form-label">Jméno</label>
                <input type="text" class="form-control" id="name" name="name" 
                    placeholder="Azor" value="<?php echo $name?>">
                <p class="invalid" id="nameInvalid"><?php echo $name_error?></p>
            </div>
            <div>
                <label for="tel" class="form-label">Telefon majitele</label>
                <input type="tel" class="form-control" id="tel" name="tel" 
                    placeholder="+420 123 456 789" value="<?php echo $telephone?>" />
                <p class="invalid" id="telInvalid"><?php echo $telephone_error?></p>
            </div>
            <div>
                <label for="selectList" class="form-label">Vyberte druh</label>
                <select class="custom-select" name="species" id="selectList">
                    <option value="default">...Otevřete seznam...</option>
                    <option <?php echo $species === "dog" ? "selected" : ""?> value="dog">Pes</option>
                    <option <?php echo $species === "cat" ? "selected" : ""?> value="cat">Kočka</option>
                    <option <?php echo $species === "fish" ? "selected" : ""?> value="fish">Ryba</option>
                    <option <?php echo $species === "parrot" ? "selected" : ""?> value="parrot">Papoušek</option>
                    <option <?php echo $species === "other" ? "selected" : ""?> value="other">Jiné zvířátko</option>
                </select>
                <p class="invalid" id="speciesInvalid"><?php echo $species_error?></p>
            </div>
            <div class="radios">
                <h4>Pohlaví</h4>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio" id="radio1" value="samec" 
                        <?php echo ($gender !== "samice" && $gender !== "hermafrodit") ? "checked" : ""?>
                    >
                    <label class="form-check-label" for="radio1">Samec</label>
                    <br>
                    <input class="form-check-input" type="radio" name="radio" id="radio2" value="samice"
                        <?php echo $gender === "samice" ? "checked" : ""?>
                    >
                    <label class="form-check-label" for="radio2">Samice</label>
                    <br>
                    <input class="form-check-input" type="radio" name="radio" id="radio3" value="hermafrodit"
                        <?php echo $gender === "hermafrodit" ? "checked" : ""?>
                    >
                    <label class="form-check-label" for="radio3">Hermafrodit</label>
                </div>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="agreement" name="agreement"
                    <?php echo $agreement ? "checked" : ""?>
                >
                <label class="form-check-label" for="agreement">
                    Souhlasím s podmínkami
                </label>
                <p class="invalid" id="agreementInvalid"><?php echo $agreement_error?></p>
            </div>
            <div>
                <button type="submit" class="btn btn-danger" id="btnSubmit">Odeslat formulář</button>
            </div>
        </form>
    </div>
    <?php echo $validation_redirection ?>
</body>
</html>