<div class="col-lg-6 col-md-6 col-sm-6"><?php
    echo $overview[ 'release' ];
    echo $overview[ 'title_original' ];
    echo $overview[ 'titles' ];
    echo $overview[ 'genres' ];
    echo $overview[ 'companies' ];
    echo $overview[ 'countries' ];
    echo $overview[ 'runtime' ];
    $logo_title = $overview[ 'title' ];
    //require_once $views_movies . 'logo-links.php';
    require_once $views_movies . 'movie-links.php';
?></div>

<div class="col-lg-6 col-md-6 col-sm-6"><?php
    echo $overview[ 'tagline' ];
    echo $overview[ 'text' ];
    echo $overview[ 'certifications' ];
?></div>

<div class="col-lg-12 col-md-12 col-sm-12"><?php
    require_once $views_movies . 'videos.php';
?></div>

<?php
    // TESTS
    //require_once $test . 'title.php';
    //require_once $test . 'titles.php';
    //require_once $test . 'videos.php';