<?php
    $path = '../../';
    require_once $path . '_php/autoload.php';

    $id                         = (string) $_GET[ 'id' ];
    $moviesAPI                  = new ApiMovieDB;
    $moviesIMDB                 = new IMDB;
    $urls                       = (array) $moviesAPI->urlMovie( $id );    
    $title                      = Tools::getJsonArray( $urls[ 'title' ] );    
    $title_title                = trim( (string) $title[ 'title' ] );
    $title_release_date         = trim( (string) $title[ 'release_date' ] );
    $title_poster_path          = trim( (string) $title[ 'poster_path' ] );
    $title_tagline              = trim( (string) $title[ 'tagline' ] );
    $title_overview             = trim( (string) $title[ 'overview' ] );
    $title_imdb                 = trim( (string) $title[ 'imdb_id' ] );
    $title_genres               = (array) $title[ 'genres' ];
    $title_production_companies = (array) $title[ 'production_companies' ];    
    $images                     = Tools::getJsonArray( $urls[ 'images' ] );    
    $images_posters             = (array) $images[ 'posters' ];    
    $images_backdrops           = (array) $images[ 'backdrops' ];
    $credits                    = Tools::getJsonArray( $urls[ 'credits' ] );    
    $credits_cast               = (array) $credits[ 'cast' ];    
    $credits_crew               = (array) $credits[ 'crew' ];
    
    $overview_release   = '';
    $title_release_year = '????';
    if( !empty( $title_release_date ) )
    {
        $cast_release_date  = new DateTime( $title_release_date );
        $title_release_year = $cast_release_date->format( 'Y' );
        $overview_release   = "<p>Release Date:"
            . "&nbsp;{$cast_release_date->format( 'F j, Y' )}</p>";
    }
    
    $urlIMDB = ( !empty( $title_imdb ) )
        ? (string) $moviesIMDB->getTitleUrl( $title_imdb )
        : '';
    
    $overview_genres = '';
    if ( count( $title_genres ) > 0 )
    {
        $array_genres = array();
        foreach ($title_genres as $genre )
        {
            $array_genres[] = trim( (string) $genre[ 'name' ] );
        }
        $overview_genres = '<p>' . implode( ' | ', $array_genres ) . '</p>';
    }
    
    $overview_companies = '';
    if ( count( $title_production_companies ) > 0 )
    {
        $array_companies = array();
        foreach ($title_production_companies as $company )
        {
            $array_companies[] = trim( (string) $company[ 'name' ] );
        }
        $overview_companies = '<p>' . implode( ' | ', $array_companies ) . '</p>';
    }
    
    $performance_credits = '<p><em>No performance credits in the system.</em></p>';
    if( count( $credits_cast ) > 0 )
    {
        $performance_credits = '';
        foreach( $credits_cast as $cast )
        {
            $performance_credits .= "<p>"
                . "<strong>"
                . "<a href=\"name.php?id={$cast[ 'id' ]}\">{$cast[ 'name' ]}</a>"
                . "</strong>"
                . "<br /><strong>{$cast[ 'character' ]}</strong>"
                . "</p>";
        }        
    }
    
    $production_credits = '<p><em>No production credits in the system.</em></p>';
    if( count( $credits_crew ) > 0 )
    {
        $production_credits = '';
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
                    $production_credits .= "<br />"
                    . "<strong>"
                    . "<a href=\"name.php?id={$crew[ 'id' ]}\">{$crew[ 'name' ]}</a>"
                    . "</strong>";
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

    <div class="col-xs-12">
        <h2><em><?php
            echo $title_title;
        ?></em>&nbsp;(<?php
            echo $title_release_year;
        ?>)</h2>
    </div>

    <?php require_once $path . '_views/row-jumbotron.php'; ?>

    <div class="col-xs-4">
        <?php
            $image_title = $moviesAPI->urlImage( $title_poster_path );
            if( empty( $title_poster_path ) )
            {
                $image_title = $path . '_images/no_pic.jpg';
            }        
        ?>
        <img style="border: black 1px dotted;"
             alt=""
             src="<?php echo $image_title; ?>">
        <!--
        <pre>
            <?php print_r( $title ); ?>
        </pre>
        -->
    </div>

    <div class="col-xs-8">
        <h3>Overview</h3>
        <p class="text-warning"><em><?php
            echo $title_tagline;
        ?></em></p>
        <p><?php
            echo $title_overview ;
        ?></p>
        <?php
            echo $overview_genres;
            echo $overview_release;
            echo $overview_companies;
        ?>
    </div>

    <?php require_once $path . '_views/close-jumbotron.php'; ?>

    <div class="container">
        <div class="row">

            <div class="col-xs-4">
                <?php require_once $path . '_views/search-again.php'; ?>
            </div> 

            <div class="col-xs-4">
                <h3>Performers</h3>
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
                    if( !empty( $title_poster_path ) ):
                    $ct_posters = count( $images_posters );
                    $ct_backdrops = count( $images_backdrops );
                    if(
                        $ct_posters > 0
                        or
                        $ct_backdrops > 0
                    ):
                    $title_poster = $moviesAPI->urlImage( $title_poster_path );
                ?>
                
                <div id="galleria" style="height:480px;width:360px;">
                    
                    <?php
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
                    endif;  // re count( $images_posters or $images_backdrops )
                    else:   // re main profile image
                ?>
                
                <p><em>Image Unavailable</em></p>
        
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