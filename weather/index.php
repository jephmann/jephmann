<?php
    declare( strict_types = 1 );
    $path       = '../';
    $subtitle   = 'Weather';

    // autoload class files
    require_once $path . '_php/autoload1.php';
    $weatherAPI     = new ApiWUnderground;
    $features       = (array) $weatherAPI->features;
    $locations      = (array) $weatherAPI->locations;
    $ctLocations    = (int) count( $locations );    
    
    // default
    $city   = 'Chicago';
    $state  = 'IL';
       
    if ( isset( $_POST[ 'weatherCity' ] ) )
    {
        $weatherCity    = (int) $_POST[ 'weatherCity' ];
        $city           = (string) $locations[ $weatherCity ][ 'city' ];
        $state          = (string) $locations[ $weatherCity ][ 'state' ];
        $subtitle       = "{$subtitle} ({$city}, {$state})";
    }
    
    // alert feature
    $arrayAlerts    = (array) $weatherAPI->arrayReport(
        'alerts', $city, $state
        );
    $alerts         = (array) $arrayAlerts[ 'alerts' ];
    $ctAlerts       = (int) count( $alerts );
    
    // conditions feature
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
    
    // almanac feature
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

    // forecast feature
    $arrayForecast = $weatherAPI->arrayReport(
        'forecast', $city, $state
        );
    $forecast       = (array) $arrayForecast[ 'forecast' ];
    $forecastDay    = (array) $forecast['txt_forecast']['forecastday'];
    $ctForecastDay  = (int) count( $forecastDay );
    
    // radar
    $urlRadar       = (string) $weatherAPI->urlRadar( $city, $state );

    /*
     *  Custom (per page) meta
     */
    $meta_image         = 'http://jephmann.com/_images/logos/iw63kb1u.bmp';
    $meta_description   = 'Weather data courtesy of WeatherUnderground.com | ';
    $meta_querystring   = (string) NULL;
    /*
     *  HTML start
     */
    require_once $path . '_views/head.php';
    require_once $path . '_views/navbar.php';
    require_once $path . '_views/header.php';
    require_once $path . '_views/open-jumbotron.php';
