<!--
<img style="border: black 1px dotted;" width="100%"
     alt="<?php echo $overview[ 'title' ]; ?>"
     src="<?php echo $image_tv; ?>">
-->                

<?php
    if( !empty( $tv_poster_path ) and ( $ct_posters > 0 or $ct_backdrops > 0 ) ):
    $tv_poster          = $moviesAPI->urlImage( $tv_poster_path );
    $gallery_subject    = $overview[ 'title' ];
    $gallery_dates      = $overview[ 'release' ];
?>    
<div id="galleria" class="img100w">
    <?php

        // Main image
        echo Galleria::img(
            $tv_poster,
            $gallery_subject,
            $gallery_dates . "<p>(Main Image)</p>"
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