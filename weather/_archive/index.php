<?php
    declare( strict_types = 1 );
    // Session Variables
    session_start();
    $_SESSION['Contact']['Success'] = FALSE;
    // Page Variables
    $path       = '../';
    $subtitle   = 'Weather (via Weather Underground)';

    // autoload class files
    require_once $path . '_php/autoload1.php';
    $weatherAPI     = new ApiWUnderground;
    $features       = (array) $weatherAPI->features;
    $locations      = (array) $weatherAPI->locations;
    $ctLocations    = (int) count( $locations );
    
    // default
    $city   = isset($_COOKIE['jephmann_weather_city'])
            ? $_COOKIE['jephmann_weather_city']
            : 'Chicago';
    $state  = isset($_COOKIE['jephmann_weather_state'])
            ? $_COOKIE['jephmann_weather_state']
            : 'IL';
    $zip    = isset($_COOKIE['jephmann_weather_zip'])
            ? $_COOKIE['jephmann_weather_zip']
            : '60613';
    $eZip       = '';
    $showZip    = '';
       
    if ( isset( $_POST[ 'wZIP' ] ) )
    {
        $zip        = (string) $_POST[ 'wZIP' ];
        
        // server-side validation of ZIP code
        if ( !preg_match( "/^[0-9]{5}(?:-[0-9]{4})?$/", $zip ))
        {
            $eZip   = "<p style='color:orange;font-size:small;'>"
                    . "5-digit U.S. ZIP Code required."
                    . "</p>";
        }
        else
        {
            $location   = $weatherAPI->getLocationViaZip( $zip );
            // Cover if ZIP not in WU system.
            if( empty($location[ 'city' ]) or empty($location[ 'state' ]))
            {
                $eZip   = "<p style='color:orange;font-size:small;'>"
                        . "Please try a different U.S. ZIP Code."
                        . "</p>";
            }
            else
            {
                // populate variables with values
                $city       = (string) $location[ 'city' ];
                $state      = (string) $location[ 'state' ];
                $showZip    = "&nbsp;({$zip})";
                // update cookies
                $cookie_expire  = time() + (86400 * 30); // 30 days from now
                setcookie(
                    'jephmann_weather_city',
                    $city,
                    $cookie_expire,
                    '/'
                );
                setcookie(
                    'jephmann_weather_state',
                    $state,
                    $cookie_expire,
                    '/'
                );
                setcookie(
                    'jephmann_weather_zip',
                    $zip,
                    $cookie_expire,
                    '/'
                );
            }
        }
    }
       
    if ( isset( $_POST[ 'wCity' ] ) )
    {
        $weatherCity    = (int) $_POST[ 'wCity' ];
        $city           = (string) $locations[ $weatherCity ][ 'city' ];
        $state          = (string) $locations[ $weatherCity ][ 'state' ];
    }
    
    // alert feature
    /*
    $arrayAlerts    = (array) $weatherAPI->arrayReport(
        'alerts', $city, $state
        );
    $alerts         = (array) $arrayAlerts[ 'alerts' ];
    $ctAlerts       = (int) count( $alerts );
     * 
     */
    
    // conditions feature
    /*
    $arrayConditions   = (array) $weatherAPI->arrayReport(
        'conditions', $city, $state
        );    
    $current                = (array) $arrayConditions['current_observation'];
    $current_weather        = (string) $current[ 'weather' ];
    $current_temperature    = (string) $current[ 'temperature_string' ];
    $current_feel           = (string) $current[ 'feelslike_string' ];
    $current_wind           = (string) $current[ 'wind_string' ];
    $current_humidity       = (string) $current[ 'relative_humidity' ];
    $current_precip         = (string) $current[ 'precip_today_string' ];
    $current_icon           = (string) $current[ 'icon_url' ];
    $current_icon_alt       = basename( $current_icon, '.gif' );
     * 
     */
    
    // almanac feature
    /*
    $arrayAlmanac   = (array) $weatherAPI->arrayReport(
        'almanac', $city, $state
        );    
    $almanac                = (array) $arrayAlmanac['almanac'];    
    $almanacHigh            = (array) $almanac['temp_high'];    
    $almanacHighNormal      = (array) $almanacHigh['normal'];
    $almanacHighNormalF     = (int) $almanacHighNormal['F'];
    $almanacHighNormalC     = (int) $almanacHighNormal['C'];    
    $almanacHighRecord      = (array) $almanacHigh['record'];
    $almanacHighRecordF     = (int) $almanacHighRecord['F'];
    $almanacHighRecordC     = (int) $almanacHighRecord['C'];    
    $almanacHighRecordYear  = (int) $almanacHigh['recordyear'];    
    $almanacLow             = (array) $almanac['temp_low'];    
    $almanacLowNormal       = (array) $almanacLow['normal'];
    $almanacLowNormalF      = (int) $almanacLowNormal['F'];
    $almanacLowNormalC      = (int) $almanacLowNormal['C'];    
    $almanacLowRecord       = (array) $almanacLow['record'];
    $almanacLowRecordF      = (int) $almanacLowRecord['F'];
    $almanacLowRecordC      = (int) $almanacLowRecord['C'];    
    $almanacLowRecordYear   = (int) $almanacLow['recordyear'];
     * 
     */

    // forecast feature
    /*
    $arrayForecast = $weatherAPI->arrayReport(
        'forecast', $city, $state
        );
    $forecast       = (array) $arrayForecast[ 'forecast' ];
    $forecastDay    = (array) $forecast['txt_forecast']['forecastday'];
    $ctForecastDay  = (int) count( $forecastDay );
     * 
     */
    
    // radar
    $urlRadar       = (string) $weatherAPI->urlRadar( $city, $state );
    
    // City/State/ZIP string
    $csz = "{$city}, {$state}{$showZip}";
    
    // paths
    $views = $path . '_views/';
    
    

    /*
     *  Custom (per page) meta
     */
    $meta_image         = 'http://jephmann.com/_images/logos/iw63kb1u.bmp';
    $meta_description   = 'Weather data courtesy of WeatherUnderground.com | ';
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
                
                <h3>2017-2019</h3>
                
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <h2>SECTION SUSPENDED</h2>
                <p>
                    A few months back, the source of the weather data for this
                    section announced changes to its API which originally would
                    have resulted in shutting down this section back in December
                    2018. After a reprieve of sorts, this shutdown has now come
                    to pass.
                </p>
                <p>
                    We still have the Movies section wherein I can still show
                    people what I can do with an external API. Meanwhile I am
                    open to other <em>free</em> sources of weather data so that
                    I may try this again.
                </p>
                <p>
                    I am also open to suggestions regarding other free APIs for
                    me to play with. (Yes, I also can scrape other websites for
                    data; the issue is whether I may.)
                </p>
                <p>
                    As always, I am grateful for your time.
                </p>
            </div>                
        </div>
    </div>    

<?php
    require_once $views . 'close-jumbotron.php';
    require_once $views . 'footer.php';
    require_once $views . 'load/jquery.php';
    require_once $views . 'load/bootstrap.php';
    require_once $views . 'load/google-analytics.php';
    require_once $views . 'foot.php';    
    /*
     *  HTML end
     */