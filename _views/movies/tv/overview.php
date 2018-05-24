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
    if( $ctVideos>0 ):
        $ctTrailers = 0;
        for( $v=0; $v<$ctVideos; $v++ )
        {
            $video_type     = (string) $videos_results[ $v ][ 'type' ];
            if ( $video_type == "Trailer" )
            {
                $ctTrailers++;
            }
        }
        if ( $ctTrailers > 0 ):
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Trailer *</h3>
    </div>
    <div class="panel-body">

        <?php
            for( $v=0; $v<$ctVideos; $v++ ) :
            $video_key      = (string) $videos_results[ $v ][ 'key' ];
            $video_size     = (int) $videos_results[ $v ][ 'size' ];
            $video_type     = (string) $videos_results[ $v ][ 'type' ];
            if( $video_type == "Trailer" ):                                  

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
        * Although TheMovieDB may suggest that at least one trailer might
        exist in YouTube for this title, YouTube might not necessarily
        have any trailers for this title.
    </div>
</div>

<?php
    endif;
    endif;
    // TESTS
    //require_once $test . 'title.php';
    //require_once $test . 'titles.php';
    //require_once $test . 'videos.php';