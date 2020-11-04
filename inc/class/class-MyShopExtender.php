<?php

use PMW\AttributeTaxonomy;
use PMW\Input;
use PMW\Product;

class MyShopExtender
{
	private static $instance;

	private static $attr_tb = 'woocommerce_attribute_taxonomies';

	public $extra_attr_fields = [
		'attribute_category',
		'show_in_as',
	];

	/**
	 * MyShopExtender constructor.
	 */
	private function __construct()
	{
		global $wpdb;
		self::$attr_tb = $wpdb->prefix . self::$attr_tb;
	}

	/**
	 *
	 */
	public static function run()
	{
		if ( ! self::$instance && class_exists( 'WC_Product' ) )
		{
			self::$instance = new self;

			self::$instance->init();
		}
	}

	/**
	 *
	 */
	public function init()
	{
		// add extra fields to attribute_taxonomies table in database
		add_action( 'admin_init', [ self::$instance, 'make_extra_attribute_fields' ] );

		// add custom fields to edit form of attribute taxonomies
		add_action( 'woocommerce_after_edit_attribute_fields', [ self::$instance, 'attribute_taxonomy_edit_fields' ] );

		// add custom fields to edit form of attribute taxonomies
		add_action( 'woocommerce_after_add_attribute_fields', [ self::$instance, 'attribute_taxonomy_add_fields' ] );

		// save custom fields for attribute taxonomies
		add_action( 'woocommerce_attribute_updated', [ self::$instance, 'attribute_taxonomy_update_fields' ] );

		// save custom fields for attribute taxonomies
		add_action( 'woocommerce_attribute_added', [ self::$instance, 'attribute_taxonomy_store_fields' ] );

		// add color taxonomy to products
		add_action( 'init', [ self::$instance, 'taxonomy_color' ] );

		// add energy usage taxonomy to products
		add_action( 'init', [ self::$instance, 'taxonomy_energy_usage' ] );

		// change checkbox to radio in terms list
		add_filter( 'wp_terms_checklist_args', [ self::$instance, 'radio_term_list' ] );

		// add shop page type to ACF options
		add_filter( 'acf/location/rule_values/page_type', [ self::$instance, 'acfShopPageTypeAdd' ] );

		// add shop page type validation to ACF options
		add_filter( 'acf/location/rule_match/page_type', [ self::$instance, 'acfShopPageTypeValidation' ], 10, 3 );

		// filter uncategorized categories from results
		add_filter( 'get_terms_args', [ self::$instance, 'filterUncategorized' ], 10, 2 );
	}

	/**
	 *
	 */
	public function make_extra_attribute_fields()
	{
		global $wpdb;
		$attributes_table_name = self::$attr_tb;
		foreach ( self::$instance->extra_attr_fields as $field )
		{
			$check = $wpdb->get_results( "SHOW COLUMNS FROM `{$attributes_table_name}` LIKE '{$field}';", 'ARRAY_A' );
			if ( ! $check )
			{
				$wpdb->query( "ALTER TABLE `{$attributes_table_name}` ADD `{$field}` INT NOT NULL;" );
			}
		}
	}

	/**
	 *
	 */
	public function attribute_taxonomy_edit_fields()
	{
		$cats = get_terms( [
			'taxonomy' => 'product_cat',
			'hide_empty' => false,
		] );
		$id   = absint( $_GET[ 'edit' ] );
		global $wpdb;
//		$info = $attribute_to_edit = $wpdb->get_row( 'SELECT ' . ( implode( ', ', self::$instance->extra_attr_fields ) ) . ' FROM ' . self::$attr_tb . " WHERE attribute_id = '$id'" );
		$info = $attribute_to_edit = AttributeTaxonomy::where( 'attribute_id', $id )
			->select( self::$instance->extra_attr_fields )
			->first();
		?>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="attribute_category"><?php esc_html_e( 'Category', 'snowa' ); ?></label>
			</th>
			<td>
				<select name="attribute_category" id="attribute_category">
					<option value="<?= Product::ATTRIBUTE_CAT_ALL ?>" <?= $info->attribute_category == Product::ATTRIBUTE_CAT_ALL ? 'selected' : '' ?>><?= '---- ' . __( 'General', 'snowa' ) . ' ----' ?></option>
					<?php if ( $cats ): ?>
						<?php foreach ( $cats as $cat ): ?>
							<option value="<?= $cat->term_id ?>" <?= $info->attribute_category == $cat->term_id ? 'selected' : '' ?>><?= $cat->name ?></option>
						<?php endforeach; ?>
					<?php endif; ?>
				</select>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="show_in_as"><?php esc_html_e( 'Show In Advanced Search', 'snowa' ); ?></label>
			</th>
			<td>
				<input type="checkbox" name="show_in_as" id="show_in_as" value="1" <?= $info->show_in_as == '1' ? 'checked' : '' ?>>
			</td>
		</tr>
		<?php
	}

