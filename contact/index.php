<?php
    declare( strict_types = 1 );
    // Session Variables
    session_start();
    // Page Variables
    $path       = '../';
    $subtitle   = "Contact"; 
    
    /*
     *  Custom (per page) meta
     */
    $meta_image         = 'http://jephmann.com/_images/me201708_LI.jpg';
    $meta_description   = (string) NULL;
    $meta_querystring   = (string) NULL;

    // autoload class files
    require_once $path . '_php/autoload1.php';
    
    $post_contactName       = '';
    $post_contactEmail      = '';
    $post_contactSubject    = '';
    $post_contactBody       = '';
    $eName                  = '';
    $eEmail                 = '';
    $eSubject               = '';
    $eBody                  = '';
    $eMessage               = '';
    $eSuccess               = '';
    
    if( !empty( $_POST ) )
    {
        $post_contactName       = (string) filter_input( INPUT_POST, 'contactName' );
        $post_contactEmail      = (string) filter_input( INPUT_POST, 'contactEmail' );
        $post_contactSubject    = (string) filter_input( INPUT_POST, 'contactSubject' );
        $post_contactBody       = (string) filter_input( INPUT_POST, 'contactBody' );
        
        /*
         * Server-side validation
         */
        // test incoming data
        $eName      = Tools::evaluateData(
            "Name", $post_contactName, TRUE, 250
        );
        $emailRegExp = "~^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[A-Za-z]+$~";
        $eEmail     = Tools::evaluateData(
            "Email", $post_contactEmail, TRUE, 250, $emailRegExp
        );
        $eSubject   = Tools::evaluateData(
            "Subject", $post_contactSubject, TRUE, 250
        );
        $eBody      = Tools::evaluateData(
            "Body", $post_contactBody, TRUE, 1000
        );
        // build error message
        $eMessage   = $eName . $eEmail . $eSubject . $eBody;
        
        if( $eMessage ) // if server-side errors, do not process data
        {
            $eMessage       = "<ul>{$eMessage}</ul>";
        }
        else // process the data
        {
            /*
            * PHPMailer() version
            */
            //require_once '_mailer.php';

            /*
            * database version, in lieu of e-mail support
            */
            require_once '_mysql.php';
            
            /*
            * mail() version
            */
            require_once '_mail.php';

            // ensure data not resent during refresh
            unset($_POST);
            header('Location:'.$_SERVER['PHP_SELF']);
        }
        
    }
    /*
     *  HTML start
     */
    require_once $path . '_views/head.php';
    require_once $path . '_views/navbar.php';
    require_once $path . '_views/header.php';
?>

<div class="container">
    <div class="jumbotron">
        <div class="row">
            
            <div class="col-lg-6 col-md-6 col-sm-6">
                
                <h2>Contact</h2>
                
                <p>
                    Feel free to say "hello". I welcome constructive criticism
                    (and ignore the other kind) regarding this project. Where
                    applicable, I take requests regarding additional
                    technologies for me to learn and test in this workshop.
                </p>                
                
                <h3>BTW:</h3>
                
                <ul>
                    <li>
                        This form is my first foray into ReactJS. CDN links for
                        ReactJS and Babel enable those aspects of this form.
                    </li>
                    <li>
                        This form has both server-side and client-side
                        validation.
                    </li>
                    <li>
                        Via the form, you may receive an e-mail confirmation of
                        your message.
                    </li>
                    <li>
                        For back-up, I am inserting data from this form into a
                        database table.
                    </li>
                </ul>
                
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-6">
                
                <h3>All fields are required. Each has a character limit.</h3>
                
                <?php if( $eMessage ) : ?>
                
                <div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Message blocked:</strong>
                    <?php echo $eMessage; ?>
                </div>
                
                <?php
                    elseif( array_key_exists('Contact', $_SESSION )) :
                        if( $_SESSION['Contact']['Success'] ) :
                ?>
                
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Message received!</strong>
                    <?php echo $eSuccess; ?>
                </div>
                
                <?php
                        endif;
                    endif;
                ?>
               
                <div id="contact"></div>
                    
            </div>            
        </div>        
    </div>
</div>
<?php
    require_once $path . '_views/footer.php';
    require_once $path . '_views/load/jquery.php';
    require_once $path . '_views/load/bootstrap.php';
    require_once $path . '_views/load/reactJS.php';
?>

    <script type="text/babel"
        src="<?php echo $path; ?>_js/contact.js"></script>
<?php
    require_once $path . '_views/load/google-analytics.php';
    require_once $path . '_views/foot.php';
    /*
     *  HTML end
     */