<div class="section _section section--feature {{{ settings.style == '360' ? 'section--360' : '' }}} {{{ settings.dark_mode == 'yes' ? 'bg-black' : '' }}}"
     data-menu-section
     data-icon="{{{ settings.section_icon.url }}}"
     data-hash="{{{ settings.section_hashtag }}}">
    <div class="section-wrap {{{ settings.dark_mode == 'yes' ? 'pad-lg' : '' }}}">
        {{{ settings.dark_mode == 'yes' ? '<div class="darkness">' : '' }}}
        <article class="flip {{{ settings.reverse_mode == 'yes' ? 'flip--left' : '' }}} flip--center">
            <div class="flip-wrap">
                {{{ settings.dark_mode == 'yes' ? '<div class="darkness-wrap">' : '' }}}
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
                <# if( settings.main_desc ){ #>
                    <div class="post">{{{ settings.main_desc  }}}</div>
                <# } #>
                <# if( settings.items_style == 'three' && settings.items ){ #>
                    <ul class="bus bus--center bus--3">
                        <# _.each( settings.items, function( item, index ) { #>
                            <li>
                                <div class="card-f card-f--vertical {{{ settings.dark_mode == 'yes' ? 'card-f--light' : '' }}}">
                                    <img class="card-f__img" src="{{{ item.image[ 'url' ] }}}"/>
                                    <p class="card-f__title">{{{ item.title }}}</p>
                                </div>
                            </li>
                        <# }) #>
                    </ul>
                <# }else if( settings.items_style == 'one' && settings.items ){ #>
                    <ul>
                        <# _.each( settings.items, function( item, index ) { #>
                            <li>
                                <div class="card-f card-f--smicon {{{ settings.dark_mode == 'yes' ? 'card-f--light' : '' }}}">
                                    <img class="card-f__img" src="{{{ item.image.url }}}"/>
                                    <div class="card-f__wrap">
                                        <div class="card-f__title">{{{ item.title }}}</div>
                                        <p class="card-f__desc">{{{ item.desc  }}}</p>
                                    </div>
                                </div>
                            </li>
                        <# }) #>
                    </ul>
                <# }else if( settings.items_style == 'two' && settings.items ){ #>
                    <ul class="bus {{{ settings.dark_mode == 'yes' ? 'bus--white' : '' }}} bus--bottom bus--2">
                        <# _.each( settings.items, function( item, index ) { #>
                            <li>
                                <div class="card-f card-f--vertical card-f--right {{{ settings.dark_mode == 'yes' ? 'card-f--light' : '' }}}">
                                    <img class="card-f__img" src="{{{ item.image.url }}}"/>
                                    <p class="card-f__title">{{{ item.title }}}</p>
                                    <p class="card-f__desc">{{{ item.desc  }}}</p>
                                </div>
                            </li>
                        <# }) #>
                    </ul>
                <# } #>
                <div class="flip-empty"></div>
                {{{ settings.dark_mode == 'yes' ? '</div>' : '' }}}
            </div>
            <div class="flip-alone {{{ settings.style == 'item_image' ? 'ltr' : '' }}}">
                <# if( settings.style == '360' ){ #>
                    <div class="spin-slider"
                         data-spin-slider>
                        <div class="loading loading--blue"></div>
                    </div>
                <# } else if( settings.style == 'item_image' ){ #>
                    <div class="features-image features-image--400">
                        <img class="features-image__img" src="{{{ settings.main_image.url }}}">
                    </div>
                <# } #>
            </div>
        </article>
        {{{ settings.dark_mode == 'yes' ? '</div>' : '' }}}
    </div>
</div>