	/**
	 *
	 */
	public function attribute_taxonomy_add_fields()
	{
		$cats = get_terms( [
			'taxonomy' => 'product_cat',
			'hide_empty' => false,
		] );
		?>
		<div class="form-field">
			<label for="attribute_category"><?php esc_html_e( 'Category', 'snowa' ); ?></label>
			<select name="attribute_category" id="attribute_category">
				<option value="<?= Product::ATTRIBUTE_CAT_ALL ?>"><?= '---- ' . __( 'General', 'snowa' ) . ' ----' ?></option>
				<?php if ( $cats ): ?>
					<?php foreach ( $cats as $cat ): ?>
						<option value="<?= $cat->term_id ?>"><?= $cat->name ?></option>
					<?php endforeach; ?>
				<?php endif; ?>
			</select>
		</div>
		<div class="form-field">
			<label for="show_in_as">
				<input type="checkbox" name="show_in_as" id="show_in_as" value="1">
				<?php esc_html_e( 'Show In Advanced Search', 'snowa' ); ?>
			</label>
		</div>
		<?php
	}

	/**
	 * @param $id
	 *
	 * @return WP_Error
	 */
	public function attribute_taxonomy_update_fields( $id )
	{
		if ( isset( $_POST[ 'attribute_category' ] ) )
		{
			global $wpdb;
			$data    = [
				'attribute_category' => self::post_field( 'attribute_category', '0' ),
				'show_in_as' => self::post_field( 'show_in_as', '0' ),
			];
			$results = $wpdb->update(
				self::$attr_tb,
				$data,
				[ 'attribute_id' => $id ]
			);

			if ( false === $results )
			{
				return new WP_Error( 'cannot_update_attribute', __( 'Could not update the attribute.', 'woocommerce' ), [ 'status' => 400 ] );
			}
		}
	}

	/**
	 * @param $id
	 */
	public function attribute_taxonomy_store_fields( $id )
	{
		if ( isset( $_POST[ 'attribute_category' ] ) )
		{
			global $wpdb;
			$data    = [
				'attribute_category' => self::post_field( 'attribute_category', '0' ),
				'show_in_as' => self::post_field( 'show_in_as', '0' ),
			];
			$results = $wpdb->update(
				self::$attr_tb,
				$data,
				[ 'attribute_id' => $id ]
			);
		}
	}

	/**
	 *
	 */
	public function taxonomy_color()
	{
		register_taxonomy(
			'product_color',
			'product',
			[
				'label' => __( 'Product Colors', 'snowa' ),
				'labels' => [
					'menu_name' => __( 'Colors', 'snowa' ),
					'name' => __( 'Product Colors', 'snowa' ),
					'singular_name' => __( 'Color', 'snowa' ),
					'search_items' => __( 'Search in Colors', 'snowa' ),
					'popular_items' => __( 'Popular Colors', 'snowa' ),
					'all_items' => __( 'All Colors', 'snowa' ),
					'parent_item' => __( 'Parent Color', 'snowa' ),
					'edit_item' => __( 'Edit Color', 'snowa' ),
					'view_item' => __( 'View Color', 'snowa' ),
					'update_item' => __( 'Update Color', 'snowa' ),
					'add_new_item' => __( 'Add Color', 'snowa' ),
					'new_item_name' => __( 'New Color name', 'snowa' ),
					'items_list_navigation' => __( 'Product Colors', 'snowa' ),
				],
				'hierarchical' => true,
				'show_in_nav_menus' => true,
				'public' => true,
				'query_var' => true,
				'rewrite' => [ 'slug' => 'product_color', 'with_front' => false ],
			]
		);
	}

