<?php
    declare( strict_types = 1 );
    $path = '../../';
    $subtitle   = 'Movies (TMDB)';

    require_once $path . '_php/autoload.php';

    $id                     = (string) $_GET[ 'id' ];
    $moviesAPI              = new ApiMovieDB;
    $moviesIMDB             = new IMDB;

    // name
    $name                   = (array) $moviesAPI->getSubTopicData(
                                $id, 'person', 'name'
                            );
    $name_name              = trim( (string) $name[ 'name' ] );
    $name_profile_path      = trim( (string) $name[ 'profile_path' ] );
    $name_biography         = trim( (string) $name[ 'biography' ] );
    $name_place_of_birth    = trim( (string) $name[ 'place_of_birth' ] );
    $name_birthday          = array_key_exists( 'birthday', $name )
                            ? trim( (string) $name[ 'birthday' ] )
                            : '';
    $name_deathday          = array_key_exists( 'deathday', $name )
                            ? trim( (string) $name[ 'deathday' ] )
                            : '';
    $name_imdb              = trim( (string) $name[ 'imdb_id' ] );
    $name_aka               = (array) $name[ 'also_known_as' ];
    $ct_name_aka            = (int) count( $name_aka );

    // main image
    $image_name             = empty( $name_profile_path )
                            ? "{$path}_images/no_pic.jpg"
                            : (string) $moviesAPI->urlImage( $name_profile_path );

    // name images
    $images                 = (array) $moviesAPI->getSubTopicData(
                                $id, 'person', 'images'
                            );
    $images_profiles        = (array) $images[ 'profiles' ];
    $ct_profiles            = (int) count( $images_profiles );

    // credits
    $credits                = (array) $moviesAPI->getSubTopicData(
                                $id, 'person', 'credits'
                            );
    $credits_cast           = (array) $credits[ 'cast' ];
    $credits_crew           = (array) $credits[ 'crew' ];
    $ct_credits_cast        = (int) count( $credits_cast );
    $ct_credits_crew        = (int) count( $credits_crew );

    $biography_name         = !empty( $name_biography )
        ? preg_replace( '/\n/', '</p><p>', $name_biography )
        : '<em>No biographic sketch available.</em>';

    $biography_birthplace   = !empty( $name_place_of_birth )
        ? "<li><em>Birthplace:&nbsp;</em><strong>{$name_place_of_birth}</strong></li>"
        : '';

    $biography_birthday     = NULL;
    $birthyear              = NULL;
    if( !empty( $name_birthday ) )
    {
        $birthday           = new DateTime( $name_birthday );
        $birthdate          = (string) $birthday->format( 'F j, Y' );
        $birthyear          = (int) $birthday->format( 'Y' );
        $biography_birthday = "<li><em>Born:&nbsp;</em><strong>{$birthdate}</strong></li>";
    }

    $biography_deathday     = NULL;
    $deathyear              = NULL;
    if( !empty( $name_deathday ) )
    {
        $deathday           = new DateTime( $name_deathday );
        $deathdate          = (string) $deathday->format( 'F j, Y' );
        $deathyear          = (int) $deathday->format( 'Y' );
        $biography_deathday = "<li><em>Died:&nbsp;</em><strong>{$deathdate}</strong></li>";        
    }

    $born_died              = NULL;
    if ( $birthyear and $deathyear )
    {
       $born_died = "{$birthyear}-{$deathyear}"; 
    }
    elseif ( $birthyear and empty($deathyear) )
    {
       $born_died = "b. {$birthyear}"; 
    }
    elseif ( empty($birthyear) and $deathyear )
    {
       $born_died = "d. {$deathyear}"; 
    }

    if ( $born_died )
    {
        $born_died = "({$born_died})";
    }

    $biography_aka  = '';
    if( $ct_name_aka > 0 )
    {
        sort( $name_aka );
        $akas = '';
        foreach( $name_aka as $k => $v )
        {
            $akas .= "{$v}&nbsp;&nbsp;";
        }
        $biography_aka = "<li><em>Alias:&nbsp;</em><strong>{$akas}</strong></li>";
    }

    $urlIMDB = !empty( $name_imdb )
        ? (string) $moviesIMDB->getNameUrl( $name_imdb )
        : '';

    $urlMovieDB = (string) $moviesAPI->getPublicUrl( $id, 'person' );

    $performance_credits = '<p><em>No performance credits in the system.</em></p>';
    if( $ct_credits_cast > 0 )
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
            $cast_id            = (string) $cast[ 'id' ];
            $cast_title         = (string) $cast[ 'title' ];
            $cast_character     = array_key_exists( 'character', $cast )
                    ? (string) $cast[ 'character' ]
                    : '';
            $cast_release_year  = '????';        
            if( array_key_exists( 'release_date', $cast ))
            {        
                $cast_release   = trim( (string) $cast[ 'release_date' ] );
                if( !empty( $cast_release ) )
                {
                    $cast_release_date = new DateTime( $cast_release );
                    $cast_release_year = $cast_release_date->format( 'Y' );
                }            
            }
            $performance_credits .= "<p>"
                . "{$cast_release_year}&nbsp;&nbsp;"
                . "<strong><em>"
                . "<a href=\"title.php?id={$cast_id}\">{$cast_title}</a>"
                . "</em></strong>"
                . "<br /><strong>{$cast_character}</strong>"
                . "</p>";
        }
    }

    $production_credits = '<p><em>No production credits in the system.</em></p>';
    if( $ct_credits_crew > 0 )
    {
        $production_credits = '';
        foreach( $credits_crew as $key => $row )
        {
            $release_date[ $key ]   = (string) $row[ 'release_date' ];
        }
        $jobs           = array();
        foreach( $credits_crew as $crew)
        {
            $jobs[]     = $crew['job'];
        }
        sort($jobs);
        $crew_jobs = array_unique($jobs);
        $crew_jobs_sorted = array();
        foreach( $crew_jobs as $key => $value)
        {
            $production_credits .= "<p><strong>{$value}:</strong>";
            foreach( $credits_crew as $crew )
            {
                if( $crew['job'] === $value )
                {
                    $crew_id            = (string) $crew[ 'id' ];
                    $crew_title         = (string) $crew[ 'title' ];
                    $crew_release_year  = '????';
                    $crew_release       = trim( (string) $crew[ 'release_date' ] );                    
                    if( !empty( $crew_release ) )
                    {
                        $crew_release_date  = new DateTime( $crew_release );
                        $crew_release_year  = $crew_release_date->format( 'Y' );
                    }
                    $crew_jobs_data = array(
                        'release_year'  => $crew_release_year,
                        'title'         => $crew_title,
                        'id'            => $crew_id,
                    );
                    array_push( $crew_jobs_sorted, $crew_jobs_data );
                }
            }
            foreach( $crew_jobs_sorted as $key => $row )
            {
                $c_release_year[ $key ] = $row[ 'release_year' ];
                $c_title[ $key ]        = $row[ 'title' ];
            }
            array_multisort(
                $c_release_year, SORT_ASC,
                $c_title, SORT_ASC,
                $crew_jobs_sorted );
            $crew_jobs_unique = array_unique( $crew_jobs_sorted, SORT_REGULAR );
            foreach ( $crew_jobs_unique as $cj )
            {
                $crew_job_year  = $cj[ 'release_year' ];
                $crew_job_title = $cj[ 'title' ];
                $crew_job_id    = $cj[ 'id' ];
                $production_credits .= "<br />"
                    . "{$crew_job_year}&nbsp;&nbsp;"
                    . "<strong><em>"
                    . "<a href=\"title.php?id={$crew_job_id}\">"
                    . "{$crew_job_title}</a>"
                    . "</em></strong>";
            }        

            $production_credits .= "</p>";
        }
    }

    $subtitle .= ": {$name_name} {$born_died}";

    $creditFooter   = "Click the heading above to show or hide the list.";
    
    //for Twitter sharebuttons (delimit with comma)
    $hashtag = 'themoviedb,jephmann';

    /*
     *  Custom (per page) meta
     */
    $meta_image         = $image_name;
    $meta_description   = htmlspecialchars( $name_biography )
                        . ' | Data courtesy of TheMovieDB.com | ';
    $meta_querystring   = "?id={$id}";
    /*
     *  HTML start
     */
    require_once $path . '_views/head.php';
    require_once $path . '_views/navbar.php';
    require_once $path . '_views/header.php';
    require_once $path . '_views/open-jumbotron.php';
