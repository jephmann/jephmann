<?php
    declare( strict_types = 1 );
    $path       = '../../';
    $subtitle   = 'Movies: Database Version';

    /*
     *  Custom (per page) meta
     */
    $meta_image         = 'http://jephmann.com/_images/me201708.jpg';
    $meta_description   = (string) NULL;
    /*
     *  HTML start
     */
    require_once $path . '_views/head.php';
    require_once $path . '_views/navbar.php';
    require_once $path . '_views/header.php';
    require_once $path . '_views/open-jumbotron.php';
?>
    
    <div class="col-lg-12 col-md-12 col-sm-12">
        <h2>The Movie Section: The Database Version</h2>
        <p>
            Well... perhaps after I have a chat with my web host. ;)
        </p>
        <p>
            Regardless, I can say with some confidence that I am rather
            comfortable with relational databases, including MySQL. For years, I
            maintained a rather detailed MS Access database of my rather
            extensive DVD collection; among other things, this is what I would
            use to practice coding by mimicking in my own fashion some of the
            basic principles behind the Internet Movie Database.
        </p>
        <p>
            That is, until I could no longer afford Access and until I had to
            sell my DVD collection. :(
        </p>
        <p>
            Anyhow, with my sincere apologies, you may consider this area
            "under construction".
        </p>
    </div>

<?php
    require_once $path . '_views/close-jumbotron.php';
    require_once $path . '_views/footer.php';
    require_once $path . '_views/load/jquery.php';
    require_once $path . '_views/load/bootstrap.php';
    require_once $path . '_views/load/google-analytics.php';
    require_once $path . '_views/foot.php';    
    /*
     *  HTML end
     */