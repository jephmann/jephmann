<?php
    $videos_results = (array) $videos[ 'results' ];
    $ctVideos = (int) count($videos_results);
    if( $ctVideos ):
?>
<h3 style="border-top: silver dotted 1px; padding-top: 0.5em;">
    Video
</h3>
<p style="font-size: 1.0em;">    
    Click each video panel to show or hide.
</p>
<?php
        $video_title = "";
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
        $video_title = "Click for a {$vt} Video";
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <a data-toggle="collapse" href="#<?php echo $idVT; ?>"
               title="<?php echo $video_title; ?>"><?php echo $vt; ?></a>
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
            <iframe class="embed-responsive-item"
                title="<?php echo $video_key ?>"
                src="//www.youtube.com/embed/<?php echo $video_key ?>"></iframe>
        </div>
        <hr/>
        <?php
            endif;  // match video types
            endfor; // loop through video_results
        ?>
    </div>
    <!-- no panel footer -->
</div>
<?php
    endif;      // ctVT
    endforeach; // video_types as vt
?>
<p style="font-size: 1.0em;">    
    Although TheMovieDB might provide a key to a YouTube video,
    there is no guarantee that the video might be present at YouTube.
</p>
<?php
    endif;      // ctVideos