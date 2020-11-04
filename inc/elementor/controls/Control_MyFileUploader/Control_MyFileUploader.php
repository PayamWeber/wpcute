<?php

use Elementor\Modules\DynamicTags\Module as TagsModule;

class Control_MyFileUploader extends \Elementor\Base_Data_Control
{
    public static $_id = 'my_file_uploader';

    /**
     * Get emoji one area control type.
     *
     * Retrieve the control type, in this case `emojionearea`.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Control type.
     */
    public function get_type()
    {
        return self::$_id;
    }

    /**
     * Enqueue emoji one area control scripts and styles.
     *
     * Used to register and enqueue custom scripts and styles used by the emoji one
     * area control.
     *
     * @since 1.0.0
     * @access public
     */
    public function enqueue() {
        // Styles

        // Scripts

        wp_enqueue_media();
    }

    /**
     * Render text control output in the editor.
     *
     * Used to generate the control HTML in the editor using Underscore JS
     * template. The variables for the class are available using `data` JS
     * object.
     *
     * @since 1.0.0
     * @access public
     */
    public function content_template() {
        $control_uid = $this->get_control_uid();
        ?>
        <div class="elementor-control-field">
            <# if ( data.label ) {#>
            <label for="<?php echo $control_uid; ?>" class="elementor-control-title">{{{ data.label }}}</label>
            <# } #>
            <div class="elementor-control-input-wrapper">
                <input id="<?php echo $control_uid; ?>" type="{{ data.input_type }}" class="tooltip-target elementor-control-tag-area" data-tooltip="{{ data.title }}" title="{{ data.title }}" data-setting="{{ data.name }}" placeholder="{{ data.placeholder }}" />
            </div>
        </div>
        <# if ( data.description ) { #>
        <div class="elementor-control-field-description">{{{ data.description }}}</div>
        <# } #>
        <?php
    }

    /**
     * Get text control default settings.
     *
     * Retrieve the default settings of the text control. Used to return the
     * default settings while initializing the text control.
     *
     * @since 1.0.0
     * @access protected
     *
     * @return array Control default settings.
     */
    protected function get_default_settings() {
        return [
            'input_type' => 'text',
            'placeholder' => '',
            'title' => '',
            'dynamic' => [
                'categories' => [ TagsModule::TEXT_CATEGORY ],
            ],
        ];
    }

}