<div class="col-lg-6 col-md-6 col-sm-6">
<?php
    // begin top omdb section
    if ( $omdb_actors or $omdb_writer or $omdb_director ):
?>
    <div style="border-bottom: 1px silver dotted;">
        <?php
        if( $omdb_actors )
            echo $featuring;
        if( $omdb_writer )
            echo preg_replace ( '~,\s?~', '<br />', $writtenBy );
        if( $omdb_director )
            echo $directedBy;
        ?>
    </div>
    <br />
<?php
    endif; // end top omdb section
    echo $overview[ 'release' ];
    echo $overview[ 'title_original' ];
    echo $overview[ 'titles' ];
    echo $overview[ 'genres' ];
    echo $overview[ 'companies' ];
    echo $overview[ 'countries' ];
    echo $overview[ 'certifications' ];
    echo $overview[ 'runtime' ];
    // begin bottom omdb section
        if ( $omdb_awards or array_key_exists( 'Ratings', $omdb ) ) :
    ?><div style="border-top: 1px silver dotted; padding-top: 1em;"><?php
        if ( $omdb_awards )
            echo $awardsWon;
        if( array_key_exists( 'Ratings', $omdb ) ):
    ?><table class="table table-hover" width="100%"><?php
            foreach ( $omdb[ 'Ratings'] as $rating )
            {
                echo "\n<tr class=\"table-primary\">"
                . "<th scope=\"row\">{$rating['Source']}</th>"
                . "<td>{$rating['Value']}</td>"
                . "</tr>";
            }
    ?></table><?php
    endif;
    ?></div><?php
    endif; // end bottom omdb section
    if ( $overview[ 'imdb' ] )
        require_once $path . '_plugins/imdb/ratings.php';
?>
</div>

<div class="col-lg-6 col-md-6 col-sm-6"><?php
    echo $overview[ 'tagline' ];
    if ( $overview[ 'text' ] ) : ;
    ?>
    <blockquote class="blockquote"><?php
    echo $overview[ 'text' ]; ?>
        <small>
            from TheMovieDB (and not from Jeffrey Hartmann)
        </small>
    </blockquote><?php
    endif;
    $omdb_plot      = array_key_exists( 'Plot', $omdb )
                    ? $openMoviesAPI->nullNA( trim( $omdb[ 'Plot' ] ) )
                    : '';
    
    // begin omdb "overview"
    if ( ( $omdb_plot ) and $overview['text'] != $omdb_plot ) :
    ?>
    <blockquote class="blockquote"><?php
    echo $omdb_plot; ?>
        <small>
            from Open Movies (and not from Jeffrey Hartmann)
        </small>
    </blockquote><?php
    endif; // end omdb "overview"
    
    // "Additional Information"
    $logo_title = $overview[ 'title' ];
    //require_once $views_movies . 'logo-links.php';
    require_once $views_movies . 'movie-links.php';
?></div>

<div class="col-lg-12 col-md-12 col-sm-12"><?php
    require_once $views_movies . 'videos.php';
?></div>

<?php
    // TESTS
    //require_once $test . 'title.php';
    //require_once $test . 'titles.php';
    //require_once $test . 'videos.php';
    require_once $test . 'omdb.php';