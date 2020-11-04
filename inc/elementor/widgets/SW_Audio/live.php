<div class="section _section pad-lg"
     data-menu-section
     data-icon="{{{ settings.section_icon.url }}}"
     data-hash="{{{ settings.section_hashtag }}}">
    <div class="section-wrap pad-0">
        <div class="visualization">
            <div class="visualization-content">
                <# if( settings.main_title || settings.main_subtitle ){ #>
                    <header class="s-header">
                        <h2 class="s-title">{{{ settings.main_title }}}</h2>
                        <p class="s-subtitle">{{{ settings.subtitle_style == 'text' ? settings.main_subtitle : '<img src="' + settings.main_subtitle_image.url + '">' }}}</p>
                    </header>
                <# } #>
                <# if( settings.main_desc ){ #>
                    <div>
                        {{{ settings.main_desc  }}}
                    </div>
                <# } #>
            </div>
            <div class="visualization-main">
                <button class="visualization-btn plus">
                    <svg>
                        <use xlink:href="<?= ConfigHelper::get('sprite') ?>#plus"></use>
                    </svg>
                </button>
                <button class="visualization-btn minus">
                    <svg>
                        <use xlink:href="<?= ConfigHelper::get('sprite') ?>#minus"></use>
                    </svg>
                </button>
                <ul class="visualization-image">
                    <?php for ( $x = 0; $x < 60; $x++ ) { ?>
                        <li>
                            <i>
                                <span></span>
                            </i>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>