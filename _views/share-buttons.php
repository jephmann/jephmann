<?php
    $shared_url             = (string) $meta['canonical'];
    $encode_shared_url      = (string) urlencode( $shared_url );
    $shared_title           = (string) $meta['title'];
    $encode_shared_title    = (string) urlencode( $shared_title );
    $simplesharebuttons     = 'https://simplesharebuttons.com/images/somacro/';

    $shareButtons = array(
        /* "Bad value for attribute href"
        array(
            'toggle'    => TRUE,
            'target'    => TRUE,
            'onclick'   => '',
            'href'      => "https://bufferapp.com/add?url={$encode_shared_url}&amp;text={$shared_title},jph",
            'src'       => 'buffer',
            'alt'       => 'Buffer',
        ),
         */
        array(
            'toggle'    => TRUE,
            'target'    => TRUE,
            'onclick'   => '',
            'href'      => "http://www.digg.com/submit?url={$encode_shared_url}",
            'src'       => 'diggit',
            'alt'       => 'Digg',
        ),
        array(
            'toggle'    => TRUE,
            'target'    => TRUE,
            'onclick'   => '',
            'href'      => "http://www.facebook.com/sharer.php?u={$encode_shared_url}",
            'src'       => 'facebook',
            'alt'       => 'Facebook',
        ),
        /*
        array(
            'toggle'    => TRUE,
            'target'    => TRUE,
            'onclick'   => '',
            'href'      => "https://plus.google.com/share?url={$encode_shared_url}",
            'src'       => 'google',
            'alt'       => 'Google+',
        ),
        */
        array(
            'toggle'    => TRUE,
            'target'    => TRUE,
            'onclick'   => '',
            'href'      => "http://www.linkedin.com/shareArticle?mini=true&amp;url={$encode_shared_url}",
            'src'       => 'linkedin',
            'alt'       => 'LinkedIn',
        ),
        array(
            'toggle'    => TRUE,
            'target'    => FALSE,
            'onclick'   => '',
            'href'      => "javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());",
            'src'       => 'pinterest',
            'alt'       => 'Pinterest',
        ),
        /* "Bad value for attribute href"
        array(
            'toggle'    => TRUE,
            'target'    => TRUE,
            'onclick'   => '',
            'href'      => "http://reddit.com/submit?url={$encode_shared_url}&amp;title={$shared_title}",
            'src'       => 'reddit',
            'alt'       => 'Reddit',
        ),
        */
        /* "Bad value for attribute href"
        array(
            'toggle'    => TRUE,
            'target'    => TRUE,
            'onclick'   => '',
            'href'      => "http://www.stumbleupon.com/submit?url={$encode_shared_url}&amp;title={$shared_title}",
            'src'       => 'stumbleupon',
            'alt'       => 'StumbleUpon',
        ),
        */
        /* "Bad value for attribute href"
        array(
            'toggle'    => TRUE,
            'target'    => TRUE,
            'onclick'   => '',
            'href'      => "http://www.tumblr.com/share/link?url={$encode_shared_url}&amp;title={$shared_title}",
            'src'       => 'tumblr',
            'alt'       => 'Tumblr',
        ),
        */
        array(
            'toggle'    => TRUE,
            'target'    => TRUE,
            'onclick'   => '',
            'href'      => "https://twitter.com/share?url={$encode_shared_url}&amp;text={$encode_shared_title}&amp;hashtags={$hashtag}",
            'src'       => 'twitter',
            'alt'       => 'Twitter',
        ),
        array(
            'toggle'    => FALSE,
            'target'    => TRUE,
            'onclick'   => '',
            'href'      => "http://vkontakte.ru/share.php?url={$encode_shared_url}",
            'src'       => 'vk',
            'alt'       => 'VK',
        ),
        /* "Bad value for attribute href"
        array(
            'toggle'    => TRUE,
            'target'    => TRUE,
            'onclick'   => '',
            'href'      => "http://www.yummly.com/urb/verify?url={$encode_shared_url}&amp;title={$shared_title}",
            'src'       => 'yummly',
            'alt'       => 'Yummly',
        ),
        */
        array(
            'toggle'    => FALSE,
            'target'    => FALSE,
            'onclick'   => '',
            'href'      => "mailto:?Subject={$shared_title}&amp;Body={$encode_shared_title} {$shared_url}",
            'src'       => 'email',
            'alt'       => 'Email',
        ),
        array(
            'toggle'    => FALSE,
            'target'    => FALSE,
            'onclick'   => 'window.print()',
            'href'      => "javascript:;",
            'src'       => 'print',
            'alt'       => 'Print',
        ),
    );
?>
<!-- I got these buttons from simplesharebuttons.com -->
<div id="share-buttons">
    <p style="font-size: small;">Sharing:</p>
    <?php
        foreach ($shareButtons as $sButton):
            $sb_toggle = (boolean) $sButton['toggle'];
            $sb_target = (boolean) $sButton['target'];
            $sb_onclick = (string) $sButton['onclick'];
            $sb_href = (string) $sButton['href'];
            $sb_src = $simplesharebuttons . (string) $sButton['src'];
            $sb_alt = (string) $sButton['alt'];
            $sb_title = $sb_alt;
            if ($sb_toggle === TRUE) :
                $shareTarget = $sb_target
                    ? ' target="_blank"' 
                    : '';
                $shareOnClick = $sb_onclick
                    ? " onclick=\"{$sb_onclick}\"" 
                    : $sb_onclick;
    ?>
    
    <!-- <?php echo $sb_alt; ?> -->
    <a href="<?php echo $sb_href ?>"<?php echo $shareTarget.$shareOnClick; ?>>
        <img src="<?php
            echo $sb_src; ?>.png" alt="<?php
            echo $sb_alt; ?>" title="Share: <?php
            echo $sb_alt; ?>" />
    </a>
    <?php
            endif;
        endforeach;
    ?>

</div>