<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a data-toggle="collapse" href="#performers"
               title="Click for Performer credits">Performers</a>
            <span class="caret"></span>
        </h3>
    </div>
    <div class="panel-body panel-collapse collapse in credits-scroll" id="performers">
        <?php echo $performance_credits; ?>
    </div>
    <div class="panel-footer">
        <p><?php echo $creditFooter; ?></p>
    </div>
</div>
<?php
    //require_once $test . 'cast.php';