<?php

/* 
 * https://www.sitepoint.com/re-introducing-pdo-the-right-way-to-access-databases-in-php/
 * http://php.net/manual/en/pdo.prepared-statements.php
 */

require_once '../_php/autoload.php';

function id_imdb( $id )        
{
    return array(
        'type'      => (string) substr( $id, 0, 2 ),
        'number'    => (string) substr( $id, 2 )
    );
}

/*
echo mb_strlen($tt);
echo '<br />';
echo mb_strlen($nm);
echo '<br />';
 */

// $movies instead of $connection
// $roles instead of $statement

$objDB  = new Database();
$movies = $objDB->connect();

$table          = 'movies_roles';

// clear the table
$movies->query( $objDB->clearTable( $table ) );

require_once '_create.php';

require_once '_update.php';

require_once '_delete.php';
