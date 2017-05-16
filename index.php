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

                <img src="_images/the-general-buster-keaton-3-540x362.jpg"
                     alt="Buster Keaton"
                     width="100%" />
                <blockquote class="blockquote-reverse">
                    <p>Think slow, act fast.</p>
                    <small>Buster Keaton</small>
                </blockquote>

            </div>
            
            <div class="col-lg-7 col-md-7 col-sm-7">
                
                <h2>Welcome to my workshop!</h2>
                
                <p>
                    Why do I have a (hopefully public domain) picture of Buster
                    Keaton instead of a picture of myself?
                </p>
                
                <ul>
                    <li>
                        I'm not sure whether I want to be all that recognizable.
                    </li>
                    <li>
                        I can't find anyone who would take a current photo of me.
                    </li>
                    <li>
                        Plus, I prefer to work with monochromatic layouts,
                        especially black-and-white, and such photos help me
                        choose the right background colors for these pages.
                    </li>
                    <li>
                        For a far more verbose explanation of this project,
                        you may click <a title="Jeffrey Hartmann: About"
                        href="about/">About</a>.
                    </li>
                    <li>
                        By the way: Not to bury the lead or anything, but as I
                        write this (May 2017), I would not mind a full-time,
                        permanent job. You may contact me at <a target="_blank"
                        title="LinkedIn: Jeffrey Hartmann"
                        href="https://www.linkedin.com/in/jeffreyhartmann//">LinkedIn</a>.
                    </li>
                </ul>
                
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