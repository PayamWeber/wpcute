<div class="section {{{ settings.gray_bg == 'yes' ? 'bg-f7' : '' }}}">
    <div class="section-wrap section-wrap--posr pad-lg">
        <div class="section-bg section-bg--{{{ settings.reverse_direction == 'yes' ? 'va' : 'ref' }}}" style="background-image:url('{{{ settings.background_image.url }}}')"></div>
        <article class="flip flip--{{{ settings.reverse_direction == 'yes' ? 'left' : 'center' }}} card-a">
            <div class="flip-wrap">
                <div class="card-a__content">
                    <header class="card-a__header">
                        <# if( settings.main_title ){ #>
                            <h2 class="card-a__title">{{{ settings.main_title }}}</h2>
                        <# } #>
                        <# if( settings.main_subtitle ){ #>
                            <p class="card-a__subtitle">{{{ settings.main_subtitle }}}</p>
                        <# } #>
                    </header>
                    <div class="card-a__body">
                        <# if( settings.main_content_text ){ #>
                            <p>{{{ settings.main_content_text  }}}</p>
                        <# } #>
                    </div>
                    <div class="flip-empty"></div>
                    <# if( settings.show_button == 'yes' ){ #>
                        <div class="card-a__btn">
                            <a href="{{{ settings.button_url.url }}}" class="btn btn--xlg btn--shadow">
                                {{{ settings.button_text }}}
                            </a>
                        </div>
                    <# } #>
                </div>
            </div>
            <div class="flip-alone">
                <div class="row row--10 row--10-xs">
                    <# if( settings.slider_images ){ #>
                        <div class="col-xs-24">
                            <div class="card-a__slider">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <# _.each( settings.slider_images, function( item, index ) { #>
                                            <div class="swiper-slide" style="background-image: url({{{ item.image.url }}})"></div>
                                        <# }) #>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                    <# } #>
                    <# if( settings.images ){ #>
                        <# _.each( settings.images, function( item, index ) { #>
                            <div class="col-xs-12">
                                <div class="card-a__preview" style="background-image: url({{{ item.image.url }}})"></div>
                            </div>
                        <# }) #>
                    <# } #>
                </div>
            </div>
        </article>
    </div>
</div>
