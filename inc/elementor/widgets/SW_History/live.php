<article class="section section-story" data-menu-section data-icon="{{{ settings.section_icon.url }}}" data-hash="{{{ settings.section_hashtag }}}">
    <div class="section-wrap pad-lg">
        <header class="s-header">
            <h2 class="s-title">{{{ settings.main_title }}}</h2>
            <p class="s-subtitle">{{{ settings.main_subtitle }}}</p>
        </header>
        <div class="section-body">
            <div class="flip">
                <div class="flip-wrap">
                    <div class="post">
                        {{{ settings.main_desc  }}}
                    </div>
                    <div class="flip-empty"></div>
                    <div class="section-story__btn">
                        <button class="btn">{{{ settings.btn_label }}}</button>
                    </div>
                </div>

                <div class="flip-alone">
                    <div class="section-story__properties">
                        <div class="row row--15-80">
                            <# _.each( settings.items, function( item, index ) { #>
                                <div class="col-xs-12">
                                    <div class="card-properties">
                                        <img class="calendar" src="{{{ item.image.url }}}" alt="">
                                        <p>{{{ item.title }}}</p>
                                        <div><b class="counter" data-num="{{{ item.value }}}">{{{ item.value }}}</b><span>{{{ item.prefix }}}</span></div>
                                    </div>
                                </div>
                            <# }); #>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</article>
