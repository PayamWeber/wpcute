<?php

namespace PMW\Inc\Base\Controller;

use PMW\AttributeTaxonomy;
use PMW\Inc\Vendor\View;
use PMW\Inc\Vendor\Controller;
use PMW\Input;
use PMW\Product;
use WP_Query;

class ProductController extends Controller
{
	public $data = [];

	public $posts = [];

	public $featred_posts = [];

	public $filters_used = [];

	public $advanced_search_fields = [];

	public $sort_orders = [
		'asc' => 'صعودی',
		'desc' => 'نزولی',
	];

	/**
	 * Filter the result
	 *
	 * @return bool
	 */
	public function filter()
	{
		$query_args         = [
			'posts_per_page' => get_field( 'shop_posts_per_page', 'option' ) ? : 10,
			'paged' => Input::get( 'page_number', 1 ),
			'post_type' => 'product',
			'post_status' => 'publish',
			'orderby' => 'date',
			'order' => 'desc',
			'tax_query' => [
				'relation' => 'AND',
			],
		];
		$data               = Input::all();
		$allowed_attributes = $this->get_allowed_attributes();

		if ( is_tax( 'product_cat' ) )
		{
			$query_args[ 'tax_query' ][] = [
				'taxonomy' => 'product_cat',
				'field' => 'id',
				'terms' => get_queried_object_id(),
			];
		}

		if ( isset( $data[ '_sort' ] ) && $data[ '_sort' ] )
		{
			$done = false;
			if ( $data[ '_sort' ] == 'price' )
			{
				$query_args[ 'orderby' ]  = 'meta_value_num';
				$query_args[ 'meta_key' ] = '_price';
				$done                     = true;
			} else if ( $data[ '_sort' ] == 'featured' )
			{
				$query_args[ 'orderby' ]  = 'meta_value_num';
				$query_args[ 'meta_key' ] = '_sale_price';
				$done                     = true;
			} else if ( $data[ '_sort' ] == 'date' )
			{
				$query_args[ 'orderby' ] = 'date';
				$done                    = true;
			}
			if ( $done )
			{
				$this->filters_used[ '_sort' ] = [
					'title' => 'ترتیب',
					'value' => $data[ '_sort' ],
				];
			}
		}

		if ( isset( $data[ '_sort_order' ] ) && $data[ '_sort_order' ] )
		{
			$query_args[ 'order' ]               = $data[ '_sort_order' ];
			$this->filters_used[ '_sort_order' ] = [
				'title' => $this->sort_orders[ $data[ '_sort_order' ] ] ?? 'نزولی',
				'value' => $data[ '_sort_order' ],
			];
		}

		if ( $data )
		{
			foreach ( $data as $key => $value )
			{
				$tax_name = '';
				if ( $key == '_color' && $value )
				{
					$tax_name = 'product_color';
				} else if ( $key == '_energy' && $value )
				{
					$tax_name = 'energy_usage';
				} else if ( in_array( $key, $allowed_attributes ) )
				{
					$tax_name = 'pa_' . $key;
				}

				if ( $tax_name )
				{
					$query_args[ 'tax_query' ][] = [
						'taxonomy' => $tax_name,
						'field' => 'id',
						'terms' => $value,
					];
					$this->filters_used[ $key ]  = [
						'title' => $this->advanced_search_fields[ $key ][ 'title' ],
						'value' => $value,
					];
				}
			}
		}

		$this->posts = new WP_Query( $query_args );
		return true;
	}

	/**
	 * Filter the result
	 *
	 * @return bool
	 */
	public function featured_filter()
	{
		$query_args = [
			'meta_query' => [
				[
					'key' => 'is_featured',
					'compare' => '!=',
					'value' => '0',
				],
			],
			'orderby' => 'date',
			'order' => 'desc',
			'tax_query' => [
				'relation' => 'AND',
			],
		];

		if ( is_tax( 'product_cat' ) )
		{
			$query_args[ 'tax_query' ][] = [
				'taxonomy' => 'product_cat',
				'field' => 'id',
				'terms' => get_queried_object_id(),
			];
		}

		$this->featred_posts = Product::query( $query_args );
		return true;
	}

