<div class="col-lg-6 col-md-6 col-sm-6">
    <p style="font-size: 1em;"><?php
        echo $overview[ 'aka' ];
    ?></p>
    <ul><?php        
        echo $overview[ 'birthplace' ];
        echo $overview[ 'birthday' ];
        echo $overview[ 'deathday' ];
    ?></ul>
</div>

<div class="col-lg-6 col-md-6 col-sm-6">
    <p><?php echo $overview[ 'text' ]; ?></p><?php
        $logo_title = $name_name;
        //require_once $views_movies . 'logo-links.php';
        require_once $views_movies . 'movie-links.php';
    ?>
</div>

<?php
    //require_once $test . 'name.php';