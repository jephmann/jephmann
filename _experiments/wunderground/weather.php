
<?php
    /*
     * Ideally I would break this entire file into separate files,
     * one for the class and one for the file which loads it.
     */

     // API CLASS
     class Api
     {         
        private $key = "fa4a10d736578d22";
        private $url = "http://api.wunderground.com";

        // retrieve appropriate URLs
        public function url_base()
        {
            $result = "{$this->url}/api/{$this->key}";
            return $result;
        }

        public function url_forecast()
        {
            $result = "{$this->url_base()}/forecast/q";
            return $result;
        }
        
        // the exercise called for a ZIP Code; this is a bonus
        public function url_forecast_citystate($city, $state)
        {
            $result = "{$this->url_forecast()}/{$state}/{$city}.json";
            return $result;
        }

        public function url_forecast_zip($zip)
        {
            $result = "{$this->url_forecast()}/{$zip}.json";
            return $result;
        }        
            
        public static function retrieve($url)
        {
            $json = file_get_contents($url);
            return json_decode($json, true); 
        }
     }
     
     /*
      * From here I am doing only ZIP-related stuff.
      */

     $zip = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_STRING);
     if (strlen($zip) === 5)
     {
        $obj_api = new Api;
        $url_zip = $obj_api->url_forecast_zip($zip);
        $data_zip = Api::retrieve($url_zip);
        
        /* ZIP stuff (whether I use all of it or not) */
        
        /*
         * [RESPONSE array]
         */        
        $response                   = $data_zip["response"];
        $response_version           = htmlentities($response["version"], ENT_QUOTES, 'UTF-8');
        $response_termsofService    = htmlentities($response["termsofService"], ENT_QUOTES, 'UTF-8');
        $response_features          = $response["features"];
        $response_features_forecast = htmlentities($response_features["forecast"], ENT_QUOTES, 'UTF-8');
            
        /*
         * [FORECAST array]
         */        
        $forecast           = $data_zip["forecast"];
        $forecast_text      = $forecast["txt_forecast"];    // not using for this exercise
        $forecast_simple    = $forecast["simpleforecast"];  // contains the 3-day forecast
        
        foreach ($forecast_simple["forecastday"] as $forecastday)
        {
            $forecastday_date = $forecastday["date"]["weekday"] .', '. $forecastday["date"]["pretty"];
            $forecastday_icon_url = $forecastday["icon_url"];
            $forecastday_icon = $forecastday["icon"];
            $forecastday_conditions = $forecastday["conditions"];
            $forecastday_high_F = $forecastday["high"]["fahrenheit"];
            $forecastday_low_F = $forecastday["low"]["fahrenheit"];
            $forecastday_high_C = $forecastday["high"]["celsius"];
            $forecastday_low_C = $forecastday["low"]["celsius"];
            $forecastday_F = "High {$forecastday_high_F} / Low {$forecastday_low_F} (F)";
            $forecastday_C = "High {$forecastday_high_C} / Low {$forecastday_low_C} (C)";
            
            if ($forecastday["date"]["day"] != date("d")) {
                echo "<div class=\"col-md-4\">";
                echo "<h3>{$forecastday_date}</h3>";
                echo "<h2>{$forecastday_conditions}</h2>";
                echo "<img src=\"{$forecastday_icon_url}\" alt=\"{$forecastday_icon}\" >";
                echo "<h3>{$forecastday_F}</h3>";
                echo "<h3>{$forecastday_C}</h3>";
                echo "</div>";
            }
        }        
        // Necessary or not, a simple way to test retrieval of data
        echo "<p><a target=\"_blank\" href=\"{$response_termsofService}\">"
            . "WEATHER UNDERGROUND API TERMS AND CONDITIONS OF USE"
            . "</a><br />Version: {$response_version} | Forecast: {$response_features_forecast}</p>";
        
        /*
         * What I normally would not do except for testing purposes:
         * Display raw data
         */
        /*
        echo "<details>
            <summary>Raw Data (Forecast by ZIP)</summary>
            <pre>";
        print_r($data_zip);
        echo "</pre>                
            </details>";         * 
         */
        
     }
     else
     {
        echo "<div class=\"col-md-12\">"
            . "<h3>"
            . "We await a 5-digit US ZIP code (no more, no less). Please try again. Thanks!"
            . "</h3>"
            . "</div>";
     }