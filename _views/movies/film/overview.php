<div class="col-lg-6 col-md-6 col-sm-6">
<?php
    // begin top omdb section
    if ( $omdb_actors or $omdb_writer or $omdb_director ):
    ?><div style="border-bottom: 1px silver dotted;"><?php
        if( $omdb_actors )
            echo $featuring;
        if( $omdb_writer )
            echo preg_replace ( '~,\s?~', '<br />', $writtenBy );
        if( $omdb_director )
            echo $directedBy;
    ?></div>
    <br /><?php
    endif; // end top omdb section
    echo $overview[ 'release' ];
    echo $overview[ 'title_original' ];
    echo $overview[ 'titles' ];
    echo $overview[ 'genres' ];
    echo $overview[ 'companies' ];
    echo $overview[ 'countries' ];
    echo $overview[ 'certifications' ];
    echo $overview[ 'runtime' ];
?>
</div>

<div class="col-lg-6 col-md-6 col-sm-6">
<?php

    // optional Tagline
    if ( $overview[ 'tagline' ] )
        echo "<h3 class=\"text-warning\"><em>{$overview[ 'tagline' ]}</em></h3>";

    // TheMovieDB Overview
    echo $panelOverview;

    // omdb "overview" (if text does not match TheMovieDB Overview)
    if ( ( $omdb_plot ) and $overview['text'] != $omdb_plot )
        echo $panelOverviewOpenMovie;

    // "Additional Information"
    $logo_title = $overview[ 'title' ];
    //require_once $views_movies . 'logo-links.php';
    require_once $views_movies . 'movie-links.php';
    
    require_once $views_movies . 'search.php';

?>
</div>

<div class="col-lg-12 col-md-12 col-sm-12"><?php
    require_once $views_movies . 'videos.php';
?></div>

<?php
    // TESTS
    //require_once $test . 'title.php';
    //require_once $test . 'titles.php';
    //require_once $test . 'videos.php';
    //require_once $test . 'omdb.php';