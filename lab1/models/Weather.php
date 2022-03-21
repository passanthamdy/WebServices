
<?php

class Weather
{

    public static function getWeather($city)
    {
        $url = "https://api.openweathermap.org/data/2.5/weather?q=$city&units=metric&appid=6da0bda669a7014f89d3e3d21a32ea20";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $weather = json_decode(curl_exec($curl), true);

        if (isset($weather['weather'])) {
            $result = json_encode($weather);
        } else {
            $result = "404 not found";
        }
        return $result;
    }
    public static function getCities()
    {
        $cities = json_decode(file_get_contents("./utilities/city.list.json"), true);

        $flag = "EG";
        $eg_cities = array_filter($cities, function ($var) use ($flag) {
            return ($var['country'] == $flag);
        });

        $json_cities = json_encode($eg_cities);
        return $json_cities;
    }
}
