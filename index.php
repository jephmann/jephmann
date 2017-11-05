<?php
    declare( strict_types = 1 );
    $path       = '';
    $subtitle   = "Available for Hire";

    /*
     *  Custom (per page) meta
     */
    $meta_image         = 'http://jephmann.com/_images/me201708.jpg';
    $meta_description   = date('F Y')
            . ': I am available for work,'
            . ' in and out of web development and design.'
            . ' Would prefer to remain in Chicago;'
            . ' open to relocation.'
            . ' Classic/cult film buff.'
            . ' A folk-rocker at heart. | ';
    $meta_querystring   = (string) NULL;
    /*
     * HTML start
     */ 
    require_once '_views/head.php';
    require_once '_views/navbar.php';
    require_once '_views/header.php';
?>
<div class="container">

    <div class="jumbotron">
        <div class="row">
            
            <div class="col-lg-5 col-md-5 col-sm-5">

                <img src="_images/me201708.jpg"
                     alt="Jeffrey Hartmann"
                     class="img100w" />
                <blockquote class="blockquote-reverse">
                    <p>August 2017</p>
                    <small>Me</small>
                </blockquote>

            </div>
            
            <div class="col-lg-7 col-md-7 col-sm-7">
                
                <h2>Welcome to my workshop!</h2>
                
                <p>
                    For a far more verbose explanation of this project,
                        you may click <a title="Jeffrey Hartmann: About"
                        href="about/">About</a>.
                </p>
                <p>
                    Feel free to click anywhere else within this project,
                    whether "finished" or not. (Frankly, that's the idea.)
                </p>
                <p>
                    By the way: Not to bury the lead or anything, but as I
                    write this (<?php echo $thisMonthYear; ?>), I would not
                    mind a full-time, permanent job. Feel free to contact me
                    <em>privately</em> via <a target="_blank"
                    title="LinkedIn: Jeffrey Hartmann"
                    href="https://www.linkedin.com/in/jeffreyhartmann//">LinkedIn</a>
                    or via any other social media where you may find me.
                </p>
                <p>
                    Thanks for visiting!
                </p>
                
            </div> 
            
        </div>        
    </div>
    
</div>
<?php
    require_once '_views/footer.php';
    require_once '_views/load/jquery.php';
    require_once '_views/load/bootstrap.php';
    require_once '_views/load/google-analytics.php';
    require_once '_views/foot.php';
    /*
     *  HTML end
     */