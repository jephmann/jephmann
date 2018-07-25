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
        
    </div>
</div>
