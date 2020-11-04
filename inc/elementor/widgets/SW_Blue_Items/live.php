<div class="section _section">
    <div class="agency">
        <div class="agency-col">
            <div class="agency-wrap">
                <img class="agency-image" src="{{{ settings.image1.url }}}" alt="{{{ settings.title1 }}}">
                <div>
                    <div class="agency-title">{{{ settings.title1 }}}</div>
                    <div class="agency-desc">{{{ settings.desc1  }}}</div>
                    <# if( settings.show_button1 == 'yes' ){ #>
                        <div class="agency-btn">
                            <a href="{{{ settings.button_url1.url }}}" class="btn btn--md btn--wide2 btn--solid-blue">{{{ settings.button_text1 }}}</a>
                        </div>
                    <# } #>
                </div>
            </div>
        </div>
        <div class="agency-col">
            <div class="agency-wrap">
                <img class="agency-image" src="{{{ settings.image2.url }}}" alt="{{{ settings.title2 }}}">
                <div>
                    <div class="agency-title">{{{ settings.title2 }}}</div>
                    <div class="agency-desc">{{{ settings.desc2  }}}</div>
                    <# if( settings.show_button2 == 'yes' ){ #>
                        <div class="agency-btn">
                            <a href="{{{ settings.button_url2.url }}}" class="btn btn--md btn--wide2 btn--solid-blue">{{{ settings.button_text2 }}}</a>
                        </div>
                    <# } #>
                </div>
            </div>
            <# if( settings.show_items == 'yes' && settings.items ){ #>
                <div class="agency-services">
                    <ul class="bus bus--center">
                        <# _.each( settings.items, function( item, index ) { #>
                            <li>
                                <div class="card-services">
                                    <img class="card-services__image" src="{{{ item.image.url }}}">
                                    <div class="card-services__title">{{{ item.title }}}</div>
                                    <div class="card-services__desc">{{{ item.desc  }}}</div>
                                </div>
                            </li>
                        <# }) #>
                    </ul>
                </div>
            <# } #>
        </div>
    </div>
</div>