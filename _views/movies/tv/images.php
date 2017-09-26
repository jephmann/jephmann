<!--
<img style="border: black 1px dotted;" width="100%"
     alt="<?php echo $title_title; ?>"
     src="<?php echo $image_title; ?>">
-->                

<?php
    if( !empty( $title_poster_path ) and ( $ct_posters > 0 or $ct_backdrops > 0 ) ):
    $title_poster = $moviesAPI->urlImage( $title_poster_path );
?>    
<div id="galleria" class="img100w">

    <?php

        // Main image
        echo Galleria::img(
            $title_poster,
            $title_title,
            $overview_release
                . "<p>(Main Image)</p>"
            );


        // Poster images.
        if( $ct_posters > 0 )
        {
            $x = 0;
            foreach ( $images_posters as $poster )
            {
                $x++;
                $poster_image = $moviesAPI->urlImage( $poster[ 'file_path' ] );
                $poster_description = $overview_release
                    . "<p>(Poster {$x} of {$ct_posters})</p>";
                echo Galleria::img(
                    $poster_image,
                    $title_title,
                    $poster_description
                );
            }
        }

        // Backdrop images.
        if( $ct_backdrops > 0 )
        {
            $x = 0;
            foreach ( $images_backdrops as $backdrop )
            {
                $x++;
                $backdrop_image = $moviesAPI->urlImage( $backdrop[ 'file_path' ] );
                $backdrop_description = $overview_release
                    . "<p>(Backdrop {$x} of {$ct_backdrops})</p>";
                echo Galleria::img(
                    $backdrop_image,
                    $title_title,
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
    // TEST
    //require_once $path . '_php/movies/api/pre/images.php';