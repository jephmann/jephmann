<!--
<img style="border: black 1px dotted;" width="100%"
     alt="<?php echo $overview[ 'title' ]; ?>"
     src="<?php echo $image_tv; ?>">
-->                

<?php
    if( !empty( $tv_poster_path ) and ( $ct_posters > 0 or $ct_backdrops > 0 ) ):
    $tv_poster = $moviesAPI->urlImage( $tv_poster_path );
?>    
<div id="galleria" class="img100w">

    <?php

        // Main image
        echo Galleria::img(
            $tv_poster,
            $overview[ 'title' ],
            $overview[ 'release' ]
                . "<p>(Main Image)</p>"
            );


        // Poster images.
        if( $ct_posters > 0 )
        {
            $x = 0;
            foreach ( $posters as $poster )
            {
                $x++;
                $poster_image = $moviesAPI->urlImage( $poster[ 'file_path' ] );
                $poster_description = $overview[ 'release' ]
                    . "<p>(Poster {$x} of {$ct_posters})</p>";
                echo Galleria::img(
                    $poster_image,
                    $overview[ 'title' ],
                    $poster_description
                );
            }
        }

        // Backdrop images.
        if( $ct_backdrops > 0 )
        {
            $x = 0;
            foreach ( $backdrops as $backdrop )
            {
                $x++;
                $backdrop_image = $moviesAPI->urlImage( $backdrop[ 'file_path' ] );
                $backdrop_description = $overview[ 'release' ]
                    . "<p>(Backdrop {$x} of {$ct_backdrops})</p>";
                echo Galleria::img(
                    $backdrop_image,
                    $overview[ 'title' ],
                    $backdrop_description
                );
            }
        }
    ?>

</div>
<?php
    else:
?>
<h4>
    <em>Gallery Unavailable</em>
</h4>
<?php
    endif;
    //require_once $test . 'images.php';