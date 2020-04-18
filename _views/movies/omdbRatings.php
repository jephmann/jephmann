<?php
    if ( $omdb_awards or array_key_exists( 'Ratings', $omdb ) ) :
    
        if ( $overview[ 'imdb' ] )
            require_once $path . '_plugins/imdb/ratings.php';
        
        if( array_key_exists( 'Ratings', $omdb ) ):
            ?><h4>Rankings and Honors</h4>
                <table class="table table-hover"><?php
                foreach ( $omdb[ 'Ratings'] as $rating ) :
                    ?><tr class="table-primary">
                        <th scope="row"><?php echo $rating['Source']; ?></th>
                        <td><?php echo $rating['Value']; ?></td>
                    </tr><?php
                endforeach;
                if( $omdb_awards ):
                    ?><tr class="table-primary">
                        <th scope="row">Awards Won:</th>
                        <td><?php echo $omdb_awards; ?></td>
                    </tr><?php
                endif;
            ?></table><?php
        endif;

    endif;