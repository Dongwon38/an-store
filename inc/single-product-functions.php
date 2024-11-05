<?php

// Display Product Dimensions
function display_product_dimensions() {
    global $product;
    if ($product->has_dimensions()) {
        $dimensions = $product->get_dimensions();
        ?>
        <p><?php echo esc_html("Size: " . $dimensions); ?></p>
        <?php
    }
}
add_action('woocommerce_single_product_summary', 'display_product_dimensions', 25);

// Output Product Details (long description) if available
function display_product_description() {
    global $product;
    $productDescription = $product->get_description();
    if (!empty($productDescription)) {
        ?>
        <section class="section-product-more-details">
            <h2><?php echo esc_html("Product Details"); ?></h2>
            <p><?php echo $productDescription; ?></p>
        </section>
        <?php
    }
}
add_action('woocommerce_single_product_summary', 'display_product_description', 31);

// Remove SKU and Product Category
remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);

// Remove Product Tags
remove_action('woocommerce_after_single_product_summary','woocommerce_output_product_data_tabs', 10);

// Output Random Products if there are no other products in the same category
function output_other_products() {
    global $product;
    $productID = $product->get_id();
    $productCategories = get_the_terms($productID, 'product_cat');

    if ( $productCategories && !is_wp_error($productCategories) ) {
        foreach( $productCategories as $category ) {
            if ( $category->count === 1 ) {
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 3,
                    'orderby' => 'rand',
                );
                $query = new WP_Query($args);

                if ( $query->have_posts() ) {
                    ?>
                    <h2><?php echo esc_html("Our Other Products"); ?></h2>
                    <?php
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        wc_get_template_part('content', 'product');
                    }
                }
                wp_reset_postdata();
            }
        }
    }
}
add_action('woocommerce_after_single_product_summary', 'output_other_products', 20);