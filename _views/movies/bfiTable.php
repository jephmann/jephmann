<?php if( count($rowListBFI) ) : ?>
<table class="table table-hover">
    <caption>
        <h4>British Film Institute (BFI)</h4>
    </caption>
    <tbody>
        <?php foreach( $rowListBFI as $rowL ) :
            echo PHP_EOL; ?>
        <tr>
            <td><?php
                echo $rowL[ 'year' ]; 
            ?>
            <br />#<?php
                echo $rowL[ 'rank' ]; 
            ?></td>
            <td><?php
                echo $rowL[ 'listSubType' ]; 
            ?>' <?php
                echo $rowL[ 'listType' ]; 
            ?> Poll
            <br /><a target="_blank" href="<?php
                echo $rowL[ 'urlFull' ]; ?>"><?php
                echo $rowL[ 'title' ]; ?></a>
            </td>
        </tr>
        <?php endforeach;
            echo PHP_EOL; ?>
    </tbody>                    
</table>
<?php endif; ?>