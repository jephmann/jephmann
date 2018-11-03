<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a data-toggle="collapse" href="#filmcrew"
               title="Click for Production credits">Film Production</a>
            <span class="caret"></span>
        </h3>
    </div>
    <div class="panel-body panel-collapse collapse in credits-scroll" id="filmcrew">
        <?php echo $film_production; ?>
    </div>
    <div class="panel-footer">
        <p><?php echo $creditFooter; ?></p>
    </div>
</div>
<?php
    //require_once $test . 'name/crew.php';