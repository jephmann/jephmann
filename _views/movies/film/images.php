<!--
<img style="border: black 1px dotted;" width="100%"
     alt="<?php echo $overview[ 'title' ]; ?>"
     src="<?php echo $image_film; ?>">
-->                

<?php
    if( !empty( $film_poster_path ) and ( $ct_posters > 0 or $ct_backdrops > 0 ) ):
    $film_poster        = $moviesAPI->urlImages( $film_poster_path )[ 'gallery' ];
    $gallery_subject    = $overview[ 'title' ];
    $gallery_dates      = '<strong>Release Date:</strong><br />'
        . $cast_release_date->format( 'F j, Y' );
?>    
<div id="galleria" class="img100w">
    <?php

        // Main image
        echo Galleria::img(
            $film_poster,
            $gallery_subject,
            $gallery_dates . '<br /><br /><strong>Main Image</strong>'
        );

        // Poster images        
        $poster_images = Galleria::images(
            $gallery_subject, $gallery_dates, $posters, 'Poster'
        );
        echo $poster_images;

        // Backdrop images        
        $backdrop_images = Galleria::images(
            $gallery_subject, $gallery_dates, $backdrops, 'Backdrop'
        );
        echo $backdrop_images;
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
    //require_once $test . 'images.php';