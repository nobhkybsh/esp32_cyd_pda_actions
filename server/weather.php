<?php
$lat = floatval($_GET['lat'] ?? 0);
$lon = floatval($_GET['lon'] ?? 0);
echo weather($lat, $lon);

function weather($lat, $lon) {
        // Погода
        $replyWeatherJson = file_get_contents("https://api.open-meteo.com/v1/forecast?latitude=$lat&longitude=$lon&current_weather=true&windspeed_unit=ms");
        $replyWeather = json_decode($replyWeatherJson, true);
        $temp = $replyWeather['current_weather']['temperature'];
        $wind = $replyWeather['current_weather']['windspeed'];
        $dir = $replyWeather['current_weather']['winddirection'];
        $code = $replyWeather['current_weather']['weathercode'];
        $codeToText = [
                "0" => "clear sky",
                "1" => "mainly clear",
                "2" => "partly cloudly",
                "3" => "overcast",
                "45" => "fog",
                "48" => "depositing rime fog",
                "51" => "light drizzle",
                "53" => "moderate drizzle",
                "55" => "dense drizzle",
                "56" => "light freezing drizzle",
                "57" => "dense freezing drizzle",
                "61" => "slight rain",
                "63" => "moderate rain",
                "65" => "dense rain",
                "66" => "light freezing rain",
                "67" => "dense freezing rain",
                "71" => "slight snow",
                "73" => "moderate snow",
                "75" => "dense snow",
                "77" => "snow grains",
                "80" => "slight rain showers",
                "81" => "moderate rain showers",
                "82" => "violent rain showers",
                "85" => "slight snow showers",
                "86" => "heavy snow showers",
                "95" => "thunderstorm",
                "96" => "thunderstorm with light hail",
                "99" => "thunderstorm with heavy hail",
        ];
        if(isset($codeToText[$code])) {
                $weatherText = $codeToText[$code];
        }
        else {
                $weatherText = "unknown $code";
        }
        $reply .= "$temp C, $wind m/s, $weatherText";
        return $reply;
}
