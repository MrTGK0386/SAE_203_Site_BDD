<?php
    session_start();

    include_once '../../../user_hook/protection.php';
?>


<!DOCTYPE html>
<html>

<head>
    <title>Modifier les tremblements de terre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100">
    <?php
    include_once '../../../sql_usage/SQLConnection.php';


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];

            if ($action === 'create') {
                $requiredFields = ['gap', 'magnitude', 'significance', 'depth', 'distance', 'fullLocation', 'latitude', 'longitude', 'locationName', 'day', 'epoch', 'fullTime', 'hour', 'minute', 'month', 'second', 'year'];

                $allFieldsProvided = true;
                foreach ($requiredFields as $field) {
                    if (!isset($_POST[$field]) || empty($_POST[$field])) {
                        $allFieldsProvided = false;
                        break;
                    }
                }

                if ($allFieldsProvided) {
                    $gap = $_POST['gap'];
                    $magnitude = $_POST['magnitude'];
                    $significance = $_POST['significance'];
                    $depth = $_POST['depth'];
                    $distance = $_POST['distance'];
                    $fullLocation = $_POST['fullLocation'];
                    $latitude = $_POST['latitude'];
                    $longitude = $_POST['longitude'];
                    $locationName = $_POST['locationName'];
                    $day = $_POST['day'];
                    $epoch = $_POST['epoch'];
                    $fullTime = $_POST['fullTime'];
                    $hour = $_POST['hour'];
                    $minute = $_POST['minute'];
                    $month = $_POST['month'];
                    $second = $_POST['second'];
                    $year = $_POST['year'];

                    createEvent($conn, $gap, $magnitude, $significance, $depth, $distance, $fullLocation, $latitude, $longitude, $locationName, $day, $epoch, $fullTime, $hour, $minute, $month, $second, $year);
                } else {
                    echo "<script>alert('Veuillez remplir tout les champs, si vous n avez pas la valeur mettre NULL dans le champ.')</script>";
                }
            }
        }
    }


    function createEvent($conn, $gap, $magnitude, $significance, $depth, $distance, $fullLocation, $latitude, $longitude, $locationName, $day, $epoch, $fullTime, $hour, $minute, $month, $second, $year)
    {
        $tableName = "sae203_eq";
        $gap = mysqli_real_escape_string($conn, $gap);
        $magnitude = mysqli_real_escape_string($conn, $magnitude);
        $significance = mysqli_real_escape_string($conn, $significance);
        $depth = mysqli_real_escape_string($conn, $depth);
        $distance = mysqli_real_escape_string($conn, $distance);
        $fullLocation = mysqli_real_escape_string($conn, $fullLocation);
        $latitude = mysqli_real_escape_string($conn, $latitude);
        $longitude = mysqli_real_escape_string($conn, $longitude);
        $locationName = mysqli_real_escape_string($conn, $locationName);
        $day = mysqli_real_escape_string($conn, $day);
        $epoch = mysqli_real_escape_string($conn, $epoch);
        $fullTime = mysqli_real_escape_string($conn, $fullTime);
        $hour = mysqli_real_escape_string($conn, $hour);
        $minute = mysqli_real_escape_string($conn, $minute);
        $month = mysqli_real_escape_string($conn, $month);
        $second = mysqli_real_escape_string($conn, $second);
        $year = mysqli_real_escape_string($conn, $year);

        $query = "INSERT INTO $tableName (`impact.gap`, `impact_magnitude`, `impact.significance`, `location.depth`, `location-distance`, `location.full`, `location_latitude`, `location_longitude`, `location.name`, `time.day`, `time.epoch`, `time.full`, `time.hour`, `time.minute`, `time.month`, `time.second`, `time.year`) VALUES ('$gap', '$magnitude', '$significance', '$depth', '$distance', '$fullLocation', '$latitude', '$longitude', '$locationName', '$day', '$epoch', '$fullTime', '$hour', '$minute', '$month', '$second', '$year')";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Error creating event: " . mysqli_error($conn));
        }

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    ?>
    <div class="m-auto">
        <h2>Ajouter un tremblement de terre</h2>


        <form class="form d-flex flex-column" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="action" value="create">
            <div class="d-flex">
                <div class="w-50 p-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Taille de l'impact</span>
                        <input type="text" class="form-control" placeholder="Taille" name="gap">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Magnitude</span>
                        <input class="form-control" placeholder="Magnitude" type="text" name="magnitude">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Importance</span>
                        <input class="form-control" placeholder="Importance" type="text" name="significance">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Profondeur</span>
                        <input class="form-control" placeholder="Profondeur" type="text" name="depth">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Distance</span>
                        <input class="form-control" placeholder="Distance" type="text" name="distance">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Lieu</span>
                        <input class="form-control" placeholder="Lieu" type="text" name="fullLocation">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Latitude</span>
                        <input class="form-control" placeholder="Latitude" type="text" name="latitude">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Longitude</span>
                        <input class="form-control" placeholder="Longitude" type="text" name="longitude">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Nom du lieu</span>
                        <input class="form-control" placeholder="Nom du lieu" type="text" name="locationName">
                    </div>
                </div>
                <div class="w-50 p-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Jour</span>
                        <input class="form-control" placeholder="Jour" type="text" name="day">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Epoque</span>
                        <input class="form-control" placeholder="Epoque" type="text" name="epoch">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Temp complet</span>
                        <input class="form-control" placeholder="Temp complet" type="text" name="fullTime">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Heure</span>
                        <input class="form-control" placeholder="Heure" type="text" name="hour">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Minute</span>
                        <input class="form-control" placeholder="Minute" type="text" name="minute">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Mois</span>
                        <input class="form-control" placeholder="Mois" type="text" name="month">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Secondes</span>
                        <input class="form-control" placeholder="Secondes" type="text" name="second">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Année</span>
                        <input class="form-control" placeholder="Année" type="text" name="year">
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