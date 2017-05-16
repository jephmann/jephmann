<?php
    $page = array (
        'path' => NULL,
        'template' => 'jumbotron',
    );
    require_once ($page['path'] . '_inc/first.php');
    
    // HTML
    require '_views/head.php';
    require '_views/navigation.php';
?>
        <div class="jumbotron">
            <div class="container">
                <h1>WUnderGround by ZIP</h1>
                <p>Based on:
                    <a target="_blank" href="http://www.wunderground.com/weather/api/d/docs?d=data/forecast&MR=1">
                        http://www.wunderground.com/weather/api/d/docs?d=data/forecast&MR=1
                    </a>
                </p>
                <!-- our form -->
                <form id='userForm'>
                    <div>
                        <input type='text' name='zip' required="required" placeholder='Enter 5-digit ZIP Code' />
                        <input type='submit' value='Get Weather' />
                    </div>
                </form>
                <!--
                <p>
                    <a class="btn btn-primary btn-lg" role="button">Learn more &raquo;</a>
                </p>
                -->
            </div>
        </div> 
        
        <!-- where the response will be displayed -->
        
        <div class="container">       
        
            <!-- Create a div which will be the canvasloader wrapper -->	
            <div id="canvasloader-container" class="wrapper"></div>
            
            <!-- Example row of columns -->
            <div class="row" id='response'>


            </div>
            <hr>
        </div>
        
        <script src="http://heartcode-canvasloader.googlecode.com/files/heartcode-canvasloader-min-0.9.1.js"></script>
        <script>
            $(document).ready(function(){
                
                $('#userForm').submit(function(){
                    
                    var cl = new CanvasLoader('canvasloader-container');
                    cl.show(); // Hidden by default
                    // This bit is only for positioning - not necessary
                    var loaderObj = document.getElementById("canvasLoader");
                    loaderObj.style.position = "absolute";
                    loaderObj.style["top"] = cl.getDiameter() * -0.5 + "px";
                    loaderObj.style["left"] = cl.getDiameter() * -0.5 + "px";
     
                    // show that something is loading
                    $('#response').html("<b>Loading weather...</b>");

                    /*
                     * 'weather.php' - where you will pass the form data
                     * $(this).serialize() - to easily read form data
                     * function(data){... - data contains the response from weather.php
                     */
                    $.post('weather.php', $(this).serialize(), function(data){

                        // show the response
                        $('#response').html(data);
                    
                        cl.hide();

                    }).fail(function() {

                        // just in case posting your form failed
                        alert( "Posting failed." );
                    
                        cl.hide();

                    });

                    // to prevent refreshing the whole page page
                    return false;

                });
            });
        </script>
<?php
    require '_views/footer.php';
    require '_views/foot.php';
?>