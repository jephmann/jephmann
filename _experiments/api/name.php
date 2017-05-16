<?php
    $path = '../../';
    require_once $path . '_php/autoload.php';

    $id                     = (string) $_GET[ 'id' ];
    $moviesAPI              = new ApiMovieDB;
    $moviesIMDB             = new IMDB;
    $urls                   = (array) $moviesAPI->urlPerson( $id );   
    $name                   = (array) Tools::getJsonArray( $urls[ 'name' ] );    
    $name_name              = trim( (string) $name[ 'name' ] );
    $name_profile_path      = trim( (string) $name[ 'profile_path' ] );
    $name_biography         = trim( (string) $name[ 'biography' ] );
    $name_place_of_birth    = trim( (string) $name[ 'place_of_birth' ] );
    $name_birthday          = trim( (string) $name[ 'birthday' ] );
    $name_deathday          = trim( (string) $name[ 'deathday' ] );
    $name_imdb              = trim( (string) $name[ 'imdb_id' ] );
    $name_aka               = (array) $name[ 'also_known_as' ];
    $images                 = (array) Tools::getJsonArray( $urls[ 'images' ] );    
    $images_profiles        = (array) $images[ 'profiles' ];
    $credits                = (array) Tools::getJsonArray( $urls[ 'credits' ] );    
    $credits_cast           = (array) $credits[ 'cast' ];    
    $credits_crew           = (array) $credits[ 'crew' ];
    
    if( empty( $name_biography ) )
    {
        $name_biography = '<em>No biographic sketch available.</em>';
    }    
    else    
    {
        $name_biography = preg_replace( '/\n/', '</p><p>', $name_biography );
    }
    
    $biography_birthplace   = '';
    if( !empty( $name_place_of_birth ) )
    {
        $biography_birthplace = '<li>'
            . '<em>Birthplace:&nbsp;</em><strong>'
            . $name_place_of_birth
            . '</strong></li>';
    }
    
    $biography_birthday     = NULL;
    if( !empty( $name_birthday ) )
    {
        $birthday = new DateTime( $name_birthday );
        $birthdate = $birthday->format( 'F j, Y' );
        $biography_birthday = '<li>'
            . '<em>Born:&nbsp;</em><strong>'
            . $birthdate
            . '</strong></li>';        
    }
    
    $biography_deathday     = NULL;
    if( !empty( $name_deathday ) )
    {
        $deathday = new DateTime( $name_deathday );
        $deathdate = $deathday->format( 'F j, Y' );
        $biography_deathday = '<li>'
            . '<em>Died:&nbsp;</em><strong>'
            . $deathdate
            . '</strong></li>';        
    }
    
    $biography_aka  = '';
    if( count( $name_aka ) > 0 )
    {
        sort( $name_aka );
        $akas = '';
        foreach( $name_aka as $k => $v )
        {
            $akas .= $v . '&nbsp;&nbsp;';
        }
        $biography_aka = '<li>'
            . '<em>Alias:&nbsp;</em><strong>'
            . $akas
            . '</strong></li>';
    }
    
    $urlIMDB = ( !empty( $name_imdb ) )
        ? (string) $moviesIMDB->getNameUrl( $name_imdb )
        : '';
    
    $performance_credits = '<p><em>No performance credits in the system.</em></p>';
    if( count( $credits_cast ) > 0 )
    {
        $performance_credits = '';
        foreach( $credits_cast as $key => $row )
        {
            $release_date[ $key ]   = $row[ 'release_date' ];
            $title[ $key ]          = $row[ 'title' ];
        }
        array_multisort(
            $release_date, SORT_ASC,
            $title, SORT_ASC,
            $credits_cast
        );
        foreach( $credits_cast as $cast )
        {
            $cast_id            = $cast[ 'id' ];
            $cast_title         = $cast[ 'title' ];
            $cast_character     = $cast[ 'character' ];
            $cast_release_year  = '????';
            $cast_release       = trim( $cast[ 'release_date' ] );
            if( !empty( $cast_release ) )
            {
                $cast_release_date = new DateTime( $cast_release );
                $cast_release_year = $cast_release_date->format( 'Y' );
            }
            $performance_credits .= "<p>"
                . "{$cast_release_year}&nbsp;"
                . "<strong><em>"
                . "<a href=\"title.php?id={$cast_id}\">{$cast_title}</a>"
                . "</em></strong>"
                . "<br /><strong>{$cast_character}</strong>"
                . "</p>";
        }
    }
    
    $production_credits = '<p><em>No production credits in the system.</em></p>';
    if( count( $credits_crew ) > 0 )
    {
        $production_credits = '';
        foreach( $credits_crew as $key => $row )
        {
            $release_date[ $key ]   = $row[ 'release_date' ];
        }
        array_multisort(
            $release_date, SORT_ASC,
            $credits_crew
        );
        $jobs           = array();
        foreach( $credits_crew as $crew)
        {
            $jobs[]     = $crew['job'];
        }
        sort($jobs);
        $crew_jobs = array_unique($jobs);        
        foreach( $crew_jobs as $key => $value)
        {
            $production_credits .= "<p><strong>{$value}:</strong>";
            foreach( $credits_crew as $crew )
            {
                if( $crew['job'] === $value )
                {
                    $crew_id            = $crew[ 'id' ];
                    $crew_title         = $crew[ 'title' ];
                    $crew_release_year  = '????';
                    $crew_release = trim( (string) $crew[ 'release_date' ] );                    
                    if( !empty( $crew_release ) )
                    {
                        $crew_release_date  = new DateTime( $crew_release );
                        $crew_release_year  = $crew_release_date->format( 'Y' );
                    }
                    $production_credits .= "<br />"
                        . "{$crew_release_year}&nbsp;"
                        . "<strong><em>"
                        . "<a href=\"title.php?id={$crew_id}\">"
                        . "{$crew_title}</a>"
                        . "</em></strong>";
                }
            }
            $production_credits .= "</p>";
        }
    }
    
    // HTML start
    require_once $path . '_views/head.php';
    require_once $path . '_views/navbar.php';
    require_once $path . '_views/header.php';
    require_once $path . '_views/open-jumbotron.php';
