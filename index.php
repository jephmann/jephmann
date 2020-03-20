<?php
    declare( strict_types = 1 );
    // Session Variables
    session_start();
    $_SESSION['Contact']['Success'] = FALSE;
    // Page Variables
    $path       = '';
    $subtitle   = date('F Y') . ': Available for Work';

    /*
     *  Custom (per page) meta
     */
    $meta_image         = 'http://jephmann.com/_images/me201708_LI.jpg';
    $meta_description   = date('F Y')
            . ': Available for work.'
            . ' Please contact me privately for details. | ';
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
            
            <div class="col-lg-12 col-md-12 col-sm-12">            
                                
                <h2>Welcome to my workshop!</h2>
                
            </div>
            
        </div>
        
        <div class="row">
            
            <div class="col-lg-5 col-md-5 col-sm-5">

                <img src="_images/me201708.jpg"
                     alt="Jeffrey Hartmann"
                     class="img100w" />
                <blockquote class="blockquote-reverse">
                    <h3>August 2017</h3>
                    <small style="color: silver;">My most recent photo</small>
                </blockquote>

            </div>
            
            <div class="col-lg-7 col-md-7 col-sm-7">
                
                <p>
                    For a far more verbose explanation of this project,
                    you may click
                    <a title="Jeffrey Hartmann: About"
                        data-toggle="tooltip" data-placement="top"
                        data-original-title="About this project"
                        href="about/">About</a>.
                    Feel free to click anywhere else within this project,
                    whether "finished" or not. (Frankly, that's the idea.)
                </p>
                <p>
                    By the way: as you read this (<?php echo $thisMonthYear; ?>),
                    I am available for full-time, permanent work, in and out of
                    web development and design. For details, feel free to try my                    
                    <a title="Jeffrey Hartmann: Contact"
                        data-toggle="tooltip" data-placement="top"
                        data-original-title="Contact Jeffrey Hartmann"
                        href="contact/">Contact</a>
                    form; otherwise, please contact me <em>privately</em> via
                    <a target="_blank" title="LinkedIn: Jeffrey Hartmann"
                        data-toggle="tooltip" data-placement="top"
                        data-original-title="Contact Jeffrey Hartmann"
                        href="https://www.linkedin.com/in/jeffreyhartmann/">LinkedIn</a>
                    or via any other social media where you may find me.
                </p>
                <p>
                    Thanks for visiting!
                </p>
                
                <div>
                    <h4 style="text-align: right;">
                        <a title="Jeffrey Hartmann: About"
                        data-toggle="tooltip" data-placement="top"
                        data-original-title="About this project"
                        href="about/">About</a>
                        |
                        <a title="Jeffrey Hartmann: Movies"
                        data-toggle="tooltip" data-placement="top"
                        data-original-title="Movies"
                        href="movies/">Movies</a>
                        |
                        <a title="Jeffrey Hartmann: Weather"
                        data-toggle="tooltip" data-placement="top"
                        data-original-title="Weather"
                        href="weather/">Weather</a>
                        |
                        <a title="Jeffrey Hartmann: Contact"
                        data-toggle="tooltip" data-placement="top"
                        data-original-title="Contact Jeffrey Hartmann"
                        href="contact/">Contact</a>
                    </h4>
                </div>
                
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