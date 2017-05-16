<?php
    declare( strict_types = 1 );
    $path       = '../';
    $subtitle   = 'Movies';
    
    // HTML start
    require_once $path . '_views/head.php';
    require_once $path . '_views/navbar.php';
    require_once $path . '_views/header.php';
?>
<div class="container">
    <div class="jumbotron">
        <div class="row">    
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h2>The Movie Section</h2>
                <p><em>Why do I have two different versions of... whatever this is?</em></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <h3>TheMovieDB Version</h3>
                <p>
                    Here I retrieve data from an outside source, the API of The
                    Movie Database -- not to be confused with The Internet Movie
                    Database, which does not have an API (at least, not a free
                    one).</p>
                <p>
                    <a href="api" class="btn btn-default btn-lg btn-block">TheMovieDB Version</a>
                </p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <h3>The Database Version</h3>
                <p>
                    Here I (plan to) retrieve data from my own MySQL database.
                    The data is limited to movies from my collection.
                </p>
                <p>
                    <a href="db" class="btn btn-default btn-lg btn-block">DB Version</a>
                </p>
            </div>            
        </div>        
    </div>
</div>                
<?php
    require_once $path . '_views/footer.php';
    require_once $path . '_views/load/jquery.php';
    require_once $path . '_views/load/bootstrap.php';
    require_once $path . '_views/load/google-analytics.php';
    require_once $path . '_views/foot.php';
?>