	/**
	 * Shop index page method
	 *
	 * @return mixed
	 */
	public function index()
	{
		$this->advanced_search_fields = $this->get_advanced_filters();
		$this->filter();
		$this->featured_filter();
		$energy_usages = [];

		if ( $this->posts )
		{
			foreach ( $this->posts->posts as $post )
			{
				$usage = wp_get_post_terms( $post->ID, 'energy_usage' );
				$usage = $usage ? $usage[ 0 ] : false;

				$energy_usages[ $post->ID ] = $usage ? : false;
			}
		}
		$this->data[ 'products' ]               = $this->posts;
		$this->data[ 'featured_products' ]      = $this->featred_posts;
		$this->data[ 'sort_order_options' ]     = $this->sort_orders;
		$this->data[ 'energy_usages' ]          = $energy_usages;
		$this->data[ 'filters_used' ]           = $this->filters_used;
		$this->data[ 'advanced_search_fields' ] = $this->advanced_search_fields;
		$this->data[ 'shop_id' ]                = wc_get_page_id( 'shop' );
		$this->data[ 'slider_images' ]          = get_field( 'slider_images', $this->data[ 'shop_id' ] );
		parse_str( $_SERVER[ 'QUERY_STRING' ], $this->data[ 'query_args' ] );

		if ( is_tax( 'product_cat' ) )
			$this->data[ 'shop_url' ] = get_term_link( get_queried_object_id(), 'product_cat' );
		else
			$this->data[ 'shop_url' ] = get_permalink( $this->data[ 'shop_id' ] );

		$this->data[ 'sort_options' ] = [
			[
				'title' => 'جدید ترین',
				'url' => add_query_to_url( $this->data[ 'shop_url' ], [ '_sort' => 'date', '_sort_order' => 'desc' ] ),
				'value' => 'date',
				'order' => 'desc',
			],
			[
				'title' => 'قدیمی ترین',
				'url' => add_query_to_url( $this->data[ 'shop_url' ], [ '_sort' => 'date', '_sort_order' => 'asc' ] ),
				'value' => 'date',
				'order' => 'asc',
			],
			[
				'title' => 'پیشنهاد ویژه',
				'url' => add_query_to_url( $this->data[ 'shop_url' ], [ '_sort' => 'featured', '_sort_order' => 'desc' ] ),
				'value' => 'featured',
				'order' => 'desc',
			],
		];

		return View::get( 'shop.index', 'master', $this->data );
	}

	/**
	 * Api for search results
	 *
	 * @return array
	 */
	public function apiSearch()
	{
		$search = Input::get( 'search' );

		if ( $search )
		{
			$products = Product::query( [
				's' => $search,
				'posts_per_page' => 30,
			] );

			if ( $products )
			{
				foreach ( $products as $key => $product )
				{
					$products[ $key ] = [
						'img' => get_the_post_thumbnail_url( $product->get_id() ),
						'alt' => '',
						'title' => $product->get_name(),
						'desc' => strip_tags( $product->get_short_description() ),
						'link' => $product->get_permalink(),
					];
				}
			}

			return [
				'is_success' => true,
				'data' => $products,
			];
		} else
		{
			return [
				'is_success' => false,
				'data' => [],
			];
		}
	}

	/**
	 * Product show method
	 *
	 * @return mixed
	 */
	public function show()
	{
		return View::get( 'elementor', 'master', $this->data );
	}

	/**
	 * Get advanced search fields
	 *
	 * @return array
	 */
	public function get_advanced_filters()
	{
		$attributes = AttributeTaxonomy::where( 'show_in_as', '1' );
		$final      = [];

		if ( is_tax( 'product_cat' ) )
		{
			$attributes->where( function ( $query ) {
				$query->where( 'attribute_category', get_queried_object_id() );
				$query->orWhere( 'attribute_category', '0' );
			} );
		}

		/**
		 * attributes
		 */
		$attributes = $attributes->get();

		if ( $attributes )
		{
			foreach ( $attributes as $attr )
			{
				$terms                          = get_terms( [
					'taxonomy' => 'pa_' . $attr->attribute_name,
				] );
				$final[ $attr->attribute_name ] = [
					'title' => $attr->attribute_label,
					'data' => $terms,
				];
			}
		}

		/**
		 * colors
		 */
		if ( ! is_tax( 'product_cat' ) || ( is_tax( 'product_cat' ) && ! get_term_meta( get_queried_object_id(), 'dont_show_color', true ) ) )
		{
			$colors            = get_terms( [
				'taxonomy' => 'product_color',
			] );
			$final[ '_color' ] = [
				'title' => 'رنگ',
				'data' => $colors,
			];
		}

		/**
		 * energies
		 */
		if ( ! is_tax( 'product_cat' ) || ( is_tax( 'product_cat' ) && ! get_term_meta( get_queried_object_id(), 'dont_show_energy', true ) ) )
		{
			$energies           = get_terms( [
				'taxonomy' => 'energy_usage',
			] );
			$final[ '_energy' ] = [
				'title' => 'میزان مصرف انرژی',
				'data' => $energies,
			];
		}

		/**
		 * return final search fields
		 */
		return $final;
	}

	/**
	 * Get Allowed Attributes for products
	 *
	 * @return array
	 */
	public function get_allowed_attributes()
	{
		$allowed_attributes = AttributeTaxonomy::select( 'attribute_id, attribute_name' )->get();
		$final_output       = [];

		if ( $allowed_attributes )
		{
			foreach ( $allowed_attributes as $attr )
			{
				$final_output[ $attr->attribute_id ] = $attr->attribute_name;
			}
		}

		return $final_output;
	}
}