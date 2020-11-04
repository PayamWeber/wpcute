<div class="_section section overview">
    <div class="overview-col"  data-parallax>
        <# if( settings.main_desc_center !== '' ){ #>
        <div class="overview-quote" data-parallax-bg data-factor="40">
            <div class="overview-quotetext">
                <svg><use xlink:href="<?= ConfigHelper::get('sprite') ?>#quote3"></use></svg>
                <svg><use xlink:href="<?= ConfigHelper::get('sprite') ?>#quote3"></use></svg>
                <p>{{{ settings.main_desc_center }}}</p>
            </div>
            <div class="overview-quotename">
                <p>{{{ settings.main_title_center }}}</p>
                <span>{{{ settings.second_title_center }}}</span>
            </div>
        </div>
        <# } #>
        <div class="overview-wrap">
            <div class="card-f">
                <img class="card-f__img" src="{{{ settings.main_image_right.url }}}">
                <div class="card-f__wrap">
                    <div class="card-f__title">{{{ settings.main_title_right }}}</div>
                    <div class="card-f__desc">{{{ settings.main_desc_right  }}}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="overview-col">
        <div class="overview-wrap">
            <div class="card-f">
                <img class="card-f__img" src="{{{ settings.main_image_left.url }}}">
                <div class="card-f__wrap">
                    <div class="card-f__title">{{{ settings.main_title_left }}}</div>
                    <div class="card-f__desc">{{{ settings.main_desc_left  }}}</div>
                </div>
            </div>
        </div>
    </div>
</div>