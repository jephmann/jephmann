
        <p style="font-size: 1em;">
            
            <strong>See also:</strong><br />
            
            <a target="_blank"
                title="The Movie Database page for <?php echo $logo_title; ?>"
                href="<?php echo $overview[ 'urlMovieDB' ]; ?>">TMDb</a>
            
            <?php if( !empty( $overview[ 'urlIMDB' ] ) ): ?>
            
            &nbsp;|&nbsp;            
            <a target="_blank"
                title="Internet Movie Database page for <?php echo $logo_title; ?>"
                href="<?php echo $overview[ 'urlIMDB' ]; ?>">IMDb</a> 
                
            <?php endif; ?>
            
            <?php if( !empty( $overview[ 'homepage' ] ) ): ?>
            
            &nbsp;|&nbsp;            
            <a target="_blank"
                title="Home page for <?php echo $logo_title; ?>"
                href="<?php echo $overview[ 'homepage' ]; ?>">Web Site</a> 
                
            <?php endif; ?>
        
        </p>