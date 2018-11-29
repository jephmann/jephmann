<?php if( $ct_tv_cast ): ?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a data-toggle="collapse" href="#tvcast"
               title="Click for TV Performance credits">TV Performances</a>
            <span class="caret"></span>
        </h3>
    </div>
    <div class="panel-body panel-collapse collapse in credits-scroll" id="tvcast">
        <ul class="list-group">
        <?php echo $tv_performance; ?>
        </ul>
    </div>
    <div class="panel-footer">
        <p><?php echo $creditFooter; ?></p>
    </div>
</div>
<?php
    endif;
    //require_once $test . 'name/cast_tv.php';