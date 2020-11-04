<section class="section _section bg-f7"
         data-menu-section
         data-icon="{{{ settings.section_icon.url }}}"
         data-hash="{{{ settings.section_hashtag }}}">
    <div class="section-wrap section-wrap--posr pad-md">
        <div class="section-bg section-bg--va" style="background-image:url('{{{ settings.main_image.url }}}')"></div>
        <# if( settings.main_title || settings.main_subtitle ){ #>
            <header class="s-header mb-70">
                <# if( settings.main_title ){ #>
                    <h2 class="s-title">{{{ settings.main_title }}}</h2>
                <# } #>
                <# if( settings.main_subtitle ){ #>
                    <p class="s-subtitle">{{{ settings.main_subtitle }}}</p>
                <# } #>
            </header>
        <# } #>
        <div class="section-body">
            <ul class="features">
                <# _.each( settings.items, function( item, index ) { #>
                    <li>
                        <div class="card-f card-f--vertical">
                            <img class="card-f__img" src="{{{ item.image.url }}}">
                            <p class="card-f__title">{{{ item.title }}}</p>
                            <div class="card-f__desc">{{{ item.desc }}}</div>
                        </div>
                    </li>
                <# }) #>
            </ul>
        </div>
    </div>
</section>