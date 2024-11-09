<?php
		
// disable zoom and lightbox functions
function disable_woocommerce_gallery_features() {
    remove_theme_support('wc-product-gallery-zoom'); 
    remove_theme_support('wc-product-gallery-lightbox'); 

}
add_action('after_setup_theme', 'disable_woocommerce_gallery_features', 100);

// Remove SKU and Product Category
remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);

// Remove Product Tags
remove_action('woocommerce_after_single_product_summary','woocommerce_output_product_data_tabs', 10);

// Remove sale badge
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

// disable default WooCommerce gallery
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);



// =============== Single Product Page Start =============== //

// add custom gallery
add_action('woocommerce_before_single_product_summary', 'custom_product_gallery', 20);

function custom_product_gallery() {
    global $product;
    // imgs from gallery
    $attachment_ids = $product->get_gallery_image_ids();
    // thumbnail
    $main_image_id = $product->get_image_id();
    ?>
    
    <div class="custom-slider">
        <div class="slider-wrapper">
            <div class="slider">
                <!-- last img of slider (fake slide) -->
                <div class="slider-image">
                    <?php echo wp_get_attachment_image(end($attachment_ids), 'full'); ?>
                </div>
                
                <!-- main img -->
                <div class="slider-image">
                    <?php echo wp_get_attachment_image($main_image_id, 'full'); ?>
                </div>
    
                <!-- gallery imgs -->
                <?php foreach ($attachment_ids as $attachment_id) : ?>
                    <div class="slider-image">
                        <?php echo wp_get_attachment_image($attachment_id, 'full'); ?>
                    </div>
                <?php endforeach; ?>
    
                <!-- first img of slider (fake slide) -->
                <div class="slider-image">
                    <?php echo wp_get_attachment_image($main_image_id, 'full'); ?>
                </div>
            </div>
            <!-- slide button -->
            <button class="slider-btn prev"><</button>
            <button class="slider-btn next">></button>
        </div>
    
        <!-- thumbnail part -->
        <div class="thumbnail-wrapper">
            <div class="thumbnails">
                <div class="thumbnail"><?php echo wp_get_attachment_image($main_image_id, 'thumbnail'); ?></div>
                <?php foreach ($attachment_ids as $attachment_id) : ?>
                    <div class="thumbnail"><?php echo wp_get_attachment_image($attachment_id, 'thumbnail'); ?></div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

<?php
}
// =============== Single Product Page Start =============== //

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


function single_product_breadcrumb() {
    global $product;
    $homepageLink = get_permalink(66);
    $shopPageLink = get_permalink(8);
    ?>
    <ul class="breadcrumbs">
        <li><a href="<?php echo $homepageLink; ?>"><?php echo esc_html("home"); ?></a></li>
        <p>/</p>
        <li><a href="<?php echo $shopPageLink; ?>"><?php echo esc_html("shop"); ?></a></li>
        
        <?php 
        if (is_product() && isset($GLOBALS['product'])) :
            $product = wc_get_product();
            ?>
            <p>/</p>
            <li><?php echo esc_html($product->get_name()); ?></li>
        <?php endif; ?>
    </ul>
    <?php
}
add_action('woocommerce_single_product_summary', 'single_product_breadcrumb', 4);



// Display Product Dimensions
function display_product_dimensions() {
    global $product;
    if ($product->has_dimensions()) {
        $dimensions = $product->get_dimensions();
        ?>
        <p class="product-dimensions"><?php echo esc_html("Size: " . $dimensions); ?></p>
        <?php
    }
}
add_action('woocommerce_single_product_summary', 'display_product_dimensions', 25);

// add add to cart button
function add_quantity_label_to_single_product() {
?>
    <p class="label-quantity">quantity</p>
    <div class="quantity-control-container">
        <div></div>
        <div class="buttons">
            <button type="button" class="quantity-control-button decrease">-</button>
            <button type="button" class="quantity-control-button increase">+</button>
        </div>
        <div></div>
    </div>
<?php
}
add_action('woocommerce_single_product_summary', 'add_quantity_label_to_single_product', 29);

// For semantic structuring
function add_opening_section_tag_for_add_to_cart() {
    ?>
    <div class="add-to-cart-wrapper">
    <?php
}
add_action('woocommerce_single_product_summary', 'add_opening_section_tag_for_add_to_cart', 25);

// For semantic structuring
function add_closing_section_tag_for_add_to_cart() {
    ?>
    </div>
    <?php
}
add_action('woocommerce_single_product_summary', 'add_closing_section_tag_for_add_to_cart', 31);







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
add_action('woocommerce_after_single_product_summary', 'display_product_description', 11);






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


//  ===== Add JavaScript function ===== //
function add_custom_gallery_js() {
	wp_enqueue_script( 
        'custom-gallery-js', 
        get_template_directory_uri() . '/js/productgallery.js', 
        array(), 
        '1.0.0', 
        array('strategy' => 'defer') 
    );
}
add_action( 'init', 'add_custom_gallery_js' );