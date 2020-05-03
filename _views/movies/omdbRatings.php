<?php
    if ( $omdb_awards or array_key_exists( 'Ratings', $omdb ) ) :
        
        if( array_key_exists( 'Ratings', $omdb ) ):
            ?><table class="table table-hover">
                <caption>
                    <h4>Rankings and Honors</h4><?php
                    if ( $overview[ 'imdb' ] )
                        require_once $path . '_plugins/imdb/ratings.php';
                ?></caption><?php
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
                ?><tr><td colspan="2" style="text-align: right;"></td></tr>
            </table><?php
        endif;

    endif;