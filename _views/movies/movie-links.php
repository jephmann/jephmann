
        <h4>Additional information:</h4>
        
        <p style="font-size: 1em;">
            
            <a target="_blank"
                title="The Movie Database page for <?php echo $logo_title; ?>"
                data-toggle="tooltip"
                data-placement="top"
                data-original-title="The Movie Database page for <?php echo $logo_title; ?>"
                data-animation="false"
                href="<?php echo $overview[ 'urlMovieDB' ]; ?>">The Movie Database</a>
            
            <?php if( !empty( $overview[ 'urlIMDB' ] ) ): ?>
            
            <br />            
            <a target="_blank"
                title="Internet Movie Database page for <?php echo $logo_title; ?>"
                href="<?php echo $overview[ 'urlIMDB' ]; ?>">Internet Movie Database</a> 
                
            <?php endif; ?>
            
            <?php if( !empty( $overview[ 'homepage' ] ) ): ?>
            
            <br />
            <a target="_blank"
                title="Home page for <?php echo $logo_title; ?>"
                href="<?php echo $overview[ 'homepage' ]; ?>">Web Site</a> 
                
            <?php endif; ?>
        
        </p>