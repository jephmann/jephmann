<?php
    declare( strict_types = 1 );
    $path = '../../';
    $subtitle   = 'Movies (TMDB)';

require_once $path . '_php/autoload.php';

$id                             = (string) $_GET[ 'id' ];
$moviesAPI                      = new ApiMovieDB;
$moviesIMDB                     = new IMDB;

// title
$title                          = (array) $moviesAPI->getSubTopicData(
                                    $id, 'movie', 'title'
                                );
$title_title                    = trim( (string) $title[ 'title' ] );
$title_release_date             = trim( (string) $title[ 'release_date' ] );
$title_poster_path              = trim( (string) $title[ 'poster_path' ] );
$title_tagline                  = trim( (string) $title[ 'tagline' ] );
$title_overview                 = trim( (string) $title[ 'overview' ] );
$title_imdb                     = trim( (string) $title[ 'imdb_id' ] );
$title_genres                   = (array) $title[ 'genres' ];
$title_production_companies     = (array) $title[ 'production_companies' ]; 
$ct_title_genres                = (int) count( $title_genres );
$ct_title_production_companies  = (int) count( $title_production_companies );

// main image
$image_title                    = empty( $title_poster_path )
                                ? "{$path}_images/no_pic.jpg"
                                : (string) $moviesAPI->urlImage( $title_poster_path );

// gallery images
$images                         = (array) $moviesAPI->getSubTopicData(
                                    $id, 'movie', 'images'
                                );
$images_posters                 = (array) $images[ 'posters' ];    
$images_backdrops               = (array) $images[ 'backdrops' ];
$ct_posters                     = (int) count( $images_posters );
$ct_backdrops                   = (int) count( $images_backdrops );

// credits
$credits                        = (array) $moviesAPI->getSubTopicData(
                                    $id, 'movie', 'credits'
                                );
$credits_cast                   = (array) $credits[ 'cast' ];
$credits_crew                   = (array) $credits[ 'crew' ];
$ct_credits_cast                = (int) count( $credits_cast );
$ct_credits_crew                = (int) count( $credits_crew );

// videos
$videos                         = (array) $moviesAPI->getSubTopicData(
                                    $id, 'movie', 'videos'
                                );

$overview_release   = '';
$title_release_year = '????';
if( !empty( $title_release_date ) )
{
    $cast_release_date  = new DateTime( $title_release_date );
    $title_release_year = $cast_release_date->format( 'Y' );
    $overview_release   = "<p>Release Date:"
        . "&nbsp;{$cast_release_date->format( 'F j, Y' )}</p>";
}

$urlIMDB = !empty( $title_imdb )
    ? (string) $moviesIMDB->getTitleUrl( $title_imdb )
    : '';

$urlMovieDB = (string) $moviesAPI->getPublicUrl( $id, 'movie' );

$overview_genres = '';
if ( $ct_title_genres > 0 )
{
    $array_genres           = array();
    foreach ($title_genres as $genre )
    {
        $genre_name         = trim( (string) $genre[ 'name' ] );
        $array_genres[]     = $genre_name;
    }
    $overview_genres = '<p>' . implode( ' | ', $array_genres ) . '</p>';
}

$overview_companies = '';
if ( $ct_title_production_companies > 0 )
{
    $array_companies        = array();
    foreach ($title_production_companies as $company )
    {
        $company_name       = trim( (string) $company[ 'name' ] );
        $array_companies[]  = $company_name;
    }
    $overview_companies = '<p>' . implode( ' | ', $array_companies ) . '</p>';
}

$performance_credits = '<p><em>No performance credits in the system.</em></p>';
if( $ct_credits_cast > 0 )
{
    $performance_credits = '';
    foreach( $credits_cast as $cast )
    {
        $cast_id        = (string) $cast[ 'id' ];
        $cast_name      = (string) $cast[ 'name' ];
        $cast_character = (string) $cast[ 'character' ];
        $performance_credits .= "<p>"
            . "<strong>"
            . "<a href=\"name.php?id={$cast_id}\">{$cast_name}</a>"
            . "</strong>"
            . "<br /><strong>{$cast_character}</strong>"
            . "</p>";
    }        
}

$production_credits = '<p><em>No production credits in the system.</em></p>';
if( $ct_credits_crew > 0 )
{
    $production_credits = '';
    $jobs           = array();
    foreach( $credits_crew as $crew)
    {
        $jobs[]     = $crew['job'];
    }
    sort( $jobs );
    $crew_jobs = array_unique( $jobs );        
    foreach( $crew_jobs as $key => $value )
    {
        $production_credits .= "<p><strong>{$value}:</strong>";
        foreach( $credits_crew as $crew )
        {
            if( $crew['job'] === $value )
            {
                $crew_id            = (string) $crew[ 'id' ];
                $crew_name          = (string) $crew[ 'name' ];    
                $production_credits .= "<br />"
                . "<strong>"
                . "<a href=\"name.php?id={$crew_id}\">{$crew_name}</a>"
                . "</strong>";
            }
        }
        $production_credits .= "</p>";
    }
}

