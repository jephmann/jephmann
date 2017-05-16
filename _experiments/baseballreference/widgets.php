<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
    </head>
    <body>
        <?php
            $mlb =array( 'AL', 'NL' );
            $divs = array( 'E', 'C', 'W');
            for( $i=0; $i<2; $i++ ):
                $league = ($mlb[$i]);
                for( $j=0; $j<3; $j++ ):
                    $division = $divs[$j];
        ?>
        
        <script type="text/javascript"
            src="http://widgets.sports-reference.com/wg.fcgi?script=br_standings&amp;params=br_standings_lg:<?php
            echo $league;
            ?>,br_standings_div:<?php
                echo $division;
            ?>,br_standings_css:1&amp;css=1"></script>
    
        <?php
                endfor;
            endfor;
        ?>
        
            
            
        <script type="text/javascript" src="//widgets.sports-reference.com/wg.fcgi?css=1&site=br&url=%2Fplayers%2Fh%2Fhoytla01.shtml&div=div_pitching_standard"></script>
    </body>
</html>
