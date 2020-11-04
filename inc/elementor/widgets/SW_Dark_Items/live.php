<div class="section bg-gray3"
     data-menu-section
     data-icon="{{{ settings.section_icon[ 'url' ] }}}"
     data-hash="{{{ settings.section_hashtag }}}">
    <div class="section-wrap">
        <div class="inbox">
            <div class="inbox-side">
                <# if( settings.main_title || settings.main_subtitle ){ #>
                    <header class="s-header mb-40">
                        <# if( settings.main_title ){ #>
                            <h2 class="s-title">{{{ settings.main_title }}}</h2>
                        <# } #>
                        <# if( settings.main_subtitle ){ #>
                            <p class="s-subtitle">{{{ settings.main_subtitle }}}</p>
                        <# } #>
                    </header>
                <# } #>
                <# if( settings.items ){ #>
                    <# _.each( settings.items, function( item, index ) { #>
                        <div class="card-f">
                            <img class="card-f__img" src="{{{ item.image.url }}}">
                            <div class="card-f__wrap">
                                <p class="card-f__title">{{{ item.title }}}</p>
                                <div class="card-f__desc">
                                    {{{ item.desc  }}}
                                </div>
                            </div>
                        </div>
                    <# }) #>
                <# } #>
            </div>
            <div class="inbox-center">
                <img class="inbox-image" src="{{{ settings.main_image.url }}}" alt="{{{ settings.main_title }}}">
            </div>
        </div>
    </div>
</div>
