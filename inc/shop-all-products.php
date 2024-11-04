<?php 
function shop_all_products() { 
    $product_categories = get_terms( array( 'taxonomy' => 'product_cat' ) );

    if ( !empty( $product_categories ) && !is_wp_error( $product_categories ) ) { ?>
        <nav class="sub-navigation">
            <ul>
                <?php foreach ( $product_categories as $category ) :
                        $category_link = get_term_link( $category ); 
                        $category_name = $category->name; ?>
                    <li><a href="<?php echo esc_url( $category_link ) ?>"><?php echo esc_html( $category_name ) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
    <?php }
} 

add_action('woocommerce_before_shop_loop', 'shop_all_products', 11);