?>
    
    <div class="col-lg-12 col-md-12 col-sm-12">
        <h2>The Movie Section: TheMovieDB Version</h2>    
    </div>
    
    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">
                    <?php echo $name_name . ' ' . $born_died; ?>
                </h2>
            </div>
            <div class="panel-body">
                
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
                                . $biography_birthplace
                                . $biography_birthday
                                . $biography_deathday
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
                    else:
                ?>
                <h4>
                    <em>Gallery Unavailable</em>
                </h4>
                <?php
                    endif;
                ?>
                
                <?php
                    // TEST
                    //require_once $path . '_php/pre/movies_api_images.php';
                ?>

            </div>
            <div class="panel-footer">
                <?php
                    $logo_title = $name_name;
                    require_once $path . '_views/movies/logo-links.php';
                ?>
            </div>            
        </div>
        <?php
            require_once $path . '_views/share-buttons.php';
        ?>
    </div>

    <div class="col-lg-8 col-md-8 col-sm-8">
        <h3>Biography</h3>
        <ul><?php
            echo $biography_birthplace;
            echo $biography_birthday;
            echo $biography_deathday;
            echo $biography_aka;
        ?></ul>
        
        <div>
            <p><?php echo $biography_name; ?></p>
        </div>
        
        <?php
            // TEST
            //require_once $path . '_php/pre/movies_api_name.php';
        ?>
    </div>

    <?php require_once $path . '_views/close-jumbotron.php'; ?>

    <div class="container">

        <div class="row">            

            <div class="col-lg-4 col-md-4 col-sm-4">                    
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <a data-toggle="collapse" href="#performances"
                               title="Click for Performance credits">Performances</a>
                            <span class="caret"></span>
                        </h3>
                    </div>
                    <div class="panel-body panel-collapse collapse in" id="performances">
                        <?php echo $performance_credits; ?>
                    </div>
                    <div class="panel-footer">
                        <p><?php echo $creditFooter; ?></p>
                    </div>
                </div>
                <?php
                    // TEST
                    //require_once $path . '_php/pre/movies_api_cast.php';
                ?>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4">       
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <a data-toggle="collapse" href="#production"
                               title="Click for Production credits">Production</a>
                            <span class="caret"></span>
                        </h3>
                    </div>
                    <div class="panel-body panel-collapse collapse in" id="production">
                        <?php echo $production_credits; ?>
                    </div>
                    <div class="panel-footer">
                        <p><?php echo $creditFooter; ?></p>
                    </div>
                </div>
                <?php
                    // TEST
                    //require_once $path . '_php/pre/movies_api_crew.php';
                ?>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4">
                
                <?php require_once $path . '_views/movies/search.php'; ?>
                
            </div>

        </div>
        
    </div>

<?php
    require_once $path . '_views/footer.php';
    require_once $path . '_views/load/jquery.php';
    require_once $path . '_views/load/bootstrap.php';                    
    if( !empty( $name_profile_path ) )
    {
        if( $ct_profiles > 0 ){                    
            require_once $path . '_views/load/galleria.php';        
        }    
    }
    require_once $path . '_views/load/google-analytics.php';
    require_once $path . '_views/foot.php';    
    /*
     *  HTML end
     */