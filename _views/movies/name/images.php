<!--
<img style="border: black 1px dotted;" class="img100w"
     alt=""
     src="<?php echo $image_name; ?>">
-->

<?php
    if( !empty( $name_profile_path ) and $ct_profiles > 0 ):
    $name_profile       = $moviesAPI->urlImages( $name_profile_path )[ 'gallery' ];
    $gallery_subject    = $name_name;
    $gallery_dates      = '<ul>'
        . $overview[ 'birthplace' ]
        . $overview[ 'birthday' ]
        . $overview[ 'deathday' ]
        . '</ul>';
?>
<div id="galleria" class="img100w">
    <?php

        // Main image
        echo Galleria::img(
            $name_profile,
            $gallery_subject,
            $gallery_dates . '<br /><br /><strong>Main Image</strong>'
        );

        // Profile images        
        $profile_images = Galleria::images(
            $gallery_subject, $gallery_dates, $images_profiles, 'Profile'
        );
        echo $profile_images;
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