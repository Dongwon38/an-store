<?php 
// sub navigation by category 
function shop_all_products() { 
    $product_categories = get_terms( array( 'taxonomy' => 'product_cat' ) );

    if ( !empty( $product_categories ) && !is_wp_error( $product_categories ) ) { ?>
        <nav class="sub-navigation">
            <ul>
                <li><button class="sub-category" value="all">All</button></li>
                <?php foreach ( $product_categories as $category ) :
                    $category_slug = $category->slug; 
                    $category_name = $category->name; ?>
                    <?php if ( $category_name != 'Uncategorized') : ?>
                        <li><button class="sub-category" value="<?php echo esc_html( $category_slug ) ?>"><?php echo esc_html( $category_name ) ?></button></li>
                    <?php endif;    
                endforeach; ?>
            </ul>
        </nav>
    <?php }
} 

add_action('woocommerce_before_shop_loop', 'shop_all_products', 11);

// show all product
function show_all_products( $products_per_page ) {
    return -1; 
}
add_filter( 'loop_shop_per_page', 'show_all_products', 10 );

// remove result count
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_after_shop_loop', 'woocommerce_result_count', 20);

// remove default sorting
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

// remove sale badge
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );


//  ===== Add JavaScript function ===== //
function shop_sub_navigation() {
	wp_enqueue_script( 
        'sub-navigation', 
        get_template_directory_uri() . '/js/subnavigation.js', 
        array(), 
        '1.0.0', 
        array('strategy' => 'defer') 
    );
}
add_action( 'init', 'shop_sub_navigation' );