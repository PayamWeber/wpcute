<div id="looxBody">
	<form action="options.php" method="post" id="pmwOptionsForm">
		<?php settings_fields( 'pmw_options_settings_group' ); ?>
	    <?php do_settings_sections( 'pmw_options_settings_group' ); ?>
	    <?php 
	    	settings_errors();
	    ?>
	    <div id="looxBox">
	    	<header>
				<div class="save_pmw_options hide-if-no-js">
					<?php submit_button('ذخیره تغییرات') ?>
					<p class="save_message"></p>
					<i class="fa fa-circle-o-notch fa-spin fa-2x fa-fw"></i>
				</div>
	    		<h2>تنظیمات وب سایت دانشگاه محقق اردبیلی <small style="font-size: 8pt;position:relative;top: 3px;right: 10px;">توسط سلاک پرداز</small></h2>
	    	</header>
	    	<div id="looxWrapper">
	    		<aside>
		    		<ul>
		    			<li id="0" class="mainPageSetting">
							<div>
								<span class="dashicons dashicons-admin-settings"></span>
								<span class="title">تنظیمات عمومی</span>
							</div>
		    			</li>
		    			<li id="1" class="mainPageSetting">
							<div>
								<span class="dashicons dashicons-admin-settings"></span>
								<span class="title">صفحه اصلی</span>
							</div>
							<ul>
								<li id="1">اسلایدر</li>
								<li id="1_1">اطلاعیه ها</li>
								<li id="1_2">خدمات</li>
								<li id="1_3">همکاران</li>
							</ul>
		    			</li>
		    			<li id="2" class="headerSetting">
							<div>
								<span class="dashicons dashicons-welcome-learn-more"></span>
								<span class="title">سرصفحه</span>
							</div>
		    			</li>
		    			<li id="3" class="socialnetworkSetting">
							<div>
								<span class="dashicons dashicons-facebook"></span>
								<span class="title">شبکه های اجتماعی</span>
							</div>
		    			</li>
						<li id="4" class="footerSetting">
							<div>
								<span class="dashicons dashicons-feedback"></span>
								<span class="title">پاورقی ( footer )</span>
							</div>
                            <ul>
                                <li id="4">سایت اصلی</li>
                            </ul>
						</li>
		    		</ul>
		    	</aside>
		    	<section>
					<!--------------------------- hidden settings -->
                    <input type="hidden" class="pmw-options-request" value="<?php echo get_template_directory_uri(); ?>/requests/options.php?nonce=<?php echo wp_create_nonce('pmw-options-request-nonce') ?>">
					<!--------------------------- /hidden settings -->
                    <!--------------------------- block 0 -->
                    <div id="block-0" class="singleBlock block-0 pmw-options-request">
                        <h3 class="part_title">تنظیمات عمومی</h3>
                        <div class="singleSetting">
                            <h4 class="settingTitle">عنوان سایت</h4>
                            <input type="text" name="blogname" value="<?php echo esc_attr(get_bloginfo('name')); ?>"/>
                        </div>
                        <div class="singleSetting">
                            <h4 class="settingTitle">آدرس ایمیل</h4>
                            <input class="pmw_number" type="text" name="admin_email" value="<?php echo esc_attr(get_bloginfo('admin_email')); ?>"/>
                            <small>از این نشانی برای کارهای مدیریتی، همانند اطلاعیه کاربر تازه استفاده می‌شود.</small>
                        </div>
                    </div>
                    <!--------------------------- /block 0 -->
					<!--------------------------- block 1 -->
		    		<div id="block-1" class="singleBlock block-1">
						<h3 class="part_title">اسلایدر</h3>
						<div class="singleSetting">
							<h4 class="settingTitle">تصاویر</h4>
                            <?php
                            // mobile level items
                            $slider_images = get_nvm_settings('slider_images');

                            // show mobile levels
                            pmw_make_list_items( array(
                                'title' => array(
                                    'title' => 'عنوان',
                                    'type' => 'input-text',
                                    'name' => 'pmw_setting[slider_images][title][]',
                                ),
                                'image' => array(
                                    'title' => 'تصویر',
                                    'type' => 'image',
                                    'name' => 'pmw_setting[slider_images][image][]',
                                ),
                            ), $slider_images, 'تصویر', 'title' );
                            ?>
						</div>
		    		</div>
					<!--------------------------- /block 1 -->
					<!--------------------------- block 1_1 -->
		    		<div id="block-1_1" class="singleBlock block-1_1">
						<h3 class="part_title">اطلاعیه ها</h3>
						<div class="singleSetting">
							<h4 class="settingTitle">اطلاعیه ها زیر اسلایدر</h4>
                            <?php
                            // mobile level items
                            $slider_images = get_nvm_settings('alerts');

                            // show mobile levels
                            pmw_make_list_items( array(
                                'title' => array(
                                    'title' => 'عنوان',
                                    'type' => 'input-text',
                                    'name' => 'pmw_setting[alerts][title][]',
                                ),
                                'url' => array(
                                    'title' => 'آدرس صفحه <small>( میتوانید با نوشتن نام صفحه آدرس آن را پیدا کنید )</small>',
                                    'type' => 'input-url',
                                    'classes' => '',
                                    'name' => 'pmw_setting[alerts][url][]',
                                ),
                            ), $slider_images, 'اطلاعیه', 'title' );
                            ?>
						</div>
		    		</div>
					<!--------------------------- /block 1_1 -->
					<!--------------------------- block 1_2 -->
		    		<div id="block-1_2" class="singleBlock block-1_2">
						<h3 class="part_title">خدمات</h3>
						<div class="singleSetting">
							<h4 class="settingTitle">خدمات بالای اخبار</h4>
                            <?php
                            // mobile level items
                            $slider_images = get_nvm_settings('above_news_services');

                            // show mobile levels
                            pmw_make_list_item( array(
                            	'fields' => array(
                            		'title' => array(
	                                    'title' => 'عنوان',
	                                    'type' => 'input-text',
	                                    'name' => 'pmw_setting[above_news_services][title][]',
	                                ),
                            		'desc' => array(
	                                    'title' => 'توضیح کوتاه',
	                                    'type' => 'input-text',
	                                    'name' => 'pmw_setting[above_news_services][desc][]',
	                                ),
	                                'icon' => array(
	                                    'title' => 'نام آیکون <small> ( در سایت fontawesome.io/icons ) </small>',
	                                    'type' => 'input-text',
	                                    'name' => 'pmw_setting[above_news_services][icon][]',
	                                    'placeholder' => 'مثال: bicycle'
	                                ),
	                                'url' => array(
	                                    'title' => 'آدرس صفحه <small>( میتوانید با نوشتن نام صفحه آدرس آن را پیدا کنید )</small>',
	                                    'type' => 'input-url',
	                                    'classes' => '',
	                                    'name' => 'pmw_setting[above_news_services][url][]',
	                                )
                            	),
						        'items' => $slider_images,
						        'singular_name' => 'خدمت',
						        'first_member_name' => 'title',
                            ));
                            ?>
						</div>
		    		</div>
					<!--------------------------- /block 1_2 -->
					<!--------------------------- block 1_3 -->
		    		<div id="block-1_3" class="singleBlock block-1_3">
						<h3 class="part_title">همکاران</h3>
						<div class="singleSetting">
							<h4 class="settingTitle">لوگوی همکاران در پایین اخبار</h4>
                            <?php
                            // mobile level items
                            $slider_images = get_nvm_settings('cooperators');

                            // show mobile levels
                            pmw_make_list_item( array(
                            	'fields' => array(
                            		'title' => array(
	                                    'title' => 'عنوان',
	                                    'type' => 'input-text',
	                                    'name' => 'pmw_setting[cooperators][title][]',
	                                ),
                            		'image' => array(
	                                    'title' => 'لوگو',
	                                    'type' => 'image',
	                                    'name' => 'pmw_setting[cooperators][image][]',
	                                ),
                            	),
						        'items' => $slider_images,
						        'singular_name' => 'همکار',
						        'first_member_name' => 'title',
                            ));
                            ?>
						</div>
		    		</div>
					<!--------------------------- /block 1_3 -->
					<!--------------------------- block 2 -->
		    		<div id="block-2" class="singleBlock block-2">
						<h3 class="part_title">سرصفحه</h3>
                        <div class="singleSetting">
                            <h4 class="settingTitle">شماره تماس</h4>
                            <input class="pmw_number" type="text" name="pmw_setting[general_phone_number]" value="<?php echo esc_attr(get_nvm_settings('general_phone_number')); ?>"/>
                            <small>شماره تماس نمایشی در کنار لوگو</small>
                        </div>
		    		</div>
					<!--------------------------- /block 2 -->
					<!--------------------------- block 3 -->
					<div id="block-3" class="singleBlock block-3">
						<h3 class="part_title">شبکه های اجتماعی</h3>
						<div class="singleSetting">
							<h4 class="settingTitle">لینک صفحه تلگرام</h4>
							<input class="pmw_number" type="text" name="pmw_setting[telegram_link]" value="<?php echo esc_attr(get_nvm_settings('telegram_link')); ?>"/>
						</div>
						<div class="singleSetting">
							<h4 class="settingTitle">لینک صفحه اینستاگرام</h4>
							<input class="pmw_number" type="text" name="pmw_setting[instagram_link]" value="<?php echo esc_attr(get_nvm_settings('instagram_link')); ?>"/>
						</div>
						<div class="singleSetting">
							<h4 class="settingTitle">لینک صفحه گوگل پلاس</h4>
							<input class="pmw_number" type="text" name="pmw_setting[googleplus_link]" value="<?php echo esc_attr(get_nvm_settings('googleplus_link')); ?>"/>
						</div>
						<div class="singleSetting">
							<h4 class="settingTitle">لینک صفحه فیسبوک </h4>
							<input class="pmw_number" type="text" name="pmw_setting[facebook_link]" value="<?php echo esc_attr(get_nvm_settings('facebook_link')); ?>"/>
						</div>
						<div class="singleSetting">
							<h4 class="settingTitle">لینک صفحه آپارات </h4>
							<input class="pmw_number" type="text" name="pmw_setting[aparat_link]" value="<?php echo esc_attr(get_nvm_settings('aparat_link')); ?>"/>
						</div>
					</div>
					<!--------------------------- /block 3 -->
					<!--------------------------- block 4 -->
					<div id="block-4" class="singleBlock block-4">
						<h3 class="part_title">پاورقی</h3>
						<div class="singleSetting">
							<h4 class="settingTitle">متن درباره ما</h4>
							<textarea name="pmw_setting[footer_aboutus_text]"><?php echo esc_textarea(get_nvm_settings('footer_aboutus_text')); ?></textarea>
						</div>
						<div class="singleSetting">
							<h4 class="settingTitle">آدرس کامل</h4>
							<textarea name="pmw_setting[footer_full_address]"><?php echo esc_textarea(get_nvm_settings('footer_full_address','')); ?></textarea>
						</div>
						<div class="singleSetting">
							<h4 class="settingTitle">تلفن تماس</h4>
							<input class="pmw_number" type="text" name="pmw_setting[footer_phone_number]" value="<?php echo esc_attr(get_nvm_settings('footer_phone_number','021 778899')); ?>"/>
						</div>
						<div class="singleSetting">
							<h4 class="settingTitle">فکس</h4>
							<input class="pmw_number" type="text" name="pmw_setting[footer_fax_number]" value="<?php echo esc_attr(get_nvm_settings('footer_fax_number','2255447788')); ?>"/>
						</div>
						<div class="singleSetting">
							<h4 class="settingTitle">کد پستی</h4>
							<input class="pmw_number" type="text" name="pmw_setting[footer_pcode_number]" value="<?php echo esc_attr(get_nvm_settings('footer_pcode_number','17722331199')); ?>"/>
						</div>
                        <div class="singleSetting">
                            <h4 class="settingTitle">ایمیل</h4>
                            <input class="pmw_number" type="text" name="pmw_setting[footer_email_address]" value="<?php echo esc_attr(get_nvm_settings('footer_email_address','info@site.com')); ?>"/>
                        </div>
                        <div class="singleSetting">
                            <h4 class="settingTitle">دسترسی سریع</h4>
                            <?php
                            // mobile level items
                            $slider_images = get_nvm_settings('footer_quick_access');

                            // show mobile levels
                            pmw_make_list_item( array(
                            	'fields' => array(
                            		'title' => array(
	                                    'title' => 'عنوان',
	                                    'type' => 'input-text',
	                                    'name' => 'pmw_setting[footer_quick_access][title][]',
	                                ),
	                                'url' => array(
	                                    'title' => 'آدرس صفحه <small>( میتوانید با نوشتن نام صفحه آدرس آن را پیدا کنید )</small>',
	                                    'type' => 'input-url',
	                                    'classes' => 'pmw_number',
	                                    'name' => 'pmw_setting[footer_quick_access][url][]',
	                                )
                            	),
						        'items' => $slider_images,
						        'singular_name' => 'لینک',
						        'first_member_name' => 'title',
                            ));
                            ?>
                        </div>
					</div>
					<!--------------------------- /block 4 -->
					<!--------------------------- block 5 -->
					<div id="block-5" class="singleBlock block-5">
						<h3 class="part_title">نوار کناری ( جعبه دانلود )</h3>
						<div class="singleSetting setting_color_red">
							<h4 class="settingTitle">عنوان</h4>
							<input type="text" name="pmw_setting[sidebar_file_title]" value="<?php echo esc_attr(get_nvm_settings('sidebar_file_title')); ?>"/>
						</div>
						<div class="singleSetting setting_color_red">
							<h4 class="settingTitle">فایل</h4>
							<span class="big_image_preview" id="preview_sidebar_file1" style="max-width: 50%;height: auto;">
								<p>
									نام فایل : <?php echo basename(get_attached_file(intval(get_nvm_settings('sidebar_file_link')))); ?>
									<br>
									حجم : <span><?php echo pmw_filesize_convert(filesize(get_attached_file(intval(get_nvm_settings('sidebar_file_link'))))); ?></span>
								</p>
							</span>
							<input type="hidden" name="pmw_setting[sidebar_file_link]" value="<?php echo get_nvm_settings('sidebar_file_link') ?>" class="dl_url_id" id="upload_sidebar_1">
							<button class="button big_image_upload" upload-type="file">آپلود فایل</button>
						</div>
					</div>
					<!--------------------------- /block 5 -->
                    <!--------------------------- block 4_2 -->
                    <div id="block-4_2" class="singleBlock block-4_2">
                        <h3 class="part_title">پاورقی وبلاگ</h3>
                        <div class="singleSetting">
                            <h4 class="settingTitle">لینک های مفید در پایین وبلاگ</h4>
                            <div class="items_body">
                                <?php
                                $useful_links = get_nvm_settings('useful_links');
                                $useful_names = get_nvm_settings('useful_names');
                                if($useful_names){
                                    foreach ($useful_names as $key => $item) {
                                        ?>
                                        <div class="prop_div">
                                            <label>عنوان</label>
                                            <input type="text" name="pmw_setting[useful_names][]" value="<?php echo esc_attr($item); ?>">
                                            <label>لینک</label>
                                            <input type="text" name="pmw_setting[useful_links][]" value="<?php echo esc_attr($useful_links[$key]); ?>">
                                            <input class="button remove_this_item hide-if-no-js custom_remove_this_item_1" type="button" value="حذف">
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="prop_div">
                                <label>عنوان</label>
                                <input class="useful_names" type="text" value="">
                                <label>لینک</label>
                                <input class="useful_links" type="text" value="">
                                <input class="button remove_this_item hide-if-no-js custom_remove_this_item_1" type="button" value="حذف">
                            </div>
                            <input class="button hide-if-no-js add_note_btn" add-type="link" type="button" value="افزودن لینک" add-new-name="pmw_setting[useful_names][]" add-new-link="pmw_setting[useful_links][]">
                        </div>
                    </div>
                    <!--------------------------- /block 4_2 -->
                    <!--------------------------- block 7 -->
                    <div id="block-7" class="singleBlock block-7">
                        <h3 class="part_title">صفحه اصلی وبلاگ</h3>
                        <div class="singleSetting">
                            <h4 class="settingTitle">تعداد مطالب نمایشی در صفحه اصلی وبلاگ</h4>
                            <input class="pmw_number" type="text" name="pmw_setting[blog_number_of_posts]" value="<?php echo esc_attr(get_nvm_settings('blog_number_of_posts','12')); ?>"/>
                        </div>
                    </div>
                    <!--------------------------- /block 7 -->
		    	</section>
	    	</div>
	    	<footer>
				<div class="save_pmw_options hide-if-no-js">
					<?php submit_button('ذخیره تغییرات') ?>
					<p class="save_message"></p>
					<i class="fa fa-circle-o-notch fa-spin fa-2x fa-fw"></i>
				</div>
	    	</footer>
	    </div>
	</form>
</div>
