<?php
    /*
     * Across-the-board server-side code
     */
    
    // URL
    $server_http_host   = (string) $_SERVER['HTTP_HOST'];
    $server_request_uri = (string) parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
    $server_url         = $server_http_host . $server_request_uri;
     
    // Dates    
    $date           = new DateTime;
    $thisMonthYear  = $date->format('F Y');
    $thisYear       = $date->format('Y');
    
    // Social Meta
    $meta = array(
        'title'         => 'Jeffrey Hartmann | ' . $subtitle,
        'description'   => $meta_description
            . 'Jeffrey Hartmann\'s personal workshop and demo project',
        'image'         => $meta_image,
        'canonical'     => "http://{$server_url}{$meta_querystring}",
    );
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="<?php echo $path ?>_images/favicon1.ico" type="image/x-icon">
        <!-- Default -->
        <link rel="canonical"
              href="<?php echo $meta['canonical']; ?>" />
        <meta name="description"
              content="<?php echo $meta['description']; ?>">
        <meta name="author"
              content="Jeffrey Hartmann">
        <!-- Twitter --> 
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title"
              content="<?php echo $meta['title']; ?>">
        <meta name="twitter:description"
              content="<?php echo $meta['description']; ?>">
        <meta name="twitter:image"
              content="<?php echo $meta['image']; ?>">
        <!-- Facebook / Open Graph -->
        <meta property="og:title"
              content="<?php echo $meta['title']; ?>">
        <meta property="og:description"
              content="<?php echo $meta['description']; ?>">
        <meta property="og:image"
              content="<?php echo $meta['image']; ?>">
        <meta property="og:image:height" content="300" />
        <meta property="og:url"
              content="<?php echo $meta['canonical']; ?>">
               
        <title><?php echo $meta['title']; ?></title>
        <!-- bootswatch.com "slate" version of bootstrap -->
        <link rel="stylesheet" href="<?php echo $path ?>_css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo $path ?>_css/jephmann.css">
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <![endif]-->
    </head>
    <body>