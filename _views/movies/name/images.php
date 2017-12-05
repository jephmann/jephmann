<!--
<img style="border: black 1px dotted;" class="img100w"
     alt=""
     src="<?php echo $image_name; ?>">
-->

<?php
    if( !empty( $name_profile_path ) and $ct_profiles > 0 ):
    $name_profile = $moviesAPI->urlImage( $name_profile_path );
?>
<div id="galleria" class="img100w">

    <?php

        // Main image
        echo Galleria::img(
            $name_profile,
            $name_name,
            '<ul>'
                . $overview[ 'birthplace' ]
                . $overview[ 'birthday' ]
                . $overview[ 'deathday' ]
                . '</ul>'
                . '<p>(Main Image)</p>'
            );

        // Profile images
        $x = 0;
        foreach ( $images_profiles as $profile )
        {
            $x++;
            $profile_image = $moviesAPI->urlImage( $profile[ 'file_path' ] );
            $profile_description = '<ul>'
                . $overview[ 'birthplace' ]
                . $overview[ 'birthday' ]
                . $overview[ 'deathday' ]
                . '</ul>'
                . "<p>(Profile {$x} of {$ct_profiles})</p>";
            echo Galleria::img(
                $profile_image,
                $name_name,
                $profile_description
            );
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