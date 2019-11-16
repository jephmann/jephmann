<?php
$imdb = array(
    'id'    => $overview[ 'imdb' ],
    'title' => $overview[ 'title' ],
    'date'  => $overview[ 'release_year' ],
);
?>
<span class="imdbRatingPlugin" data-user="ur0826124" data-title="<?php echo $imdb[ 'id' ]; ?>" data-style="p1">
    <a target="_blank"
        title="<?php echo $imdb[ 'title' ]; ?> (<?php echo $imdb[ 'date' ]; ?>) on IMDb"
        data-toggle="tooltip" data-placement="bottom"
        data-original-title="<?php echo $imdb[ 'title' ]; ?> (<?php echo $imdb[ 'date' ]; ?>) on IMDb"
        href="https://www.imdb.com/title/<?php echo $imdb[ 'id' ]; ?>/?ref_=plg_rt_1">
        <img src="https://ia.media-imdb.com/images/G/01/imdb/plugins/rating/images/imdb_46x22.png"
            alt="<?php echo $imdb[ 'title' ]; ?> (<?php echo $imdb[ 'date' ]; ?>) on IMDb" />
    </a>
</span>
<script>
    (function(d,s,id){var js,stags=d.getElementsByTagName(s)[0];if(d.getElementById(id)){return;}js=d.createElement(s);js.id=id;js.src="https://ia.media-imdb.com/images/G/01/imdb/plugins/rating/js/rating.js";stags.parentNode.insertBefore(js,stags);})(document,"script","imdb-rating-api");
</script>