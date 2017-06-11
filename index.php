<?php
    declare( strict_types = 1 );
    $path       = '';
    $subtitle   = "Home";

    // HTML start
    require_once '_views/head.php';
    require_once '_views/navbar.php';
    require_once '_views/header.php';
?>
<div class="container">

    <div class="jumbotron">
        <div class="row">
            
            <div class="col-lg-5 col-md-5 col-sm-5">

                <img src="_images/379395_2896829097182_85266811_n.jpg"
                     alt="Jeffrey Hartmann"
                     width="100%" />
                <blockquote class="blockquote-reverse">
                    <p>Me on/about 2012. I still have most of this hair,
                    but I now have new eyeglass frames. Here's hoping
                    for a more recent image some day soon.</p>
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
                    By the way: Not to bury the lead or anything, but as I
                    write this (June 2017), I would not mind a full-time,
                    permanent job. Feel free to contact me
                    <em>privately</em> via <a target="_blank"
                    title="LinkedIn: Jeffrey Hartmann"
                    href="https://www.linkedin.com/in/jeffreyhartmann//">LinkedIn</a>.
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
    // HTML end