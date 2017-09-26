<?php

    $credits_crew                   = (array) $credits[ 'crew' ];
    $ct_credits_crew                = (int) count( $credits_crew );
    $production_credits = '<p><em>No production credits in the system.</em></p>';
    if( $ct_credits_crew > 0 )
    {
        $production_credits = '';
        $jobs           = array();
        foreach( $credits_crew as $crew)
        {
            $jobs[]     = $crew['job'];
        }
        sort( $jobs );
        $crew_jobs = array_unique( $jobs );        
        foreach( $crew_jobs as $key => $value )
        {
            $production_credits .= "<p><strong>{$value}:</strong>";
            foreach( $credits_crew as $crew )
            {
                if( $crew['job'] === $value )
                {
                    $crew_id            = (string) $crew[ 'id' ];
                    $crew_name          = (string) $crew[ 'name' ];    
                    $production_credits .= "<br />"
                    . "<strong>"
                    . "<a href=\"name.php?id={$crew_id}\">{$crew_name}</a>"
                    . "</strong>";
                }
            }
            $production_credits .= "</p>";
        }
    }