	/**
	 *
	 */
	public function taxonomy_energy_usage()
	{
		register_taxonomy(
			'energy_usage',
			'product',
			[
				'label' => __( 'Energy Usage Rates', 'snowa' ),
				'labels' => [
					'menu_name' => __( 'Energy Usages', 'snowa' ),
					'name' => __( 'Energy Usage Rates', 'snowa' ),
					'singular_name' => __( 'Usage Rate', 'snowa' ),
					'search_items' => __( 'Search in Usage Rates', 'snowa' ),
					'popular_items' => __( 'Popular Usage Rates', 'snowa' ),
					'all_items' => __( 'All Usage Rates', 'snowa' ),
					'parent_item' => __( 'Parent Usage Rate', 'snowa' ),
					'edit_item' => __( 'Edit Usage Rate', 'snowa' ),
					'view_item' => __( 'View Usage Rate', 'snowa' ),
					'update_item' => __( 'Update Usage Rate', 'snowa' ),
					'add_new_item' => __( 'Add Usage Rate', 'snowa' ),
					'new_item_name' => __( 'New Usage Rate name', 'snowa' ),
					'items_list_navigation' => __( 'Energy Usage Rates', 'snowa' ),
				],
				'hierarchical' => true,
				'show_in_nav_menus' => true,
				'public' => true,
				'query_var' => true,
				'rewrite' => [ 'slug' => 'energy_usage', 'with_front' => false ],
			]
		);
	}

	/**
	 * @param $args
	 *
	 * @return mixed
	 */
	public function radio_term_list( $args )
	{
		if ( ! empty( $args[ 'taxonomy' ] ) && $args[ 'taxonomy' ] === 'energy_usage' /* <== Change to your required taxonomy */ )
		{
			if ( empty( $args[ 'walker' ] ) || is_a( $args[ 'walker' ], 'Walker' ) )
			{
				if ( Input::get( 'post_type' ) != 'product' )
				{
					$args[ 'walker' ] = new class extends Walker_Category_Checklist
					{
						function walk( $elements, $max_depth, $args = [] )
						{
							$output = parent::walk( $elements, $max_depth, $args );
							$output = str_replace(
								[ 'type="checkbox"', "type='checkbox'" ],
								[ 'type="radio"', "type='radio'" ],
								$output
							);

							return $output;
						}
					};
				}
			}
		}

		return $args;
	}

	/**
	 * @param        $name
	 * @param string $default
	 *
	 * @return string
	 */
	public static function post_field( $name, $default = '' )
	{
		return isset( $_POST[ $name ] ) ? ( ! empty( $_POST[ $name ] ) ? $_POST[ $name ] : $default ) : $default;
	}

	/**
	 * @param $choices
	 *
	 * @return mixed
	 */
	public function acfShopPageTypeAdd( $choices )
	{
		$choices[ 'woo-shop-page' ] = __( 'WooCommerce Shop Page', 'snowa' );

		return $choices;
	}

	/**
	 * @param $match
	 * @param $rule
	 * @param $options
	 *
	 * @return bool
	 */
	public function acfShopPageTypeValidation( $match, $rule, $options )
	{
		if ( is_admin() && $rule[ 'value' ] == 'woo-shop-page' )
		{
			$post_id     = $options[ 'post_id' ] ?? 0;
			$woo_shop_id = wc_get_page_id( 'shop' );

			if ( ! $post_id || ! $woo_shop_id )
				return false;

			if ( $rule[ 'operator' ] == "==" )
			{
				$match = $post_id == $woo_shop_id;
			} else if ( $rule[ 'operator' ] == "!=" )
			{
				$match = $post_id != $woo_shop_id;
			}
		}

		return $match;
	}

	/**
	 * @param $args
	 * @param $taxonomies
	 *
	 * @return mixed
	 */
	public function filterUncategorized( $args, $taxonomies )
	{
		$args[ 'taxonomy' ] = isset( $args[ 'taxonomy' ] ) ? ( $args[ 'taxonomy' ] ? $args[ 'taxonomy' ][ 0 ] : '' ) : '';

		if ( $args[ 'taxonomy' ] == 'product_cat' && strpos( pmw_get_current_url(), 'wp-admin' ) === false )
		{
			$args[ 'exclude' ] = get_field( 'exclude_product_categories', 'option' );
		}
		return $args;
	}
}