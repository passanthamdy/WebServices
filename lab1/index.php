<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once("vendor/autoload.php");
$currentCity = '';
$cities = Weather::getCities();

$filterdCities = json_decode($cities, true);
$result = array();
if (isset($_POST['getweather'])) {
    $r = Weather::getWeather($_POST['city']);
    $result = json_decode($r, true);
    $currentCity = $_POST['city'];
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather </title>
</head>

<body>
    <form method="post">
        <select name="city" id="city">
            <?php
            foreach ($filterdCities as $city) {
                echo "<option name='{$city['name']}'>{$city['name']}</option>";
            }
            ?>
        </select>
        <input type="submit" name="getweather" value="Get Weather">
    </form>
    <?php
    $date = new DateTime("now");
    echo "<h1>$currentCity Weather Status</h1>";
    if (!empty($result)) {
        echo "<p>" . date_format($date, 'l g:i a') . "</p>";
        echo "<p> {$result['main']['temp_max']}°C <br>{$result['main']['temp_min']}°C</p>";
        echo "<p>Humidity: {$result['main']['humidity']}%</p>";
        echo "<p>Wind: {$result['wind']['speed']} km/h</p>";
    } else {
        echo "";
    }
    ?>
</body>

</html>