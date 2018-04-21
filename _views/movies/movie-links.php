
        <p>
            <a target="_blank"
                title="The Movie Database page for <?php echo $logo_title; ?>"
                href="<?php echo $overview[ 'urlMovieDB' ]; ?>">TMDb</a>
            
            <?php if( !empty( $overview[ 'urlIMDB' ] ) ): ?>
            
            &nbsp;|&nbsp;            
            <a target="_blank"
                title="Internet Movie Database page for <?php echo $logo_title; ?>"
                href="<?php echo $overview[ 'urlIMDB' ]; ?>">IMDb</a> 
                
            <?php endif; ?>
        
        </p>