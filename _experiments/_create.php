<?php

// CREATE/INSERT

$tt = id_imdb('tt0101889')['number'];
$nm = id_imdb('nm0000245')['number'];
$r  = "Parry";

$newvalues = array();
$newvalues[ 'imdb_tt' ]  = $tt;
$newvalues[ 'imdb_nm' ]  = $nm;
$newvalues[ 'role' ]     = $r;

$fieldsNew = array();
foreach( $newvalues as $keyNew => $valueNew )
{
    $fieldsNew[] = $keyNew;
}
$insert_role = $objDB->create( $table, $fieldsNew );
$create_role = $movies->prepare( $insert_role );
foreach( $newvalues as $keyNew => &$valueNew )
{
    $create_role->bindParam( ":{$keyNew}", $valueNew );
    next($newvalues);
}
$create_role->execute();

$newId = $movies->lastInsertId();
echo "<p>Record #{$newId} added!</p>";

$newRoles  = $movies->query( $objDB->readAll( $table ) );
echo '<h3>New Roles</h3><ul>';
foreach( $newRoles as $role )
{
    echo '<li>' . $role[ 'id' ]
        . '</li><li>' . $role[ 'imdb_tt' ]
        . '</li><li>' . $role[ 'imdb_nm' ]
        . '</li><li>' . $role[ 'role' ]
        . '</li>';
}
echo '</ul><hr />';