?>

    <div class="col-xs-4">
        <h2><?php echo $name_name; ?></h2>
        <?php
            $image_name = $moviesAPI->urlImage( $name_profile_path );
            if( empty( $name_profile_path ) )
            {
                $image_name = $path . '_images/no_pic.jpg';
            }        
        ?>
        <img style="border: black 1px dotted;"
             alt=""
             src="<?php echo $image_name; ?>">
        <!--
        <pre>
            <?php print_r( $name ); ?>
        </pre>
        -->
    </div>

    <div class="col-xs-8">
        <h2>Biography</h2>
        <ul style="border-bottom: silver 1px dotted;"><?php
            echo $biography_birthplace;
            echo $biography_birthday;
            echo $biography_deathday;
            echo $biography_aka;
        ?></ul>
        
        <div style="border-bottom: silver 1px dotted;">
            <p><?php echo $name_biography; ?></p>
        </div>
    </div>

    <?php require_once $path . '_views/close-jumbotron.php'; ?>

    <div class="container">
        <div class="row">
        
            <div class="col-xs-4">
                <?php require_once $path . '_views/search-again.php'; ?>
            </div>            

            <div class="col-xs-4">
                <h3>Performance Credits</h3>
                <div class="col-xs-4 credits">
                    <?php echo $performance_credits; ?>
                </div>
                <!--
                <pre>
                    <?php print_r( $credits_cast ); ?>
                </pre>
                -->
            </div>

            <div class="col-xs-4">
                <h3>Production Credits</h3>
                <div class="col-xs-4 credits">
                    <?php echo $production_credits; ?>
                </div>
                <!--
                <pre>
                    <?php print_r( $credits_crew ); ?>
                </pre>
                -->
            </div>

        <?php require_once $path . '_views/row-jumbotron.php'; ?>

            <div class="col-xs-12"> 
        
                <!-- galleria test -->
                
                <?php
                    if( !empty( $name_profile_path ) ):
                    $ct_profiles = count( $images_profiles );
                    if( $ct_profiles > 0 ):
                    $name_profile = $moviesAPI->urlImage( $name_profile_path );
                ?>
                
                <div id="galleria" style="height:480px;width:360px;">
                    
                    <?php
                        // Profile images
                        $x = 0;
                        foreach ( $images_profiles as $profile )
                        {
                            $x++;
                            $profile_image = $moviesAPI->urlImage( $profile[ 'file_path' ] );
                            $profile_description = '<ul>'
                                . $biography_birthplace
                                . $biography_birthday
                                . $biography_deathday
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
                    endif;  // re count( $images_profiles ) 
                    else:   // re main profile image
                ?>
                
                <div id="galleria">
                    <p><em>Image Unavailable</em></p>
                </div>
                
                <?php
                    endif;  // re main profile image
                ?>
                    
                <!--
                <pre>
                    <?php print_r( $images ); ?>
                </pre>
                -->
            </div>
         
        </div>
    </div>

<?php
    require_once $path . '_views/footer.php';
    require_once $path . '_views/load_jquery.php';
    require_once $path . '_views/load_galleria.php';
    require_once $path . '_views/foot.php';    
    // HTML end