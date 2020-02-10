<?php
    declare( strict_types = 1 );
    // Session Variables
    session_start();
    $_SESSION[ 'Contact' ][ 'Success' ]     = FALSE;    
    $_SESSION[ 'Weather' ][ 'Location' ]    = NULL;
    $_SESSION[ 'Weather' ][ 'Forecast' ]    = NULL;
    // Page Variables
    $path       = '../';
    $subtitle   = 'Weather';
    
    // autoload class files
    require_once $path . '_php/autoload1.php'; 
    
    $post_weatherLocation   = '';
    $post_weatherForecast   = '';
    $eMessage               = '';
    $eSuccess               = '';
    $h2_result              = 'We await your data';
    
    if( !empty( $_POST ) )
    {
        $post_weatherLocation   = (string) trim(
            filter_input( INPUT_POST, 'weatherLocation' )
        );
        $post_weatherForecast   = (string) trim(
            filter_input( INPUT_POST, 'weatherForecast' )
        );
        
        /*
         * TODO: Server-side validation         * 
         */
        
        $cookie_expire  = time() + (86400 * 30); // 30 days from now
        setcookie(
            'jephmann_weatherLocation',
            $post_weatherLocation,
            $cookie_expire,
            '/'
        );
        setcookie(
            'jephmann_weatherForecast',
            $post_weatherForecast,
            $cookie_expire,
            '/'
        );        
        
        $_SESSION[ 'Weather' ][ 'Location' ]    = (string) $post_weatherLocation;
        $_SESSION[ 'Weather' ][ 'Forecast' ]    = (int) $post_weatherForecast;

        // ensure data not resent during refresh
        unset( $_POST );
        header( 'Location:' . $_SERVER[ 'PHP_SELF' ] );
    }
    
    $location   = isset( $_COOKIE[ 'jephmann_weatherLocation' ]  )
                ? (string) $_COOKIE[ 'jephmann_weatherLocation' ]
                : $_SESSION[ 'Weather' ][ 'Location' ];
    $forecast   = isset( $_COOKIE[ 'jephmann_weatherForecast' ] )
                ? (int) $_COOKIE[ 'jephmann_weatherForecast' ]
                : $_SESSION[ 'Weather' ][ 'Forecast' ];
    
    if( $location )
    {
        // test
        //$location = '63119';
        //$forecast = 0;
        
        $myWeather      = new ApiWeather();
        $dataWeather    = $myWeather->getWeatherJSON(
            $location, $forecast
        );

        // THE ONE: main data
        $aLocation          = array_key_exists( 'location', $dataWeather )
                            ? $dataWeather[ 'location' ]
                            : array();
        $aCurrent           = array_key_exists( 'current', $dataWeather )
                            ? $dataWeather[ 'current' ]
                            : array();
        $aCurrentCondition  = array_key_exists( 'condition', $aCurrent )
                            ? $aCurrent[ 'condition' ]
                            : array();
        $aAlert             = array_key_exists( 'alert', $dataWeather )
                            ? $dataWeather[ 'alert' ]
                            : array();
        
        $locale             = $post_weatherLocation;
        if($aLocation)
        {
            $locale         .= " {$aLocation[ 'country' ]}: {$aLocation[ 'name' ]}";
            $locale         .= $aLocation[ 'region' ] 
                            ? ", {$aLocation['region']}"
                            : '';
        }            
            
        $timeOfDay          = '';
        $lastUpdated        = '';
        $tempC              = '';
        $tempF              = '';
        $feelslikeC         = '';
        $feelslikeF         = '';
        $windKPH            = '';
        $windMPH            = '';
        if($aCurrent)
        {
            $timeOfDay      = $aCurrent[ 'is_day' ] ? 'Daytime' : 'Evening';
            $lastUpdated    = $aCurrent[ 'last_updated' ];
            $tempC          = "{$aCurrent[ 'temp_c' ]}&deg; C";
            $tempF          = "{$aCurrent[ 'temp_f' ]}&deg; F";
            $feelslikeC     = "{$aCurrent[ 'feelslike_c' ]}&deg; C";
            $feelslikeF     = "{$aCurrent[ 'feelslike_f' ]}&deg; F";
            $windKPH        = "{$aCurrent[ 'wind_kph' ]} kph,"
                            . " gusting at {$aCurrent[ 'gust_kph' ]} kph";
            $windMPH        = "{$aCurrent[ 'wind_mph' ]} mph,"
                            . " gusting at {$aCurrent[ 'gust_mph' ]} mph";
        }            

        $conditionText      = '';
        $conditionIcon      = '';            
        if($aCurrentCondition)
        {
            $conditionText  = $aCurrentCondition[ 'text' ];
            $conditionIcon  = $aCurrentCondition[ 'icon' ];
        }
        
        if ($aCurrent)
            $h2_result = $locale;
        else
            $h2_result = 'Please Try Again';

        // THE MANY: forecasts if any
        $aForecast  = array_key_exists( 'forecast', $dataWeather )
                    ? $dataWeather[ 'forecast' ]
                    : NULL;
    }
    
    // paths
    $views = $path . '_views/';  

    /*
     *  Custom (per page) meta
     */
    $meta_image         = 'http://jephmann.com/_images/me201708_LI.jpg';
    $meta_description   = 'Weather data courtesy of WeatherAPI.com | ';
    $meta_querystring   = (string) NULL;
    /*
     *  HTML start
     */
    require_once $views . 'head.php';
    require_once $views . 'navbar.php';
    require_once $views . 'header.php';
    require_once $views . 'open-jumbotron.php';
