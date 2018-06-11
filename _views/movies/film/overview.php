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
    $videos_results = (array) $videos[ 'results' ];
    $ctVideos = (int) count($videos_results);
    if( $ctVideos ):
        
        (array) $video_types = $moviesAPI->video_types;
    
        foreach ( $video_types as $vt ):
        {
            $ctVT = 0;
            for( $v=0; $v<$ctVideos; $v++ )
            {
                $video_type     = (string) $videos_results[ $v ][ 'type' ];
                if ( $video_type == $vt )
                {
                    $ctVT++;
                }
            } 
        }
        if ( $ctVT ):
            $idVT = preg_replace( '~ ~', '', strtolower( $vt ) );
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a data-toggle="collapse" href="#<?php echo $idVT; ?>"
               title="Click for <?php echo $vt; ?> video"><?php echo $vt; ?></a>
            <span class="caret"></span>
        </h3>
    </div>
    <div class="panel-body panel-collapse collapse" id="<?php echo $idVT; ?>">
        <?php
            for( $v=0; $v<$ctVideos; $v++ ) :
            $video_key      = (string) $videos_results[ $v ][ 'key' ];
            $video_size     = (int) $videos_results[ $v ][ 'size' ];
            $video_type     = (string) $videos_results[ $v ][ 'type' ];
            if( $video_type == $vt ):                                  

                $aspect_ratio = $video_size === 360
                    ? "4by3" : "16by9";
        ?>
        <!-- based on http://scotch.io -->

        <div class="embed-responsive embed-responsive-<?php echo $aspect_ratio ?>">
            <iframe class="embed-responsive-item" src="//www.youtube.com/embed/<?php echo $video_key ?>"></iframe>
        </div>
        <hr/>
        <?php
            endif;
            endfor;
        ?>
    </div>
    <div class="panel-footer">
        Although TheMovieDB may suggest that at least one <?php echo $vt; ?>
        might exist in YouTube for this title, YouTube might not necessarily
        have any for this title.
    </div>
</div>
<?php
    endif;
    endforeach;
    endif;

    // TESTS
    //require_once $test . 'title.php';
    //require_once $test . 'titles.php';
    //require_once $test . 'videos.php';