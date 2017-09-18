<?php // skip a line ?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            Select a U.S. City
        </h3>
    </div>
    <div class="panel-body">    
        <form method="post" action="" id="weatherCity" name="weatherCity">            
            <div class="form-group">
                
                <select required="required" class="form-control"
                    id="wCity" name="wCity">
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