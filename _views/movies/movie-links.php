
        <h4>Additional information:</h4>
        
        <ul style="font-size: 1em;">
        <?php    
            $infoLinks = array();
            $infoLinks[ 'The Movie Database (TMDB)' ]              = $overview[ 'urlMovieDB' ];
            $infoLinks[ 'Internet Movie Database (IMDB)' ]         = $overview[ 'urlIMDB' ];
            $infoLinks[ 'American Film Institute (AFI)' ]   = $overview[ 'urlAFI' ];
            $infoLinks[ 'British Film Institute (BFI)' ]    = $overview[ 'urlBFI' ];
            $infoLinks[ 'Wikipedia' ]                       = $overview[ 'urlWikipedia' ];
            $infoLinks[ 'Home' ]                            = $overview[ 'homepage' ];
            
            foreach( $infoLinks as $infoTopic => $infoLink ):
                if( !empty( $infoLink ) ):
            ?>
            <li>
                <a target="_blank"
                    title="<?php echo $infoTopic; ?> page for <?php echo $logo_title; ?>"
                    data-toggle="tooltip"
                    data-placement="top"
                    data-original-title="<?php echo $infoTopic; ?> page for <?php echo $logo_title; ?>"
                    data-animation="false"
                    href="<?php echo $infoLink ?>"><?php echo $infoTopic; ?></a>
            </li>            
            <?php 
                endif;
            endforeach;
        ?>
        </ul>