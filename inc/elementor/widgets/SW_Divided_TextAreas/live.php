<div class="section _section bg-gray4">
    <div class="agency agency--gray">
        <div class="agency-col">
            <div class="agency-wrap">
                <div class="agency-content">
                    {{{ settings.desc1  }}}
                </div>
            </div>
        </div>
        <div class="agency-col">
            <div class="agency-wrap">
                <div class="agency-content">
                    {{{ settings.desc2  }}}
                </div>
            </div>
            <# if( settings.show_button == 'yes' ){ #>
                <div class="agency-btn">
                    <a href="{{{ settings.button_url.url }}}" class="btn btn--wide2 btn--lg">{{{ settings.button_text }}}</a>
                </div>
            <# } #>
        </div>
    </div>
</div>