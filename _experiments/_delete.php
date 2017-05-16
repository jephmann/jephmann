<?php

//DELETE
$remove_role = $objDB->delete( $table );
$delete_role = $movies->prepare( $remove_role );
$delete_role->bindParam( ":id", $newId );
$delete_role->execute();

echo "<p>Record #{$newId} deleted!</p>";

echo '<h3>Deleted Roles</h3><ul>';

$roles3  = $movies->query( $objDB->readAll( $table ) );
foreach( $roles3 as $role )
{
    echo '<li>' . $role[ 'id' ]
        . '</li><li>' . $role[ 'imdb_tt' ]
        . '</li><li>' . $role[ 'imdb_nm' ]
        . '</li><li>' . $role[ 'role' ]
        . '</li>';
}
echo '</ul><hr />';