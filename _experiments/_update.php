<?php

// UPDATE

$new_tt = id_imdb('tt0065988')['number'];
$new_nm = id_imdb('nm0000163')['number'];
$new_r  = "Jack Crabb";

$changes = array();
$changes[ 'imdb_tt' ]   = $new_tt;
$changes[ 'imdb_nm' ]   = $new_nm;
$changes[ 'role' ]      = $new_r;

$fieldsChange = array();
foreach( $changes as $keyChange => $valueChange )
{
    $fieldsChange[] = $keyChange;
}
$change_role = $objDB->update( $table, $fieldsChange );
$update_role = $movies->prepare( $change_role );
$update_role->bindParam( ":id", $newId );
foreach( $changes as $keyChange => &$valueChange )
{
    $update_role->bindParam( ":{$keyChange}", $valueChange );
}
$update_role->bindParam( ":id", $newId );
$update_role->execute();

echo "<p>Record #{$newId} updated!</p>";

echo '<h3>Updated Roles</h3><ul>';

$roles2  = $movies->query( $objDB->readAll( $table ) );
foreach( $roles2 as $role )
{
    echo '<li>' . $role[ 'id' ]
        . '</li><li>' . $role[ 'imdb_tt' ]
        . '</li><li>' . $role[ 'imdb_nm' ]
        . '</li><li>' . $role[ 'role' ]
        . '</li>';
}
echo '</ul><hr />';