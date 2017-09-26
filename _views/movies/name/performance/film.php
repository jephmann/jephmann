<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a data-toggle="collapse" href="#filmcast"
               title="Click for Film Performance credits">Film Performances</a>
            <span class="caret"></span>
        </h3>
    </div>
    <div class="panel-body panel-collapse collapse in" id="filmcast">
        <?php echo $film_performance; ?>
    </div>
    <div class="panel-footer">
        <p><?php echo $creditFooter; ?></p>
    </div>
</div>
<?php
    //require_once $test . 'name/cast.php';