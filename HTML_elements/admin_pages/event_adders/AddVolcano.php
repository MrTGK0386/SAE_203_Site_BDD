<!DOCTYPE html>
<html>

<head>
    <title>Edit Event Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100">
    <?php
    include_once '../../../sql_usage/SQLConnection.php';


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];

            if ($action === 'create') {
                $requiredFields = ['volcano_name', 'magnitude', 'significance', 'depth', 'distance', 'fullLocation', 'latitude', 'longitude', 'locationName', 'day', 'epoch', 'fullTime', 'hour', 'minute', 'month', 'second', 'year'];

                $allFieldsProvided = true;
                foreach ($requiredFields as $field) {
                    if (!isset($_POST[$field]) || empty($_POST[$field])) {
                        $allFieldsProvided = false;
                        break;
                    }
                }

                if ($allFieldsProvided) {
                    $volcano_name = $_POST['volcano_name'];


                    createEvent($conn, $volcano_name);
                } else {
                    echo "<script>alert('Veuillez remplir tout les champs, si vous n avez pas la valeur mettre NULL dans le champ.')</script>";
                }
            }
        }
    }


    // Function to create a new event
    function createEvent($conn, $volcano_name)
    {
        $tableName = "sae203_eq";
        $volcano_name = mysqli_real_escape_string($conn, $volcano_name);
        

        $query = "INSERT INTO $tableName (`volcano_name`) VALUES ('$volcano_name')";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Error creating event: " . mysqli_error($conn));
        }

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    ?>
    <div class="m-auto">
        <h2>Ajouter un volcan</h2>


        <form class="form d-flex flex-column" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="action" value="create">
            <div class="d-flex">
                <div class="w-50 p-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Nom du volcan</span>
                        <input type="text" class="form-control" placeholder="Nom" name="volcano_name">
                    </div>
                    
                </div>
                <div class="w-50 p-3">
                <div class="input-group mb-3">
                        <span class="input-group-text">Nom du volcan</span>
                        <input type="text" class="form-control" placeholder="Nom" name="volcano_name">
                    </div>
                    
                </div>
            </div>
            <div class="m-auto">
                <input class="btn btn-success" type="submit" value="Ajouter">
            </div>

        </form>
        <div class="m-auto mt-2">
            <button class="btn btn-primary m-auto" onclick="location.href='../addEventList.php'">Ajouter d'autres événements.</button>
        </div>
    </div>


</body>

</html>