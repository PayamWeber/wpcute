<?php
function page_meta_content($p){
    $meta = get_post_custom($p->ID);
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    //html
    ?>
    <section id="meta_body" class="page_meta">
        <div id="tabs" class="jqui_tabs">
            <ul>
                <li><a href="#tabs-1">تنظیمات عمومی</a></li>
            </ul>
            <div id="tabs-1" class="public_settings">
                <table class="options-table">
                    <tr>
                        <td>
                            <h2 class="meta_title small" style="">
                                <span>قالب داخلی</span>
                            </h2>
                        </td>
                        <td>
                            <select id="select-template" name="sp_page_template" class="jqui_select">
                                <?php
                                global $sp_page_names;
                                $n = 1;
                                foreach($sp_page_names as $slug => $name){
                                    $selected = ($slug === $meta['sp_page_template'][0])?"selected='selected' class='selected'":"";
                                    $s = ($n === 2)?"selected='selected'":"";
                                    echo "<option value='" . $slug . "' " . $selected . ">" . $name . "</option>";
                                    $n++;
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div id="tabs" class="jqui_tabs special-tab">
            <ul>
                <li><a href="#tabs-1" id="special_tab_title">تنظیمات اختصاصی</a></li>
            </ul>
            <div id="tabs-1" class="special_settings">
                <!------------------------------------------------->
                <!---------------------== single tab ==---------------------->
                <!-------------------------------------------------->
                <div id="aboutus" tab-id="aboutus">
                    <?php $aboutus_settings = pmw_get_json_pmeta( '_aboutus_settings', $p->ID ); ?>
                    <table class="options-table" style="margin-top: 20px;">
                        <tr style="margin-top: 15px;">
                            <td>
                                <h2 class="meta_title small" style="">
                                    <span>متن توضیح کوتاه بخش خدمات ما</span>
                                </h2>
                            </td>
                            <td>
                                <textarea class="full_width" type="text" name="_aboutus_settings[1st_desc]" ><?php echo $aboutus_settings['1st_desc'] ?></textarea>
                            </td>
                        </tr>
                    </table>
                    <hr>
                    <table class="options-table" style="margin-top: 20px;">
                        <tr style="margin-top: 15px;">
                            <td>
                                <h2 class="meta_title small" style="">
                                    <span>عنوان بخش تاریخچه</span>
                                </h2>
                            </td>
                            <td>
                                <input class="full_width" type="text" name="_aboutus_settings[2st_title]" value="<?php echo $aboutus_settings['2st_title'] ?>">
                            </td>
                        </tr>
                        <tr style="margin-top: 15px;">
                            <td>
                                <h2 class="meta_title small" style="">
                                    <span>متن توضیح کوتاه بخش تاریخچه</span>
                                </h2>
                            </td>
                            <td>
                                <textarea class="full_width" type="text" name="_aboutus_settings[2st_desc]" ><?php echo $aboutus_settings['2st_desc'] ?></textarea>
                            </td>
                        </tr>
                    </table>
                    <h2 class="meta_title"><span>تاریخچه</span></h2>
                    <?php
                    pmw_make_list_item( array(
                        'fields' => array(
                            'title' => array(
                                'title' => 'عنوان',
                                'type' => 'input-text',
                                'name' => '_aboutus_settings[2st_list_item][title][]',
                            ),
                            'year' => array(
                                'title' => 'سال',
                                'type' => 'input-text',
                                'name' => '_aboutus_settings[2st_list_item][year][]',
                                'placeholder' => '1395'
                            ),
                            'desc' => array(
                                'title' => 'متن توضیح',
                                'type' => 'textarea',
                                'name' => '_aboutus_settings[2st_list_item][desc][]',
                            ),
                            'image' => array(
                                'title' => 'تصویر',
                                'type' => 'image',
                                'name' => '_aboutus_settings[2st_list_item][image][]',
                            ),
                        ),
                        'items' => isset( $aboutus_settings['2st_list_item'] ) ? $aboutus_settings['2st_list_item'] : '',
                        'singular_name' => 'تاریخ',
                    ) );
                    ?>
                </div>
                <!------------------------------------------------->
                <!---------------------== single tab ==---------------------->
                <!-------------------------------------------------->
                <div id="contact-us" tab-id="contact-us">
                    <?php $cu_items = pmw_get_json_pmeta( '_contact_us_properties', $p->ID ); ?>
                </div>
                <!------------------------------------------------->
                <!---------------------== single tab ==---------------------->
                <!-------------------------------------------------->
                <div id="faq" tab-id="faq">
                    <h2 class="meta_title" style="">
                        <span>سوالات</span>
                    </h2>
                    <div class="pmw_list_items_container">
                        <div class="pmw_list_items light pm_sortable">
                            <?php
                            $faq_items = array();
                            $faq_items["title"] = get_post_meta($p->ID,'_faq_items_title');
                            $faq_items["desc"] = get_post_meta($p->ID,'_faq_items_desc');
                            if($faq_items["title"][0]){
                                foreach ($faq_items["title"][0] as $key => $name) {
                                    ?>
                                    <div class="pmw_list_item_box">
                                        <div class="pmw_list_item_options">
                                            <a class="dashicons dashicons-plus-alt add_pmw_item" title="اضافه کن"></a>
                                            <a class="dashicons dashicons-dismiss remove_pmw_item" title="حذف کن"></a>
                                        </div>
                                        <h4 class="pmw_list_item_title closed">
                                            <a class="dashicons dashicons-arrow-down-alt2"></a>
                                            <span><?php echo $name; ?></span>
                                        </h4>
                                        <div class="pmw_list_item_content">
                                            <label>سوال</label>
                                            <input type="text" name="_faq_items_title[]" value="<?php echo $name; ?>">
                                            <label>پاسخ</label>
                                            <textarea name="_faq_items_desc[]"><?php echo $faq_items["desc"][0][$key] ?></textarea>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="pmw_list_item_box">
                            <div class="pmw_list_item_options">
                                <a class="dashicons dashicons-plus-alt add_pmw_item" title="اضافه کن"></a>
                                <a class="dashicons dashicons-dismiss remove_pmw_item" title="حذف کن"></a>
                            </div>
                            <h4 class="pmw_list_item_title closed">
                                <a class="dashicons dashicons-arrow-down-alt2"></a>
                                <span>تازه</span>
                            </h4>
                            <div class="pmw_list_item_content">
                                <label>سوال</label>
                                <input type="text" hidden-name="_faq_items_title[]" value="">
                                <label>پاسخ</label>
                                <textarea hidden-name="_faq_items_desc[]"></textarea>
                            </div>
                        </div>
                        <input class="button hide-if-no-js add_new_list_item light" type="button" value="افزودن سوال">
                        <div class="clear_fix"></div>
                    </div>
                </div>
                <!------------------------------------------------->
                <!---------------------== single tab ==---------------------->
                <!-------------------------------------------------->
                <div id="default" tab-id="default">
                    <h2 class="meta_title" style="">
                        <span>لینک منتقل کننده</span>
                    </h2>
                    <div class="inputs-textareas">
                        <label>
                            عنوان لینک
                            <input type="text" name="default_page_bellow_link_title" value="<?php echo $meta['default_page_bellow_link_title'][0] ?>">
                        </label>
                        <label>
                            آدرس لینک
                            <input type="text" name="default_page_bellow_link_url" value="<?php echo $meta['default_page_bellow_link_url'][0] ?>">
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}