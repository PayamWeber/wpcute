<?php

class NavHelper
{
	public $html;

	const MENU_MAIN          = 'main';
	const MENU_FIRST_FOOTER  = 'first_footer';
	const MENU_SECOND_FOOTER = 'second_footer';
	const MENU_QUICK_ACCESS  = 'quick_access';

	public function __construct()
	{
	}

	/**
	 * @param        $theme_location
	 * @param string $menu_name
	 * @param bool   $return_html
	 *
	 * @return mixed
	 */
	public function PrintMenu( $theme_location, $menu_name = self::MENU_MAIN, $return_html = false )
	{
		if ( $menu_name == self::MENU_MAIN )
			$this->main_walker( $theme_location );
		if ( $menu_name == self::MENU_FIRST_FOOTER )
			$this->first_footer_walker( $theme_location );
		if ( $menu_name == self::MENU_QUICK_ACCESS )
			$this->quick_access_walker( $theme_location );
		if ( $return_html )
			return $this->html;
		else
			echo $this->html;
	}

	/**
	 * @param        $theme_location
	 * @param string $position
	 * @param string $menu_name
	 * @param bool   $return_html
	 *
	 * @return mixed
	 */
	public function PrintDividedMenu( $theme_location, $position = 'left', $menu_name = self::MENU_SECOND_FOOTER, $return_html = false )
	{
		if ( $menu_name == self::MENU_SECOND_FOOTER )
			$this->second_footer_walker( $theme_location, $position );
		if ( $return_html )
			return $this->html;
		else
			echo $this->html;
	}

	/**
	 * @param null $theme_location
	 * @param null $id
	 * @param int  $depth
	 */
	public function main_walker( $theme_location = NULL, $id = NULL, $depth = 0 )
	{
		if ( ( $theme_location ) && ( $locations = get_nav_menu_locations() ) && isset( $locations[ $theme_location ] ) ) {
			$menu       = get_term( $locations[ $theme_location ], 'nav_menu' );
			$menu_items = wp_get_nav_menu_items( $menu->term_id ?? '' );
			if ( $menu_items && $depth <= 2 ) {
				foreach ( $menu_items as $key => $item ) {
					$link            = $item->url;
					$title           = $item->title;
					$allowed_to_show = false;
					if ( $id ) {
						$allowed_to_show = $item->menu_item_parent == $id;
					} else {
						$allowed_to_show = ! $item->menu_item_parent;
					}
					//                if ( ( ! $item->image || ! $item->dark_image ) && $depth == 1 )
					//                    continue;
					if ( $allowed_to_show ) {
						$has_child     = isset( $menu_items[ $key + 1 ] ) && $item->ID == $menu_items[ $key + 1 ]->menu_item_parent;
						$active        = false;
						$classes       = '';
						$title_classes = '';
						$current_url   = pmw_get_current_url();

						if ( $current_url == $link )
							$active = true;

						if ( $has_child && $depth == 0 ) {
							$classes .= ' sub-menu-li color-F3E';
							$title_classes .= ' menu-title';
						} else if ( $depth == 0 ) {
							$classes .= ' down-menu-item';
							$title_classes .= ' title-name';
						} else if ( $depth == 1 ) {
							$classes .= ' service-title for-sub-02 color-e4e';
							$title_classes .= ' title-name';
						}

						$this->html .= '<li class="' . $classes . '">';

						// add [a] tag
						$this->html .= '<a class="' . $title_classes . ' color-F3E" href="' . $link . '">';

						$this->html .= $title;

						// add icon if have child
						$this->html .= ( $has_child && $depth == 0 ) ? ' <i class="icon-Polygon-1 af-icons"></i>' : '';

						// add [a] tag
						$this->html .= '</a>';

						if ( $has_child && $depth == 0 ) {
							$this->html .= '<ul class="sub-menu-level-02">';
							$this->main_walker( $theme_location, $item->ID, $depth + 1 );
							$this->html .= '</ul>';
						}

						$this->html .= '</li>';
					}
				}
			}
		}
	}

