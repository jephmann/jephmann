
        <p>
        <a target="_blank"
            title="The Movie Database page for <?php echo $logo_title; ?>"
            href="<?php echo $overview[ 'urlMovieDB' ]; ?>">
            <img alt="" height="33" src="<?php
            echo $path; ?>_images/logos/myew1vd5.bmp" >
        </a>
        <?php if( !empty( $overview[ 'urlIMDB' ] ) ): ?>
        &nbsp;
        <a target="_blank"
            title="Internet Movie Database page for <?php echo $logo_title; ?>"
            href="<?php echo $overview[ 'urlIMDB' ]; ?>">
            <img alt="" height="33" src="<?php
            echo $path; ?>_images/logos/mp7t7ysh.bmp" >
        </a>
        <?php endif; ?>
        </p>