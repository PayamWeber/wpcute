<# if( settings.items ){ #>
    <section class="section section--gallery {{{ settings.gray_mode == 'yes' ? 'bg-f7' : '' }}} _section"
        <div class="section-wrap _section">
            <# if( settings.main_title || settings.main_subtitle ){ #>
                <header class="s-header">
                    <# if( settings.main_title ){ #>
                        <h2 class="s-title">{{{ settings.main_title }}}</h2>
                    <# } #>
                    <# if( settings.main_subtitle ){ #>
                        <p class="s-subtitle">{{{ settings.main_subtitle }}}</p>
                    <# } #>
                </header>
            <# } #>
            <div class="section-body">
                <div class="gallery" data-gallery id="gallery">
                    <# _.each( settings.items, function( item, index ) { #>
                        <div class="gallery-item {{{ item.show_video == 'yes' ? 'gallery-item--video' : '' }}}">
                            <a data-fancybox="gallery"
                               style="background-image: url({{{ item.image.url }}})">
                                <# if( item.show_video == 'yes' ){ #>
                                    <button class="gallery-play">
                                        <svg class="icon icon--play">
                                            <use xlink:href="<?= ConfigHelper::get( 'sprite' ) ?>#play"></use>
                                        </svg>
                                    </button>
                                <# } #>
                            </a>
                            <# if( item.show_pin == 'yes' ){ #>
                                <div class="gallery-tool"
                                     style="top:{{{ item.pin_top }}}%;left:{{{ item.pin_left }}}%;"
                                     data-tooltip="{{{ item.pin_text }}}">
                                    <div class="gallery-feature">
                                        <svg class="icon icon--plus">
                                            <use xlink:href="<?= ConfigHelper::get( 'sprite' ) ?>#plus"></use>
                                        </svg>
                                    </div>
                                </div>
                            <# } #>
                        </div>
                    <# }) #>
                </div>
            </div>
            <# if( settings.show_button == 'yes' ){ #>
                <footer class="section-footer">
                    <a href="{{{ settings.button_url }}}" class="btn btn--xlg">{{{ settings.button_text }}}</a>
                </footer>
            <# } #>
        </div>
    </section>
<# } #>