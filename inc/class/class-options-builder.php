<?php

class PMW_OptionsBuilder
{
	/**
	 * this function loads the custom options for theme by PayamWeber
	 *
	 * @param       array $options an array of options
	 *
	 * @return      void/html               do the job
	 */
	public function make_options( array $options )
	{
		// load options menu
		if ( isset( $options[ 'menu' ] ) )
		{
			echo "
        <aside>
        <ul>
        ";
			foreach ( $options[ 'menu' ] as $key => $value )
			{
				$_menu_id             = isset( $value[ 'id' ] ) ? $value[ 'id' ] : '';
				$_menu_class          = isset( $value[ 'class' ] ) ? $value[ 'class' ] : '';
				$_menu_icon           = ( isset( $value[ 'icon' ] ) && $value[ 'icon' ] ) ? $value[ 'icon' ] : 'home';
				$_menu_title          = isset( $value[ 'title' ] ) ? $value[ 'title' ] : '';
				$_menu_children       = isset( $value[ 'children' ] ) ? $value[ 'children' ] : '';
				$_menu_before_content = isset( $value[ 'before_content' ] ) ? $value[ 'before_content' ] : '';
				$_menu_after_content  = isset( $value[ 'after_content' ] ) ? $value[ 'after_content' ] : '';
				echo "
            <li id=\"{$_menu_id}\" class=\"{$_menu_class}\">
                " . $this->opt_load_callable( $_menu_before_content ) . "
                <div>
                    <span class=\"fa fa-{$_menu_icon}\"></span>
                    <span class=\"title\">{$_menu_title}</span>
            ";
				echo "
                </div>
            ";
				if ( is_array( $_menu_children ) && $_menu_children )
				{
					echo "<ul>";
					foreach ( $_menu_children as $child )
					{
						$_child_id    = $child[ 'id' ];
						$_child_title = $child[ 'title' ];
						echo "
                    <li id=\"{$_child_id}\">{$_child_title}</li>
                    ";
					}
					echo "</ul>";
				}
				echo "
                " . $this->opt_load_callable( $_menu_after_content ) . "
            </li>
            ";
			}
			echo "
        </ul>
        </aside>
        ";
		}
		// load options content
		if ( isset( $options[ 'content' ] ) )
		{
			$_section_before_content = isset( $options[ 'content' ][ 'before_content' ] ) ? $options[ 'content' ][ 'before_content' ] : '';
			$_section_after_content  = isset( $options[ 'content' ][ 'after_content' ] ) ? $options[ 'content' ][ 'after_content' ] : '';
			echo "
        <section>
        ";
			$this->opt_load_callable( $_section_before_content );
			if ( isset( $options[ 'content' ] ) )
			{
				foreach ( $options[ 'content' ] as $_key => $_value )
				{
					$_content_id             = isset( $_value[ 'id' ] ) ? $_value[ 'id' ] : '';
					$_content_class          = isset( $_value[ 'class' ] ) ? $_value[ 'class' ] : '';
					$_content_before_content = isset( $_value[ 'before_content' ] ) ? $_value[ 'before_content' ] : '';
					$_content_after_content  = isset( $_value[ 'after_content' ] ) ? $_value[ 'after_content' ] : '';
					$_content_title          = isset( $_value[ 'title' ] ) ? $_value[ 'title' ] : '';
					echo "
                <div id=\"block-{$_content_id}\" class=\"singleBlock {$_content_class}\">
                    " . $this->opt_load_callable( $_content_before_content ) . "
                    <h3 class=\"part_title\">{$_content_title}</h3>
                ";
					// settings loop
					if ( isset( $_value[ 'settings' ] ) )
					{
						$this->opt_load_options_settings( $_value[ 'settings' ] );
					}
					// settings loop
					$this->opt_load_callable( $_content_after_content );
					echo "
                </div>
                ";
				}
			}
			$this->opt_load_callable( $_section_after_content );
			echo "
        </section>
        ";
		}
	}