	/**
	 * @param null $theme_location
	 * @param null $id
	 * @param int  $depth
	 */
	public function first_footer_walker( $theme_location = NULL, $id = NULL, $depth = 0 )
	{
		if ( ( $theme_location ) && ( $locations = get_nav_menu_locations() ) && isset( $locations[ $theme_location ] ) ) {
			$menu       = get_term( $locations[ $theme_location ], 'nav_menu' );
			$menu_items = wp_get_nav_menu_items( $menu->term_id ?? '' );
			if ( $menu_items && $depth <= 1 ) {
				foreach ( $menu_items as $key => $item ) {
					$link            = $item->url;
					$title           = $item->title;
					$allowed_to_show = false;
					if ( $id ) {
						$allowed_to_show = $item->menu_item_parent == $id;
					} else {
						$allowed_to_show = ! $item->menu_item_parent;
					}
					if ( $allowed_to_show ) {
						$has_child   = $item->ID == $menu_items[ $key + 1 ]->menu_item_parent;
						$active      = false;
						$classes     = [];
						$current_url = pmw_get_current_url();

						if ( $current_url == $link )
							$active = true;
						if ( $has_child && $depth <= 1 )
							$classes[] = 'haschild';

						if ( $active )
							$classes[] = 'active';

						$icon      = wp_get_attachment_image_url( $item->image, 'thumbnail' );
						$icon_html = "<img class=\"footer-icon\" src=\"$icon\" alt=\"$title\">";
						if ( $depth == 0 )
							$this->html .= "<div class=\"footer-col\">";
						else
							$this->html .= '<li>';
						$this->html .= ( $depth == 0 ? $icon_html : '' ) . '<a ' . ( $depth == 0 ? 'class="footer-title"' : '' ) . ' href="' . $link . '">' . $title . '</a>';
						if ( $item->ID == $menu_items[ $key + 1 ]->menu_item_parent && $depth == 0 ) {
							$this->html .= '<nav><ul class="footer-url">';
							$this->first_footer_walker( $theme_location, $item->ID, $depth + 1 );
							$this->html .= '</ul></nav>';
						}
						if ( $depth == 0 )
							$this->html .= "</div>";
						else
							$this->html .= '</li>';
					}
				}
			}
		}
	}

	/**
	 * @param null   $theme_location
	 * @param string $position
	 * @param null   $id
	 * @param int    $depth
	 */
	public function second_footer_walker( $theme_location = NULL, $position = 'left', $id = NULL, $depth = 0 )
	{
		$html = [];
		if ( ( $theme_location ) && ( $locations = get_nav_menu_locations() ) && isset( $locations[ $theme_location ] ) ) {
			$menu       = get_term( $locations[ $theme_location ], 'nav_menu' );
			$menu_items = wp_get_nav_menu_items( $menu->term_id ?? '' );
			if ( $menu_items && $depth == 0 ) {
				foreach ( $menu_items as $key => $item ) {
//					if ( $item->side_position != $position )
//						continue;

					$link            = $item->url;
					$title           = $item->title;
					$allowed_to_show = false;
					if ( $id ) {
						$allowed_to_show = $item->menu_item_parent == $id;
					} else {
						$allowed_to_show = ! $item->menu_item_parent;
					}
					if ( $allowed_to_show ) {
						$html[$key] = '';
						$html[$key] .= '<li>';
						$html[$key] .= '<a href="' . $link . '">' . $title . '</a>';
						$html[$key] .= '</li>';
					}
				}
			}
		}

		if ( $html && count( $html ) == 1 ){
			$this->html = implode( '', $html );
		}
		if ( $html && count( $html ) > 1 ){
			$count = count( $html );
			$half = round( $count / 2 );
			$final = array_slice( $html, ( $position == 'left' ? 0 : $half ), ( $position == 'left' ? $half : 99 ) );
			$this->html = implode( '', $final );
		}
	}

	/**
	 * @param null $theme_location
	 * @param null $id
	 */
	public function quick_access_walker( $theme_location = NULL )
	{
		if ( ( $theme_location ) && ( $locations = get_nav_menu_locations() ) && isset( $locations[ $theme_location ] ) ) {
			$menu       = get_term( $locations[ $theme_location ], 'nav_menu' );
			$menu_items = wp_get_nav_menu_items( $menu->term_id ?? '' );
			if ( $menu_items ) {
				foreach ( $menu_items as $key => $item ) {
					$link  = $item->url;
					$title = $item->title;

					if ( $item->menu_item_parent == 0 ) {
						$icon      = wp_get_attachment_image_url( $item->image, 'thumbnail' );
						$icon_html = $icon ? "<img class=\"card-f__img\" src=\"$icon\" alt=\"$title\">" : '';

						$this->html .= '<li>';
						$this->html .= '<a href="' . $link . '" class="card-f card-f--hover card-f--vertical">';

						$this->html .= $icon_html;
						$this->html .= "<p class=\"card-f__title\">$title</p>";

						$this->html .= '</a>';
						$this->html .= '</li>';
					}
				}
			}
		}
	}
}