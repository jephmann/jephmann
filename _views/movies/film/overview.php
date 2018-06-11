<h3>
    <em><?php echo $overview[ 'title' ]; ?></em>
    (<?php echo $overview[ 'release_year' ]; ?>)
</h3>

<p class="text-warning"><em><?php
    echo $overview[ 'tagline' ];
?></em></p>

<?php
    echo $overview[ 'release' ];
    echo $overview[ 'titles' ];
    echo $overview[ 'genres' ];
    echo $overview[ 'companies' ];
    $logo_title = $overview[ 'title' ];
    //require_once $views_movies . 'logo-links.php';
    require_once $views_movies . 'movie-links.php';
?>

<p><?php
    echo $overview[ 'text' ];
?></p>

<?php
    require_once $views_movies . 'videos.php';

    // TESTS
    //require_once $test . 'title.php';
    //require_once $test . 'titles.php';
    //require_once $test . 'videos.php';