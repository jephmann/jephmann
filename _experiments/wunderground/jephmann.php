<?php
    declare( strict_types = 1 );
    $path       = '../../';
    $subtitle   = 'Weather';
    $autoload   = $path . '_php/autoload.php';
    require_once $autoload;

    // Class tests
    $weatherAPI = new ApiWUnderground;
    $features   = $weatherAPI->features;
    $locations  = $weatherAPI->locations;
    $ctLocations    = count( $locations );
    
    
    // default
    $city = 'Chicago';
    $state = 'IL';
       
    if ( isset( $_POST[ 'weatherCity' ] ) )
    {
        $weatherCity  = (int) $_POST[ 'weatherCity' ];
        $city       = (string) $locations[ $weatherCity ][ 'city' ];
        $state      = (string) $locations[ $weatherCity ][ 'state' ];
    }    

    // almanac feature
    $arrayAlmanac = (array) $weatherAPI->arrayReport( 'almanac', $city, $state );    
    $almanac = (array) $arrayAlmanac['almanac'];    
    $almanacHigh = (array) $almanac['temp_high'];    
    $almanacHighNormal = $almanacHigh['normal'];
    $almanacHighNormalF = $almanacHighNormal['F'];
    $almanacHighNormalC = $almanacHighNormal['C'];    
    $almanacHighRecord = $almanacHigh['record'];
    $almanacHighRecordF = $almanacHighRecord['F'];
    $almanacHighRecordC = $almanacHighRecord['C'];    
    $almanacHighRecordYear = $almanacHigh['recordyear'];    
    $almanacLow = (array) $almanac['temp_low'];    
    $almanacLowNormal = (array) $almanacLow['normal'];
    $almanacLowNormalF = $almanacLowNormal['F'];
    $almanacLowNormalC = $almanacLowNormal['C'];    
    $almanacLowRecord = (array) $almanacLow['record'];
    $almanacLowRecordF = $almanacLowRecord['F'];
    $almanacLowRecordC = $almanacLowRecord['C'];    
    $almanacLowRecordYear = $almanacLow['recordyear'];
    
    // TODO: loop
    // alert feature
    $arrayAlerts = $weatherAPI->arrayReport( 'alerts', $city, $state );
    
    $ctAlerts = count($arrayAlerts);
    
    if ( $ctAlerts < 0 )
    {    
        $alert0 = $arrayAlerts['alerts'][0];
        $alert0_message = $alert0['message'];
        $alert0_description = $alert0['description'];
        $alert0_expires = $alert0['expires'];
    }

    // forecast feature
    $arrayForecast = $weatherAPI->arrayReport( 'forecast', $city, $state );
    $forecast = $arrayForecast[ 'forecast' ];
    $forecastDay = $forecast['txt_forecast']['forecastday'];
    $ctForecastDay = count($forecastDay);
    
    // HTML start
    require_once $path . '_views/head.php';
    require_once $path . '_views/navbar.php';
    require_once $path . '_views/header.php';
    require_once $path . '_views/open-jumbotron.php';
?>
    
    <div class="col-lg-12 col-md-12 col-sm-12">
        <h2>The Weather Section</h2>
    </div>

    <?php require_once $path . '_views/close-jumbotron.php'; ?>

    <div class="container">
        <div class="row">                       

            <div class="col-lg-4 col-md-4 col-sm-4">
                               
                
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
                
                <?php if ( $ctAlerts < 0 ) : ?>
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Alerts for
                            <?php echo $city; ?>,
                            <?php echo $state; ?>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <!-- TODO: loop -->
                        <h3><?php echo $alert0_description; ?></h3>
                        <h4>Expires: <?php echo $alert0_expires; ?></h4>
                        <p><?php echo $alert0_message; ?></p>
                        <!--
                        <h3><?php echo $alert1_description; ?></h3>
                        <h4>Expires: <?php echo $alert1_expires; ?></h4>
                        <p><?php echo $alert1_message; ?></p>
                        <h3><?php echo $alert2_description; ?></h3>
                        <h4>Expires: <?php echo $alert2_expires; ?></h4>
                        <p><?php echo $alert2_message; ?></p>
                        -->
                    </div>
                </div>
                <?php endif; ?>
                
                <div class="panel panel-primary">
                   <div class="panel-heading">
                       <h3 class="panel-title">Almanac for
                           <?php echo $city; ?>,
                           <?php echo $state; ?>
                       </h3>
                   </div>
                   <div class="panel-body">
                       <h3>Norms</h3>
                       <p>High: 
                               <?php echo $almanacHighNormalF; ?>F
                               |
                               <?php echo $almanacHighNormalC; ?>C <br/>Low:
                               <?php echo $almanacLowNormalF; ?>F
                               |
                               <?php echo $almanacLowNormalC; ?>C </p>
                       <h3>Records</h3>
                       <p>High (<?php echo $almanacHighRecordYear; ?>): 
                               <?php echo $almanacHighRecordF; ?>F
                               |
                               <?php echo $almanacHighRecordC; ?>C <br/>Low (<?php echo $almanacLowRecordYear; ?>):
                               <?php echo $almanacLowRecordF; ?>F
                               |
                               <?php echo $almanacLowRecordC; ?>C </p>
                   </div>
               </div>
                
            </div>                      

            <div class="col-lg-8 col-md-8 col-sm-8">                
                
                <div class="panel panel-primary">
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
    // HTML end