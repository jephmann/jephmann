<h3>
    <?php echo "{$overview[ 'name' ]} {$overview[ 'born_died' ]}"; ?>
</h3>
<ul><?php
    echo $overview[ 'aka' ];
    echo $overview[ 'birthplace' ];
    echo $overview[ 'birthday' ];
    echo $overview[ 'deathday' ];
?></ul>
<?php
    $logo_title = $name_name;
    //require_once $views_movies . 'logo-links.php';
    require_once $views_movies . 'movie-links.php';
?>
<div>
    <p><?php echo $overview[ 'text' ]; ?></p>
</div>

<?php
    //require_once $test . 'name.php';