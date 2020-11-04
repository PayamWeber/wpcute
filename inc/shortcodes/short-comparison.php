<?php

add_shortcode( 'comparison', function ( $atts ) {
	$atts = shortcode_atts( array(
		'foo' => 'no foo',
	), $atts, 'comparison' );
	$html = '';

	$products = isset( $_COOKIE['wc_compare_products'] ) ? json_decode( $_COOKIE['wc_compare_products'] ) : '';

	/*if ( $products )
    {
        $main_attributes = wc_get_attribute_taxonomies();
        $html .= "<div class=\"comparison-wrapper\">";
        $html .= "<div class=\"main-attributes\">";
        $html .= "<ul>";
        $html .= "<li>" . __('Image') . "</li>";
        $html .= "<li>" . __('Name') . "</li>";
        if ( $main_attributes )
        {
            foreach ( $main_attributes as $main_attribute )
            {
                $html .= "<li data-attribute-id='$main_attribute->attribute_id'>$main_attribute->attribute_label</li>";
            }
        }
        $html .= "</ul>";
        $html .= "</div>";
        $html .= "<div class=\"product-attributes\">";
        $same = true;
        $product_html = '';
        foreach ( $products as $key => $product )
        {
            $product = wc_get_product( $product );
            $product_li = '';

            if ( $product )
            {
                $product_li .= "<li>" . get_the_post_thumbnail( $product->id, 'medium' ) . "</li>";
                $product_li .= "<li>" . $product->get_name() . "</li>";
                if ( $main_attributes )
                {
                    foreach ( $main_attributes as $i => $main_attribute )
                    {
                        $this_attribute_value = $product->get_attribute( $main_attribute->attribute_name );
                        if ( $i != 0 && $this_attribute_value != $this_attribute_value ){
                            $same = false;
                        }
                        $product_li .= "<li data-attribute-id='$main_attribute->attribute_id'>$this_attribute_value</li>";
                    }
                }
                $product_html .= "<ul class='". ( $same ? 'same-attributes' : '' ) . "'>$product_li";
                $product_html .= "</ul>";
            }
        }
        $html .= "$product_html</div>";
        $html .= "</div>";
    }*/

	$data = array();
    if ( $products )
    {
        $main_attributes = wc_get_attribute_taxonomies();
        $data['image'][0] = __('Image');
        $data['name'][0] = __('Name');
        if ( $main_attributes )
        {
            foreach ( $main_attributes as $main_attribute )
            {
                $data[$main_attribute->attribute_name][0] = $main_attribute->attribute_label;
            }
        }
        foreach ( $products as $key => $product )
        {
            $product = wc_get_product( $product );

            if ( $product )
            {
                $data['image'][$key+1] = get_the_post_thumbnail( $product->ID, 'medium' );
                $data['name'][$key+1] = $product->get_name();
                if ( $main_attributes )
                {
                    foreach ( $main_attributes as $i => $main_attribute )
                    {
                        $data[$main_attribute->attribute_name][$key+1] = $product->get_attribute( $main_attribute->attribute_name );
                    }
                }
            }
        }
    }

    if ( $data && isset( $data['name'][1] ) )
    {
        $row = '';
        $html .= "<table class='table comparison-table'>";
        foreach ( $data as $datum )
        {
            if ( $datum )
            {
                $column = '';
                $same = true;
                foreach ( $datum as $key => $item )
                {
                    if ( $key > 1 && $datum[$key-1] != $item )
                        $same = false;
                    $column .= "<td>$item</td>";
                }
                $row .= "<tr class='" . ( $same ? 'same' : 'not-same' ) . "'>$column</tr>";
            }
        }
        $html .= "$row</table>";
    }

	return $html;
} );