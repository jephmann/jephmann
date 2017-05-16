<?php
    $dsn = "mysql:"
        . "host=localhost;"
        . "dbname=jephmann2016;"
        . "charset=utf8";
    $pdo = new PDO($dsn, 'root', '');

    // create options for select
    $select_products = "SELECT *"
            . " FROM test_products"
            . " ORDER BY test_products.product_name";
    // stmt
    $products = $pdo->query($select_products);
    $options = '';
    while($product = $products->fetch())
    {
        $options .= "<option value=\"{$product['product_id']}\">"
        . "{$product['product_name']}"
        . "</option>";
    }
    
    $results = '';
    if( isset( $_POST[ 'submit' ] ) )
    {
        $id_product = (int) $_POST[ 'products' ];
        
        $select_categories = "select *"
            . " from test_products"
            . " inner join test_categories"
            . " on test_products.cat_id = test_categories.cat_id"
            . " where test_products.product_id = {$id_product}";
        $categories = $pdo->query($select_categories);
        $category = $categories->fetch();
        $product = $category['product_name'];
        $product_category = $category[ 'cat_name' ];
        $id_category = (int) $category['cat_id'];
        $results = "{$product_category} > {$product}";
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
    </head>
    <body>
        <form method="post">
            <select name="products">
                <?php echo $options; ?>
            </select>
            <button type="submit" name="submit">Submit</button>
        </form>
        <p><?php echo $results; ?></p>
    </body>
</html>
