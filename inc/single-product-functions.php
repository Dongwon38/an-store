<?php

// For semantic structuring
function add_opening_section_tag_for_product_details() {
    ?>
    <div class="product-main-details">
    <?php
}
add_action('woocommerce_single_product_summary', 'add_opening_section_tag_for_product_details', 4);

// For semantic structuring
function add_closing_section_tag_for_product_details() {
    ?>
    </div>
    <?php
}
add_action('woocommerce_single_product_summary', 'add_closing_section_tag_for_product_details', 31);

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
                    'posts_per_page' => 4,
                    'orderby' => 'rand',
                );
                $query = new WP_Query($args);

                if ( $query->have_posts() ) {
                    ?>
                    <section class="section-other-products">
                        <h2><?php echo esc_html("Our Other Products"); ?></h2>
                        <?php
                        while ( $query->have_posts() ) {
                            $query->the_post();
                            wc_get_template_part('content', 'product');
                        }
                    ?>
                    </section>
                    <?php
                }
                wp_reset_postdata();
            }
        }
    }
}
add_action('woocommerce_after_single_product_summary', 'output_other_products', 20);


// Displays 4 related products instead of 3
function woocommerce_related_products_custom_args( $args ) {
	$defaults = array(
		'posts_per_page' => 4,
		'columns'        => 4,
	);

	$args = wp_parse_args( $defaults, $args );
	return $args;
}

add_action('woocommerce_output_related_products_args','woocommerce_related_products_custom_args');