	/**
	 * load a function if is callable
	 *
	 * @param   callable $func a callable variable
	 *
	 * @return  void                    do the job
	 */
	public function opt_load_callable( $func, array $args = NULL )
	{
		if ( is_callable( $func ) )
		{
			( $args ) ? $func( $args ) : $func();
		}
	}

	/**
	 * this function created for ( pmw_load_options function )
	 * this function make settings given from developer as array
	 *
	 * @param  array $settings settings in this array
	 *
	 * @return void/html                print settings
	 */
	public function opt_load_options_settings( array $settings )
	{
		if ( $settings )
		{
			foreach ( $settings as $__key => $setting )
			{
				$_id                = isset( $setting[ 'id' ] ) ? $setting[ 'id' ] : '';
				$_class             = isset( $setting[ 'class' ] ) ? $setting[ 'class' ] : '';
				$_title             = isset( $setting[ 'title' ] ) ? $setting[ 'title' ] : '';
				$_desc              = isset( $setting[ 'description' ] ) ? $setting[ 'description' ] : '';
				$_type              = ( isset( $setting[ 'type' ] ) && $setting[ 'type' ] ) ? $setting[ 'type' ] : 'input';
				$_value             = isset( $setting[ 'value' ] ) ? $setting[ 'value' ] : '';
				$_input_class       = isset( $setting[ 'input_args' ][ 'class' ] ) ? $setting[ 'input_args' ][ 'class' ] : '';
				$_input_type        = isset( $setting[ 'input_args' ][ 'type' ] ) ? $setting[ 'input_args' ][ 'type' ] : 'text';
				$_input_name        = isset( $setting[ 'input_args' ][ 'name' ] ) ? $setting[ 'input_args' ][ 'name' ] : '';
				$_input_placeholder = isset( $setting[ 'input_args' ][ 'placeholder' ] ) ? $setting[ 'input_args' ][ 'placeholder' ] : '';
				$_list_item_args    = isset( $setting[ 'list_item_args' ] ) ? $setting[ 'list_item_args' ] : '';
				$_before_content    = isset( $setting[ 'before_content' ] ) ? $setting[ 'before_content' ] : '';
				$_after_content     = isset( $setting[ 'after_content' ] ) ? $setting[ 'after_content' ] : '';
				$_input_items       = isset( $setting[ 'input_args' ][ 'items' ] ) ? $setting[ 'input_args' ][ 'items' ] : '';
				$_custom            = isset( $setting[ 'custom' ] ) ? $setting[ 'custom' ] : '';
				echo "
            <div id='{$_id}' class=\"singleSetting {$_class}\">
                " . $this->opt_load_callable( $_before_content ) . "
                <h4 class=\"settingTitle\">{$_title}</h4>
            ";
				// setting content
				switch ( $_type )
				{
					case 'input':
						$_value = htmlspecialchars( $_value );
						echo "<input class=\"{$_input_class}\" type=\"{$_input_type}\" name=\"{$_input_name}\" placeholder=\"{$_input_placeholder}\" value=\"{$_value}\"/>";
						break;
					case 'url':
						$_value = htmlspecialchars( $_value );
						echo "<input class=\"{$_input_class} pmw_number\" type=\"{$_input_type}\" name=\"{$_input_name}\" placeholder=\"{$_input_placeholder}\" value=\"{$_value}\"/>";
						break;
					case 'input-url':
						pmw_url_input( $_input_name, '', esc_attr( $_value ), $_input_class );
						break;
					case 'list_item':
						$this->make_list_item( $_list_item_args );
						break;
					case 'textarea':
						$_value = htmlspecialchars( $_value );
						echo "<textarea class=\"{$_input_class}\" name=\"{$_input_name}\" placeholder=\"{$_input_placeholder}\">{$_value}</textarea>";
						break;
					case 'radio':
						echo $this->make_radio_buttons( $_input_name, $_value, $_input_items, $_input_class );
						break;
					case 'checkbox':
					case 'switch':
						$_value = htmlspecialchars( $_value );
						echo $this->make_custom_checkbox( $_input_name, $_value, $_input_class );
						break;
					case 'dropdown':
					case 'select':
						$_value = $_value;
						echo $this->make_selectbox( $_input_name, $_value, $_input_items, $_input_class );
						break;
					case 'multi':
					case 'multicheckbox':
						$_value = $_value;
						echo $this->make_multi_checkbox( $_input_name, $_value, $_input_items, $_input_class );
						break;
					case 'image':
						pmw_create_image_upload( '', $_input_name, $_value );
						break;
					case 'file':
						echo '';
						break;
					case 'custom':
						$this->opt_load_callable( $_custom );
						break;
				}
//				if ( $_type == 'input' )
//				{
//					$_value = htmlspecialchars( $_value );
//					echo "<input class=\"{$_input_class}\" type=\"{$_input_type}\" name=\"{$_input_name}\" placeholder=\"{$_input_placeholder}\" value=\"{$_value}\"/>";
//				}
//				if ( $_type == 'input-url' )
//				{
//					pmw_url_input( $_input_name, str_replace( ']', '', str_replace( '[', '', $_input_name ) ), esc_attr( $_value ), $_input_class );
//				}
//				if ( $_type == 'list_item' )
//				{
//					$this->make_list_item( $_list_item_args );
//				}
//				if ( $_type == 'textarea' )
//				{
//					$_value = htmlspecialchars( $_value );
//					echo "
//                <textarea class=\"{$_input_class}\" name=\"{$_input_name}\" placeholder=\"{$_input_placeholder}\">{$_value}</textarea>
//                ";
//				}
//				if ( $_type == 'radio' )
//				{
//					$_value = $_value;
//					echo $this->make_radio_buttons( $_input_name, $_value, $_input_items, $_input_class );
//				}
//				if ( $_type == 'checkbox' || $_type == 'switch' )
//				{
//					$_value = htmlspecialchars( $_value );
//					echo $this->make_custom_checkbox( $_input_name, $_value, $_input_class );
//				}
//				if ( $_type == 'dropdown' || $_type == 'select' )
//				{
//					$_value = $_value;
//					echo $this->make_selectbox( $_input_name, $_value, $_input_items, $_input_class );
//				}
//				if ( $_type == 'multi' || $_type == 'multicheckbox' )
//				{
//					$_value = $_value;
//					echo $this->make_multi_checkbox( $_input_name, $_value, $_input_items, $_input_class );
//				}
//				if ( $_type == 'image' )
//				{
//					pmw_create_image_upload( '', $_input_name, $_value );
//				}
//				if ( $_type == 'file' )
//				{
//					echo '';
//				}
//				if ( $_type == 'custom' )
//				{
//					$this->opt_load_callable( $_custom );
//				}
				// setting content
				echo "
                <small>{$_desc}</small>
                " . $this->opt_load_callable( $_after_content ) . "
            </div>
            ";
			}
		}
	}

