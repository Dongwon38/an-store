<?php

// functions.php 파일에 추가
function custom_nav_cart_button($items, $args) {
    // 네비게이션 메뉴의 특정 위치에서만 카트 버튼 추가
    if ($args->theme_location === 'primary_menu') {
        // 카트에 담긴 아이템 개수
        $cart_count = WC()->cart->get_cart_contents_count();
        
        // 카트 링크 URL
        $cart_url = wc_get_cart_url();
        
        // 기본 카트 아이콘 HTML (아이콘을 SVG 또는 FontAwesome으로 구현할 수 있음)
        $cart_icon = '<svg width="24" height="24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M..."/></svg>';
        
        // 카트 버튼에 빨간색 점 추가 여부 확인
        $cart_button = '<li class="menu-item cart-link">';
        $cart_button .= '<a href="' . esc_url($cart_url) . '" class="cart-button">';
        $cart_button .= $cart_icon;

        // 아이템이 있을 경우 빨간색 점 추가
        if ($cart_count > 0) {
            $cart_button .= '<span class="cart-badge">' . $cart_count . '</span>';
        }

        $cart_button .= '</a></li>';
        
        // 기존 메뉴 아이템에 카트 버튼 추가
        $items .= $cart_button;
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'custom_nav_cart_button', 10, 2);