$subtitle .= ": {$title_title} ({$title_release_year})";

// HTML start
require_once $path . '_views/head.php';
require_once $path . '_views/navbar.php';
require_once $path . '_views/header.php';
require_once $path . '_views/open-jumbotron.php';
?>
    
    <div class="col-lg-12 col-md-12 col-sm-12">
        <h2>The Movie Section: TheMovieDB Version</h2>    
    </div>

    <?php require_once $path . '_views/row-jumbotron.php'; ?>

    <div class="col-lg-4 col-md-4 col-sm-4"> 
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">
                    <em><?php echo $title_title; ?></em>
                    (<?php echo $title_release_year; ?>)
                </h2>
            </div>
            <div class="panel-body">
                
                <!--
                <img style="border: black 1px dotted;" width="100%"
                     alt="<?php echo $title_title; ?>"
                     src="<?php echo $image_title; ?>">
                -->                
                
                <?php
                    if( !empty( $title_poster_path ) and ( $ct_posters > 0 or $ct_backdrops > 0 ) ):
                    $title_poster = $moviesAPI->urlImage( $title_poster_path );
                ?>    
                <div id="galleria" width="100%">

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
                ?>
                
                <!--
                <pre>
                    <?php print_r( $images ); ?>
                </pre>
                -->
            </div>
            <div class="panel-footer">
                <?php
                    $logo_title = $title_title;
                    require_once $path . '_views/movies/logo-links.php';
                ?>
            </div>
        </div>
    </div>

    <div class="col-lg-8 col-md-8 col-sm-8">
        
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
            
            $videos_results = (array) $videos[ 'results' ];
            $ctVideos = (int) count($videos_results);
            if( $ctVideos>0 ):
                $ctTrailers = 0;
                for( $v=0; $v<$ctVideos; $v++ )
                {
                    $video_type     = (string) $videos_results[ $v ][ 'type' ];
                    if ( $video_type == "Trailer" )
                    {
                        $ctTrailers++;
                    }
                }
                if ( $ctTrailers > 0 ):
        ?>
        
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Trailer *</h3>
            </div>
            <div class="panel-body">
                
                <?php
                    for( $v=0; $v<$ctVideos; $v++ ) :
                    $video_key      = (string) $videos_results[ $v ][ 'key' ];
                    $video_size     = (int) $videos_results[ $v ][ 'size' ];
                    $video_type     = (string) $videos_results[ $v ][ 'type' ];
                    if( $video_type == "Trailer" ):                                  

                        $aspect_ratio = $video_size === 360
                            ? "4by3" : "16by9";
                ?>
                <!-- based on http://scotch.io -->
                        
                <div class="embed-responsive embed-responsive-<?php echo $aspect_ratio ?>">
                    <iframe class="embed-responsive-item" src="//www.youtube.com/embed/<?php echo $video_key ?>"></iframe>
                </div>
                <hr/>
                <?php
                    endif;
                    endfor;
                ?>
            </div>
            <div class="panel-footer">
                * Although TheMovieDB may suggest that at least one trailer might
                exist in YouTube for this title, YouTube might not necessarily
                have any trailers for this title.
            </div>
        </div>
        
        <?php
            endif;
            endif;
        ?>
        <!--
        <pre>
            <?php print_r( $title ); ?>
        </pre>
        -->
        <!--
        <pre>
            <?php print_r( $videos ); ?>
        </pre>
        -->
        
    </div>

    <?php require_once $path . '_views/close-jumbotron.php'; ?>

    <div class="container">

        <div class="row">

            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <a data-toggle="collapse" href="#performers"
                               title="Click for Performer credits">Performers</a>
                            <span class="caret"></span
                        </h3>
                    </div>
                    <div class="panel-body panel-collapse collapse" id="performers">
                        <?php echo $performance_credits; ?>
                    </div>
                    <div class="panel-footer">
                        <p>Click the heading above to see the list (if any).</p>
                    </div>
                </div>
                <!--
                <pre>
                    <?php print_r( $credits_cast ); ?>
                </pre>
                -->
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
                    <div class="panel-body panel-collapse collapse" id="production">
                        <?php echo $production_credits; ?>
                    </div>
                    <div class="panel-footer">
                        <p>Click the heading above to see the list (if any).</p>
                    </div>
                </div>
                <!--
                <pre>
                    <?php print_r( $credits_crew ); ?>
                </pre>
                -->
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
    if( !empty( $title_poster_path ) )
    {
        if( $ct_posters > 0 or $ct_backdrops > 0 ){                    
            require_once $path . '_views/load/galleria.php';        
        }    
    }
    require_once $path . '_views/load/google-analytics.php';
    require_once $path . '_views/foot.php';    
    // HTML end