	/**
	 * this function makes a pmw list items box
	 *
	 * @param  array $args [an array of arguments]
	 *
	 * @return void/html       [print pmw list item]
	 */
	public function make_list_item( array $args )
	{
		/**
		 * setup default arguments
		 */
		$defaults = [
			'fields' => '',
			'items' => '',
			'singular_name' => 'آیتم',
			'theme' => 'light',
			'single_input' => FALSE,
			'tab_select' => FALSE,
			'tab_items' => '',
			'tab_name' => '',
		];
		$args     = array_merge( $defaults, $args );
		if ( ! $args[ 'fields' ] || ! is_array( $args[ 'fields' ] ) )
		{
			return FALSE;
		}
		// additional custom classes for developer
		$additional_classes = '';
		$additional_classes .= ( $args[ 'single_input' ] === TRUE ) ? 'pmw_list_item_single_input' : '';

//        echo "<pre>";
//        var_dump( $args['items'][ $this->opt_get_first_array_member( $args['fields'], TRUE ) ] );
//        echo "</pre>";
		?>
		<div class="pmw_list_items_container">
			<div class="pmw_list_items <?php echo htmlspecialchars( $args[ 'theme' ] ); ?> pm_sortable">
				<?php
				if ( $args[ 'items' ] && isset( $args[ 'items' ][ $this->opt_get_first_array_member( $args[ 'fields' ], TRUE ) ] ) && $args[ 'items' ][ $this->opt_get_first_array_member( $args[ 'fields' ], TRUE ) ] )
				{
					foreach ( $args[ 'items' ][ $this->opt_get_first_array_member( $args[ 'fields' ], TRUE ) ] as $item_key => $item_title )
					{
						?>
						<div class="pmw_list_item_box <?php echo $additional_classes; ?>">
							<div class="pmw_list_item_options">
								<a class="fa fa-plus-circle add_pmw_item" title="اضافه کن"></a>
								<a class="fa fa-minus-circle remove_pmw_item" title="حذف کن"></a>
							</div>
							<h4 class="pmw_list_item_title closed">
								<?php
								if ( $args[ 'tab_select' ] === TRUE && $args[ 'tab_items' ] )
								{
									echo '<a class="dashicons dashicons-arrow-down-alt2"></a>';
									echo '<span>' . $args[ 'tab_items' ][ $args[ 'items' ][ 'tab_name' ][ $item_key ] ] . '</span>';
								} else
								{
									if ( $args[ 'single_input' ] === TRUE )
									{
										$first_array_member = $this->opt_get_first_array_member( $args[ 'fields' ] );
										echo '<input class="' . $first_array_member[ 'classes' ] . '" type="text" name="' . $first_array_member[ 'name' ] . '" value="' . $item_title . '">';
									} else
									{
										echo '<a class="dashicons dashicons-arrow-down-alt2"></a>';
										echo '<span>' . ( ( mb_strlen( $item_title, 'UTF-8' ) > 50 ) ? mb_substr( $item_title, 0, 50, 'UTF-8' ) . ' . . .' : $item_title ) . '</span>';
									}
								}
								?>
							</h4>
							<?php
							if ( $args[ 'single_input' ] !== TRUE ):
								?>
								<div class="pmw_list_item_content">
									<?php
									// tab select
									if ( $args[ 'tab_select' ] === TRUE && $args[ 'tab_items' ] )
									{
										echo '<select class="tab_select_list_item" name="' . $args[ 'tab_name' ] . '">';
										foreach ( $args[ 'tab_items' ] as $key => $value )
										{
											$selected = ( $args[ 'items' ][ 'tab_name' ][ $item_key ] == $key ) ? 'selected="selected"' : '';
											echo "<option {$selected} value=\"{$key}\">{$value}</option>";
										}
										echo '</select>';
									}
									foreach ( $args[ 'fields' ] as $key => $value )
									{
										$type                                 = isset( $value[ 'type' ] ) ? $value[ 'type' ] : '';
										$classes                              = isset( $value[ 'classes' ] ) ? $value[ 'classes' ] : '';
										$value[ 'tab' ]                       = isset( $value[ 'tab' ] ) ? $value[ 'tab' ] : '';
										$value[ 'title' ]                     = isset( $value[ 'title' ] ) ? $value[ 'title' ] : '';
										$value[ 'placeholder' ]               = isset( $value[ 'placeholder' ] ) ? $value[ 'placeholder' ] : '';
										$value[ 'name' ]                      = isset( $value[ 'name' ] ) ? $value[ 'name' ] : '';
										$value[ 'choices' ]                   = isset( $value[ 'choices' ] ) ? $value[ 'choices' ] : '';
										$args[ 'items' ][ $key ][ $item_key ] = isset( $args[ 'items' ][ $key ][ $item_key ] ) ? $args[ 'items' ][ $key ][ $item_key ] : '';
										$_before_name                         = preg_replace( '/(.*\[)([0-9]*)(\].*)/', '$1', $value[ 'name' ] );
										$_after_name                          = preg_replace( '/(.*\[)([0-9]*)(\].*)/', '$3', $value[ 'name' ] );
										$value[ 'name' ]                      = $_before_name . $item_key . $_after_name;
										// add tab class
										if ( $args[ 'tab_select' ] === TRUE && $args[ 'tab_items' ] )
										{
											$classes = $classes . ' ' . $value[ 'tab' ];
										}
										echo "<div class='this-setting'><label class='{$value['tab']}'>" . $value[ 'title' ] . '</label>';
										// if its input text show this
										if ( $type == 'input' )
										{
											echo '<input placeholder="' . $value[ 'placeholder' ] . '" class="' . $classes . '" type="text" name="' . $value[ 'name' ] . '" value="' . htmlspecialchars( $args[ 'items' ][ $key ][ $item_key ] ) . '">';
										}
										if ( $type == 'input-url' )
										{
											pmw_url_input( $value[ 'name' ], str_replace( ']', '', str_replace( '[', '', $value[ 'name' ] ) ), esc_attr( $args[ 'items' ][ $key ][ $item_key ] ), $classes );
										}
										// if its radio text show this
										if ( $type == 'radio' )
										{
											echo $this->make_radio_buttons( $value[ 'name' ], $args[ 'items' ][ $key ][ $item_key ], $value[ 'choices' ] );
										}
										// if its radio text show this
										if ( $type == 'multi' )
										{
											echo $this->make_multi_checkbox( $value[ 'name' ], $args[ 'items' ][ $key ][ $item_key ], $value[ 'choices' ] );
										}
										// if its radio text show this
										if ( $type == 'select' )
										{
											echo $this->make_selectbox( $value[ 'name' ], $args[ 'items' ][ $key ][ $item_key ], $value[ 'choices' ] );
										}
										// if its radio text show this
										if ( $type == 'checkbox' )
										{
											echo $this->make_custom_checkbox( $value[ 'name' ], htmlspecialchars( $args[ 'items' ][ $key ][ $item_key ] ) );
										}
										// if its textarea show this
										if ( $type == 'textarea' )
										{
											echo '<textarea placeholder="' . $value[ 'placeholder' ] . '" class="' . $classes . '" name="' . $value[ 'name' ] . '">' . htmlspecialchars( $args[ 'items' ][ $key ][ $item_key ] ) . '</textarea>';
										}
										// if its image upload show this
										if ( $type == 'image' )
										{
											pmw_create_image_upload( '', $value[ 'name' ], $args[ 'items' ][ $key ][ $item_key ] );
										}
										// if its file upload show this
										if ( $type == 'file' )
										{
											echo '';
										}
										echo "</div>";
									}
									?>
								</div>
							<?php
							endif;
							?>
						</div>
						<?php
					}
				}
				?>
			</div>
			<div class="pmw_list_item_box  <?php echo $additional_classes; ?>">
				<div class="pmw_list_item_options">
					<a class="fa fa-plus-circle add_pmw_item" title="اضافه کن"></a>
					<a class="fa fa-minus-circle remove_pmw_item" title="حذف کن"></a>
				</div>
				<h4 class="pmw_list_item_title closed">
					<?php
					if ( $args[ 'single_input' ] === TRUE )
					{
						$first_array_member = $this->opt_get_first_array_member( $args[ 'fields' ] );
						echo '<input class="' . $first_array_member[ 'classes' ] . '" type="text" hidden-name="' . $first_array_member[ 'name' ] . '" placeholder="یک ' . $args[ 'singular_name' ] . ' جدید">';
					} else
					{
						echo '<a class="dashicons dashicons-arrow-down-alt2"></a>';
						echo '<span>یک ' . $args[ 'singular_name' ] . ' جدید</span>';
					}
					?>
				</h4>
				<?php
				if ( $args[ 'single_input' ] !== TRUE ):
					?>
					<div class="pmw_list_item_content">
						<?php
						// tab select
						if ( $args[ 'tab_select' ] === TRUE && $args[ 'tab_items' ] )
						{
							echo '<select class="tab_select_list_item">';
							foreach ( $args[ 'tab_items' ] as $key => $value )
							{
								echo "<option value=\"{$key}\">{$value}</option>";
							}
							echo '</select>';
						}
						foreach ( $args[ 'fields' ] as $key => $value )
						{
							$type                   = isset( $value[ 'type' ] ) ? $value[ 'type' ] : '';
							$classes                = isset( $value[ 'classes' ] ) ? $value[ 'classes' ] : '';
							$value[ 'tab' ]         = isset( $value[ 'tab' ] ) ? $value[ 'tab' ] : '';
							$value[ 'title' ]       = isset( $value[ 'title' ] ) ? $value[ 'title' ] : '';
							$value[ 'placeholder' ] = isset( $value[ 'placeholder' ] ) ? $value[ 'placeholder' ] : '';
							$value[ 'name' ]        = isset( $value[ 'name' ] ) ? $value[ 'name' ] : '';
							$value[ 'choices' ]     = isset( $value[ 'choices' ] ) ? $value[ 'choices' ] : '';
							// add tab class
							if ( $args[ 'tab_select' ] === TRUE && $args[ 'tab_items' ] )
							{
								$classes = $classes . ' ' . $value[ 'tab' ];
							}
							echo "<div class='this-setting'><label class='{$value['tab']}'>" . $value[ 'title' ] . '</label>';
							// if its input text show this
							if ( $type == 'input' )
							{
								echo '<input placeholder="' . $value[ 'placeholder' ] . '" class="' . $classes . '" type="text" hidden-name="' . $value[ 'name' ] . '" value="">';
							}
							if ( $type == 'input-url' )
							{
								echo str_replace( 'name=', 'hidden-name=', pmw_url_input( $value[ 'name' ], str_replace( ']', '', str_replace( '[', '', $value[ 'name' ] ) ), '', $classes, false ) );
							}
							// if its radio text show this
							if ( $type == 'radio' )
							{
								echo str_replace( 'name=', 'hidden-name=', $this->make_radio_buttons( $value[ 'name' ], '', $value[ 'choices' ] ) );
							}
							// if its radio text show this
							if ( $type == 'multi' )
							{
								echo str_replace( 'name=', 'hidden-name=', $this->make_multi_checkbox( $value[ 'name' ], '', $value[ 'choices' ] ) );
							}
							// if its radio text show this
							if ( $type == 'select' )
							{
								echo str_replace( 'name=', 'hidden-name=', $this->make_selectbox( $value[ 'name' ], '', $value[ 'choices' ] ) );
							}
							// if its radio text show this
							if ( $type == 'checkbox' )
							{
								echo str_replace( 'name=', 'hidden-name=', $this->make_custom_checkbox( $value[ 'name' ], '' ) );
							}
							// if its textarea show this
							if ( $type == 'textarea' )
							{
								echo '<textarea placeholder="' . $value[ 'placeholder' ] . '" class="' . $classes . '" hidden-name="' . $value[ 'name' ] . '"></textarea>';
							}
							// if its image upload show this
							if ( $type == 'image' )
							{
								echo str_replace( 'name=', 'hidden-name=', pmw_create_image_upload( '', $value[ 'name' ], '', false ) );
							}
							// if its file upload show this
							if ( $type == 'file' )
							{
								echo '';
							}
							echo "</div>";
						}
						?>
					</div>
				<?php
				endif;
				?>
			</div>
			<input class="button hide-if-no-js add_new_list_item <?php echo htmlspecialchars( $args[ 'theme' ] ); ?>" type="button"
				   value="افزودن <?php echo $args[ 'singular_name' ]; ?>">
			<div class="clear_fix"></div>
		</div>
		<?php
	}

