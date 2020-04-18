<?php if( count($rowLifeAFI) or count($rowTopAFI) ) : ?>
<h4>American Film Institute (AFI)</h4>                
<table class="table table-hover">
    <tbody>
        <?php
            foreach( $rowLifeAFI as $rowAL ) :
            echo PHP_EOL;
        ?>
        <tr>
            <td>
                <a target="_blank" href="<?php
                echo $rowAL['url']
                ?>">AFI <?php
                echo $rowAL['year'];
                ?> Life Achievement Award</a>
            </td>
        </tr>
        <?php
            endforeach;
            echo PHP_EOL;
            
            foreach( $rowTopAFI as $rowL ) :
            echo PHP_EOL;
        ?>
        <tr>
            <td><?php
                echo $rowL[ 'listType' ]; ?>: <?php
                echo $rowL[ 'title' ]; ?>
                (<?php echo $rowL[ 'year' ]; ?>) <?php
                echo PHP_EOL; ?><br />#<?php
                echo $rowL[ 'rank' ];
                ?> of <a target="_blank" href="<?php
                echo $rowL[ 'urlFull' ]; ?>"><?php
                echo $rowL[ 'subtitle' ]; ?></a><?php 
                if( $rowL[ 'text' ] ):
                echo PHP_EOL; ?><br /><?php
                echo '&ldquo;' . $rowL[ 'text' ] . '&rdquo;';
                endif;
                echo PHP_EOL;
                ?>
            </td>
        </tr>
        <?php
            endforeach;
            echo PHP_EOL;
        ?>
    </tbody>                    
</table>
<?php endif; ?>