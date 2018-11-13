<?php // skip a line ?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            Enter a U.S. ZIP Code. Hit "Enter".
        </h3>
    </div>
    <div class="panel-body">    
        <form method="post" action="" id="weatherZIP" name="weatherZIP"
            data-fv-framework="bootstrap"
            data-fv-icon-valid="glyphicon glyphicon-ok"
            data-fv-icon-invalid="glyphicon glyphicon-remove"
            data-fv-icon-validating="glyphicon glyphicon-refresh">            
            <div class="form-group">
                
                <input required="required" class="form-control"
                    type="search"
                    placeholder="##### (5 numeric digits please)"
                    id="wZIP" name="wZIP"
                    pattern="^[0-9]{5}(?:-[0-9]{4})?$"
                    data-fv-regexp-message="5-digit U.S. ZIP Code required." />
            
            </div>            
        </form>
        <?php echo $eZip; ?>
        <h4>ANNOUNCEMENT:
            <a target="_blank" title="Announcement from Weather Underground"
                data-toggle="tooltip" data-placement="bottom"
                data-original-title="Announcement from Weather Underground"
                href="https://apicommunity.wunderground.com/weatherapi/topics/end-of-service-for-the-weather-underground-api">
                End of Service for the Weather Underground API
            </a>
        </h4>
        <p style="font-size: 1.0em;">
            <em>
            After December 31, 2018, the Weather section of this
            website may shut down indefinitely.
            </em>
        </p>        
    </div>
</div>
