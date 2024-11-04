<?php 
function shop_all_products() { 
    ?>
        <h1>TEST</h1>
    <?php 
}
add_action('woocommerce_before_shop_loop', 'shop_all_products', 11);