	/**
	 * this function give you first member of an array
	 *
	 * @param   array   $array target array
	 * @param   boolean $name  return array key(name)
	 *
	 * @return  mixed               value of first member
	 */
	public function opt_get_first_array_member( array $array, $name = FALSE )
	{
		if ( $array )
		{
			foreach ( $array as $key => $value )
			{
				return ( $name === TRUE ) ? $key : $value;
			}
		}

		return FALSE;
	}

	/**
	 * @param string $name
	 * @param string $value
	 * @param array  $items
	 * @param string $class
	 *
	 * @return bool|string
	 */
	public function make_radio_buttons( $name = '', $value = '', $items = [], $class = '' )
	{
		if ( ! $items || ! $name )
			return FALSE;
		$html       = '
        <div class="options-radio-buttons' . $class . '">
        <input type=\'hidden\' value=\'\' name=\'' . $name . '\'>';
		$past_value = $value;
		foreach ( $items as $value => $title )
		{
			$checked = ( $past_value == $value ) ? 'checked="checked"' : '';
			$html    .= "
            <label class=\"radio_container\">$title
                <input name=\"$name\" $checked value=\"$value\" type=\"radio\">
                <span class=\"checkmark\"></span>
            </label>
            ";
		}
		$html .= "</div>";

		return $html;
	}

