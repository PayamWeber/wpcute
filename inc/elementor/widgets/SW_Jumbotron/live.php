<div class="jumbotron pad-md {{{ settings.style != 'image_only' ? 'jumbotron--' + settings.style : '' }}}"
     data-parallax
     data-full-vh
     data-menu-section
     data-icon="{{{ settings.section_icon.url }}}"
     data-hash="{{{ settings.section_hashtag }}}">
    <div class="jumbotron-bg" data-parallax-bg style="background-image: url('{{{ settings.main_image.url }}}')"></div>
    <div class="jumbotron-footer">
        <# if( settings.style == 'feature' ){ #>
            <# if( settings.items ){ #>
                <ul class="bus">
                    <# _.each( settings.items, function( item, index ) { #>
                        <li>
                            <div class="card-f card-f--light">
                                <img class="card-f__img" src="{{{ item.image.url }}}"/>
                                <div class="card-f__wrap">
                                    <h4 class="card-f__title">{{{ item.title }}}</h4>
                                    <div class="card-f__desc">{{{ item.desc  }}}</div>
                                </div>
                            </div>
                        </li>
                    <# }) #>
                </ul>
            <# } #>
        <# }else if( settings.style == 'desc' ){ #>
            <div class="s-header">
                <h3 class="s-title">{{{ settings.main_title }}}</h3>
                <p class="s-subtitle">{{{ settings.main_subtitle }}}</p>
            </div>
            <div class="post">{{{ settings.main_desc  }}}</div>
        <# } #>
    </div>
</div>
