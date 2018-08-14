<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">
            Forecasts for <?php echo $csz; ?>
        </h3>
    </div>
    <div class="panel-body">
        <div class="row"> <!--begin top row-->

        <?php
            for( $i=0; $i<$ctForecastDay; $i++ ):
                $icon_url   = (string) $forecastDay[$i]['icon_url'];
                $title      = (string) $forecastDay[$i]['title'];
                $fcttext    = (string) $forecastDay[$i]['fcttext'];
                $icon_alt   = basename( $icon_url, '.gif' );

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
                            echo $icon_url; ?>" alt="<?php
                            echo $icon_alt; ?>" title="<?php
                            echo $icon_alt; ?>">&nbsp;<?php
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