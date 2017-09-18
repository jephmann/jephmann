<div class="panel panel-success">
   <div class="panel-heading">
       <h3 class="panel-title">
           Almanac for <?php echo $csz; ?>
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