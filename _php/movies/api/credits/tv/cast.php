<?php

$credits_cast                   = (array) $credits[ 'cast' ];
$ct_credits_cast                = (int) count( $credits_cast );
$performance_credits = '<p><em>No performance credits in the system.</em></p>';
if( $ct_credits_cast > 0 )
{
    $performance_credits = '';
    foreach( $credits_cast as $cast )
    {
        $cast_id        = (string) $cast[ 'id' ];
        $cast_name      = (string) $cast[ 'name' ];
        $cast_character = (string) $cast[ 'character' ];
        $performance_credits .= "<p>"
            . "<strong>"
            . "<a href=\"name.php?id={$cast_id}\">{$cast_name}</a>"
            . "</strong>"
            . "<br /><strong>{$cast_character}</strong>"
            . "</p>";
    }        
}