?>    
        
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">

                <h2>The Weather Section</h2>
                <a target="blank"
                    href="https://www.wunderground.com/?apiref=aa64dd3c5f156d74">
                    <img alt="Weather Underground"
                        title="Weather Underground"
                        src="../_images/logos/iw63kb1u.bmp"
                        style="display:block;margin:auto;">
                </a>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Select a U.S. City
                        </h3>                   
                    </div>
                    <div class="panel-body">    
                        <form method="post" action="" name="formWeather">
                            <div class="form-group">
                                <select class="form-control" id="weatherCity" name="weatherCity" required="required">
                                    <option value=""></option><?php
                                    for( $i=0; $i<$ctLocations; $i++ ):
                                        $mycity   = $locations[ $i ][ 'city' ];
                                        $mystate  = $locations[ $i ][ 'state' ];
                                        ?>

                                    <option value="<?php echo $i; ?>"><?php
                                        echo "{$mycity}, {$mystate}"; ?></option><?php  
                                    endfor; ?>

                                </select>
                            </div>
                        </form>
                    </div>                            
                </div>

            </div>
            <div class="col-lg-8 col-md-8 col-sm-8">        
                <h2>Weather for <?php echo "{$city}, {$state}"; ?></h2>
                
                <?php if ( $ctAlerts != 0 ) : ?>
                <?php for ( $a=0; $a<$ctAlerts; $a++ ) :
                    $alert_description  = (string) $alerts[$a]['description'];
                    $alert_message      = nl2br( (string) $alerts[$a]['message'] );
                    $alert_expires      = (string) $alerts[$a]['expires'];
                ?>
                <div class="panel panel-warning"
                     style='color: #FFFFFF;'>
                    <div class="panel-heading">
                        <h3 class="panel-title">Alert for
                            <?php echo $city; ?>,
                            <?php echo $state; ?>:
                            <?php echo $alert_description; ?>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <h4>Expires: <?php echo $alert_expires; ?></h4>
                        <p style="font-family: 'Lucida Console', monospace; font-size: small;"><?php echo $alert_message; ?></p>
                    </div>
                </div>
                <?php
                endfor;
                endif;
                ?>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <h3>Radar:</h3>
                        <img alt="Radar" class="img100w"
                            title="Radar for <?php echo "{$city}, {$state}"; ?>"
                            src="<?php echo $urlRadar; ?>" />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <h3>Current Conditions:</h3>
                        <img alt=""
                            src="<?php echo $current_icon; ?>">
                        <p>Weather: <?php echo $current_weather; ?></p>
                        <p>Temperatures: <?php echo $current_temperature; ?></p>
                        <p>Winds: <?php echo $current_wind; ?></p>
                        <p>Precipitation: <?php echo $current_precip; ?></p>
                        <p>Humidity: <?php echo $current_humidity; ?></p>
                        <p>Feels Like: <?php echo $current_feel; ?></p>          
                    </div>
                </div>
                
            </div>                
        </div>
    </div>        
        

    <?php require_once $path . '_views/close-jumbotron.php'; ?>

    <div class="container">
        <div class="row">                       

            <div class="col-lg-4 col-md-4 col-sm-4">              
                
                <div class="panel panel-success">
                   <div class="panel-heading">
                       <h3 class="panel-title">Almanac for
                           <?php echo $city; ?>,
                           <?php echo $state; ?>
                       </h3>
                   </div>
                   <div class="panel-body">
                    
                        <div class="col-lg-6 col-md-6 col-sm-6">                    
                            <div class="well">
                                <h3>Norms</h3>
                                <p>High:<br/> 
                                <?php echo $almanacHighNormalF; ?>F
                                |
                                <?php echo $almanacHighNormalC; ?>C
                                </p>
                                <p>Low:<br/>
                                <?php echo $almanacLowNormalF; ?>F
                                |
                                <?php echo $almanacLowNormalC; ?>C
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="well">
                                <h3>Records</h3>
                                <p>High (<?php echo $almanacHighRecordYear; ?>):<br/> 
                                <?php echo $almanacHighRecordF; ?>F
                                |
                                <?php echo $almanacHighRecordC; ?>C
                                </p>
                                <p>Low (<?php echo $almanacLowRecordYear; ?>):<br/>
                                <?php echo $almanacLowRecordF; ?>F
                                |
                                <?php echo $almanacLowRecordC; ?>C
                                </p>
                            </div>
                        </div>
                       
                   </div>
               </div>
                
            </div>                      

            <div class="col-lg-8 col-md-8 col-sm-8">                
                
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Forecasts for
                            <?php echo $city . ', ' . $state; ?>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="row"> <!--begin top row-->
        
                        <?php
                            for( $i=0; $i<$ctForecastDay; $i++ ):
                                $icon_url   = (string) $forecastDay[$i]['icon_url'];
                                $title      = (string) $forecastDay[$i]['title'];
                                $fcttext    = (string) $forecastDay[$i]['fcttext'];

                                // start between rows
                                if( ($i != 0 ) and ( $i % 3 === 0 ) ):
                        ?>
                            
                        </div>
                        <div class="row"><?php
                            endif; // end between rows
                        ?>                                
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><img src="<?php
                                            echo $icon_url; ?>" alt="">&nbsp;<?php
                                            echo $title; ?></h3>
                                    </div>
                                    <div class="panel-body">
                                        <p><?php echo $fcttext; ?></p>
                                    </div>
                                </div>                                
                            </div><?php
                            endfor;
                            ?>
                                
                        </div> <!--end bottom row-->

                    </div>
                </div>
                
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">About this Section</h3>
                    </div>
                    <div class="panel-body">
                        
                        <p>
                            Here I retrieve data from <a target="_blank"
                            href="https://www.wunderground.com/?apiref=aa64dd3c5f156d74">Weather
                            Underground</a>'s API.
                        </p>

                        <p>
                            If you would like me to add a U.S. city to this page,
                            feel free to let me know.
                        </p>

                        <p>
                            Default data is for Chicago, IL, basically because I'm
                            from Chicago (and "because I could").
                        </p>
                        
                    </div>
                </div>
                
            </div>
                
        </div>            
    </div>

<?php
    require_once $path . '_views/close-jumbotron.php';
    require_once $path . '_views/footer.php';
    require_once $path . '_views/load/jquery.php';
    ?>
<script type="text/javascript">    
    $(document).ready(function() {
        $('#weatherCity').on('change', function() {
            document.forms['formWeather'].submit();
        });
    });
</script>
<?php
    require_once $path . '_views/load/bootstrap.php';
    require_once $path . '_views/load/google-analytics.php';
    require_once $path . '_views/foot.php';    
    /*
     *  HTML end
     */