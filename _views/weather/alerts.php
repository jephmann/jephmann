    <?php
        if ( $ctAlerts != 0 ) :
            for ( $a=0; $a<$ctAlerts; $a++ ) :
                $alert_description  = (string) $alerts[$a]['description'];
                $alert_message      = nl2br( (string) $alerts[$a]['message'] );
                $alert_expires      = (string) $alerts[$a]['expires'];
    ?>
    <div class="panel panel-warning"
         style='color: #FFFFFF;'>
        <div class="panel-heading">
            <h3 class="panel-title">
                Alert for <?php echo $csz; ?>
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