?>    
        
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">

                <h2>The Weather Section</h2>
                
                <?php if( $eMessage ) : ?>
                
                <div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close"
                        data-dismiss="alert">&times;</button>
                    <strong>Warning:</strong>
                    <?php echo $eMessage; ?>
                </div>
                
                <?php elseif( $_SESSION[ 'Contact'][ 'Success' ] ) : ?>
                
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close"
                        data-dismiss="alert">&times;</button>
                    <strong>See Weather!</strong>
                    <?php echo $eSuccess; ?>
                </div>
                
                <?php endif; ?>
                
                <div id="weather"></div>
                
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8">                
                
                <h2><?php echo $h2_result; ?></h2>
                
                <?php if( $aCurrent ) : ?>
                
                <h3>
                    <img src="<?php echo $conditionIcon; ?>" />
                    <?php echo $timeOfDay; ?>:
                    <span class="text-success"><?php echo $conditionText; ?></span>;
                    <span class="text-info"><?php echo $tempC; ?></span>
                    /
                    <span class="text-info"><?php echo $tempF; ?></span>
                </h3>
                
                <?php if ($aAlert) : ?>                
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-danger"><?php
                            echo $aAlert[ 'headline' ]; ?></h4>
                        <h6 class="card-subtitle mb-2 text-warning"><?php
                            echo $aAlert[ 'note' ]; ?></h6>
                        <p class="card-text text-info" style="font-size:1em;">
                            <?php echo $aAlert[ 'instruction' ]; ?>
                        </p>
                        <pre>
                            <?php echo $aAlert[ 'desc' ]; ?>
                        </pre>
                        <ul>
                            <li>Effective: <?php echo $aAlert[ 'effective' ]; ?></li>
                            <li>Expires: <?php echo $aAlert[ 'expires' ]; ?></li>
                        </ul>                        
                    </div>
                </div>                
                <?php endif; ?>
                
                <table class="table table-hover">
                    <tbody>
                        <tr class="table-primary">
                            <th scope="row">
                                Feels Like
                            </th>
                            <td class="text-info">
                                <?php echo $feelslikeC; ?>
                                
                            </td>
                            <td class="text-info">
                                <?php echo $feelslikeF; ?>
                            </td>
                        </tr>
                        <tr class="table-primary">
                            <th scope="row">
                                Wind
                                <?php echo $aCurrent[ 'wind_dir' ]; ?>
                                <?php echo $aCurrent[ 'wind_degree' ]; ?>
                            </th>
                            <td class="text-info">
                                <?php echo $windKPH; ?>
                                
                            </td>
                            <td class="text-info">
                                <?php echo $windMPH; ?>
                                
                            </td>
                        </tr>
                        <tr class="table-primary">
                            <th scope="row">
                                Pressure
                            </th>
                            <td class="text-info">
                                <?php echo $aCurrent[ 'pressure_mb' ]; ?> mb
                            </td>
                            <td class="text-info">
                                <?php echo $aCurrent[ 'pressure_in' ]; ?>"Hg
                            </td>
                        </tr>
                        <tr class="table-primary">
                            <th scope="row">
                                Precipitation
                            </th>
                            <td class="text-info">
                                <?php echo $aCurrent[ 'precip_mm' ]; ?> mm
                            </td>
                            <td class="text-info">
                                <?php echo $aCurrent[ 'precip_in' ]; ?> in
                            </td>
                        </tr>
                        <tr class="table-primary">
                            <th scope="row">
                                Visibility
                            </th>
                            <td class="text-info">
                                <?php echo $aCurrent[ 'vis_km' ]; ?> km
                            </td>
                            <td class="text-info">
                                <?php echo $aCurrent[ 'vis_miles' ]; ?> miles
                            </td>
                        </tr>
                        <tr class="table-primary">
                            <th scope="row">
                                Humidity
                            </th>
                            <td colspan="2" class="text-info">
                                <?php echo $aCurrent[ 'humidity' ]; ?>%
                            </td>
                        </tr>
                        <tr class="table-primary">
                            <th scope="row">
                                Cloudiness
                            </th>
                            <td colspan="2" class="text-info">
                                <?php echo $aCurrent[ 'cloud' ]; ?>%
                            </td>
                        </tr>
                        <tr class="table-primary">
                            <th scope="row">
                                UV Index
                            </th>
                            <td colspan="2" class="text-info">
                                <?php echo $aCurrent[ 'uv' ]; ?>
                                
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                Last updated
                                (<?php echo $aLocation[ 'name' ]; ?> time)
                                <?php echo $lastUpdated; ?>
                                
                            </td>
                        </tr>
                    </tfoot>
                </table>
                
                <?php else : ?>
                
                <p>
                    For today's weather, simply enter a location into the form:
                </p>
                <ul>
                    <li>City Name</li>
                    <li>US ZIP Code (5 digits)</li>
                    <li>Canada postal code</li>
                    <li>UK postcode</li>
                    <li>IATA code
                        (3-letter International Air Transport Association code
                        prefixed with "iata:", no spaces)</li>
                    <li>METAR code
                        (prefixed with "metar:", no spaces)</li>
                    <li>Decimal-degree Latitude and Longitude
                        (latitude, comma, longitude; no spaces)</li>
                    <li>IP Address (IPv4 and IPv6 supported)</li>
                </ul>
                <p>
                    If you want additional forecasts for your location, simply
                    select a number (in days) in the form.
                </p>
                <p>
                    No, I do not save any of the data.
                    Yes, cookies may apply.
                </p>
                
                
                <?php endif; ?>
                
            </div>                
        </div>
    </div>    