	/**
	 * @param string $name
	 * @param string $value
	 * @param array  $items
	 * @param string $class
	 *
	 * @return bool|string
	 */
	public function make_multi_checkbox( $name = '', $value = '', $items = [], $class = '' )
	{
		if ( ! $items || ! $name )
			return FALSE;
		$html       = '
        <div class="options-radio-buttons multiselect' . $class . '">
        <input type=\'hidden\' value=\'\' name=\'' . $name . '\'>';
		$past_value = ( is_string( $value ) && is_array( json_decode( $value, true ) ) ) ? json_decode( $value, true ) : $value;
		foreach ( $items as $value => $title )
		{
			$checked = ( is_array( $past_value ) && in_array( $value, $past_value ) ) ? 'checked="checked"' : '';
			$html    .= "
            <label class=\"radio_container checkbox_container\">$title
                <input name=\"$name\" $checked value=\"$value\" type=\"checkbox\">
                <span class=\"checkmark\"></span>
            </label>
            ";
		}
		$html .= "</div>";

		return $html;
	}

	/**
	 * @param string $name
	 * @param string $value
	 * @param array  $items
	 * @param string $class
	 *
	 * @return bool|string
	 */
	public function make_selectbox( $name = '', $value = '', $items = [], $class = '' )
	{
		if ( ! $items || ! $name )
			return FALSE;
		$html       = "<select name=\"$name\" class='options-custom-select $class'>";
		$past_value = $value;
		foreach ( $items as $value => $title )
		{
			$selected = ( $past_value == $value ) ? 'selected="selected"' : '';
			$html     .= "<option $selected value=\"$value\">$title</option>";
		}
		$html .= "</select>";

		return $html;
	}

	/**
	 * @param string $name
	 * @param string $value
	 * @param string $class
	 *
	 * @return bool|string
	 */
	public function make_custom_checkbox( $name = '', $value = '', $class = '' )
	{
		if ( ! $name )
			return FALSE;
		$checked = ( $value ) ? 'checked="checked"' : '';
		$html    = "
        <input type='hidden' value='0' name='$name'>
        <label class=\"switch-checkbox onoff $class\">
            <input $checked name=\"$name\" value=\"1\" type=\"checkbox\">
            <span class=\"this-slider round\"></span>
        </label>
        ";

		return $html;
	}
}