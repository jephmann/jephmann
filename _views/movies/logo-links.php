
        <p>
        <a target="_blank"
            title="The Movie Database page for <?php echo $logo_title; ?>"
            href="<?php echo $urlMovieDB; ?>">
            <img alt="" height="33" src="<?php
            echo $path; ?>_images/logos/myew1vd5.bmp" >
        </a>
        <?php if( !empty( $urlIMDB ) ): ?>
        &nbsp;
        <a target="_blank"
            title="Internet Movie Database page for <?php echo $logo_title; ?>"
            href="<?php echo $urlIMDB; ?>">
            <img alt="" height="33" src="<?php
            echo $path; ?>_images/logos/mp7t7ysh.bmp" >
        </a>
        <?php endif; ?>
        </p>