<?php
    require_once $views . 'close-jumbotron.php';
?>
    
<div class="container">
    <div class="row">        
        <div class="col-lg-12 col-md-12 col-sm-12">
        
            <?php if( $forecast ) : ?>
            <h3>
                Your <?php
                    echo $forecast;
                ?>-day Forecast for <?php
                    echo $locale;
                ?>:
            </h3>
            
            <?php foreach( $aForecast['forecastday'] as $aDay) : 

                $dailyDate      = new DateTime( $aDay[ 'date' ] );
                $dailyWeekDay   = $dailyDate->format( 'l' );
                $dailyMonthDay  = $dailyDate->format( 'M j' );
                $daily          = $aDay[ 'day' ];
                $dailyCondition = $daily[ 'condition' ][ 'text' ];
                $dailyIcon      = $daily[ 'condition' ][ 'icon' ];
                $tempHiF        = $daily[ 'maxtemp_f' ] . '&deg; F';
                $tempHiC        = $daily[ 'maxtemp_c' ] . '&deg; C';
                $tempLoF        = $daily[ 'mintemp_f' ] . '&deg; F';
                $tempLoC        = $daily[ 'mintemp_c' ] . '&deg; C';
                $tempAvF        = $daily[ 'avgtemp_f' ] . '&deg; F';
                $tempAvC        = $daily[ 'avgtemp_c' ] . '&deg; C';
                $windM          = $daily[ 'maxwind_mph' ] . ' mph';
                $windK          = $daily[ 'maxwind_kph' ] . ' kph';
                $precipM        = $daily[ 'totalprecip_mm' ] . ' mm';
                $precipI        = $daily[ 'totalprecip_in' ] . ' in';
                $visK           = $daily[ 'avgvis_km' ] . ' km';
                $visM           = $daily[ 'avgvis_miles' ] . ' miles';
            ?>

            <div class="col-lg-3 col-md-3 col-sm-3">
                <h4 style="text-align: center;">
                    <?php echo $dailyWeekDay ?>,
                    <?php echo $dailyMonthDay ?>
                </h4>
                <p style="text-align: center;">
                <img src="<?php echo $dailyIcon ?>" />
                </p>
                <h5 class="text-success" style="text-align: center;">
                    <?php echo $dailyCondition ?>
                </h5>
                <table class="table table-hover">
                    <tr>
                        <th colspan="2">
                        Temps
                        </th>
                    </tr>
                    <tr>
                        <td>Hi</td>
                        <td class="text-info">
                            <?php echo $tempHiC; ?>
                            /
                            <?php echo $tempHiF; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Lo</td>
                        <td class="text-info">
                            <?php echo $tempLoC; ?>
                            /
                            <?php echo $tempLoF; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Av</td>
                        <td class="text-info">
                            <?php echo $tempAvC; ?>
                            /
                            <?php echo $tempAvF; ?>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">
                        Wind
                        </th>
                    </tr>
                    <tr class="text-info">
                        <td><?php echo $windK; ?></td>
                        <td><?php echo $windM; ?></td>
                    </tr>
                    <tr>
                        <th colspan="2">
                        Precipitation   
                        </th>
                    </tr>
                    <tr class="text-info">
                        <td><?php echo $precipM; ?></td>
                        <td><?php echo $precipI; ?></td>
                    </tr>
                    <tr>
                        <th colspan="2">
                        Visibility   
                        </th>
                    </tr>
                    <tr class="text-info">
                        <td><?php echo $visK; ?></td>
                        <td><?php echo $visM; ?></td>
                    </tr>


                </table>
            </div>

            <?php endforeach; ?>        

            <?php endif; ?>
            
            <div class="col-lg-3 col-md-3 col-sm-3">                
                        
                <h4>About the Weather Section</h4>
            
                <ul>
                    <li>
                        Data and links to images for the Weather section come
                        from <a target="_blank"                       
                        data-toggle="tooltip" data-placement="bottom"
                        data-original-title="Free Weather API"
                        href="https://www.weatherapi.com/"
                        title="Free Weather API">Free Weather API</a>.
                    </li>
                    <li>
                        As with the Contact form, this Weather form uses ReactJS
                        and Babel.
                    </li>
                    <li>
                        Live since February 2020, this section replaces a
                        previous version which, from Spring 2017 through early
                        2019, used a completely different free API until it was
                        no longer free. (No, I don't know whether I can add a
                        "radar" image like before. We shall see.)
                    </li>
                    <li>
                        As I write this (2020.02.09), this page is still a
                        little buggy in my view. As this project is a
                        "workshop", it's kind of the idea anyhow, as this is
                        where I stay in practice working on such things.
                    </li>
                </ul>
                
                <h4 style="text-align: center; background-color: #336633;">
                    Powered by: <a                        
                    data-toggle="tooltip" data-placement="bottom"
                    data-original-title="Free Weather API"
                    href="https://www.weatherapi.com/"
                    title="Free Weather API"><img
                    src='//cdn.weatherapi.com/v4/images/weatherapi_logo.png'
                    alt="Weather data by WeatherAPI.com"
                    border="0"></a>
                </h4>
                
            </div>
            
        </div>        
    </div>
</div>

<?php
    require_once $views . 'footer.php';
    require_once $views . 'load/jquery.php';
    require_once $views . 'load/bootstrap.php';
    require_once $path . '_views/load/reactJS.php';
?>

    <script type="text/babel"
        src="<?php echo $path; ?>_js/weather.js"></script>
<?php
    require_once $views . 'load/google-analytics.php';
    require_once $views . 'foot.php';    
    /*
     *  HTML end
     */