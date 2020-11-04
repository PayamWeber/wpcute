<div class="section">
    <div class="temperature">
        <div class="temperature-wrap">
            <div class="temperature-content">
                <# if( settings.main_title || settings.main_subtitle ){ #>
                    <header class="s-header">
                        <h2 class="s-title">{{{ settings.main_title }}}</h2>
                        <p class="s-subtitle">{{{ settings.main_subtitle }}}</p>
                    </header>
                <# } #>
                <# if( settings.main_desc ){ #>
                    <div>
                        {{{ settings.main_desc  }}}
                    </div>
                <# } #>
            </div>
            <div class="temperature-main">
                <div class="temperature-circle">
                    <canvas class="temperature-progress" id="myCanvas" width="640" height="640" data-colorStart="rgb(0,190,230)" data-colorStrokeStart="rgb(232,251,255)" data-colorEnd="rgb(255,43,0)"></canvas>
                    <ul class="temperature-image" data-min="{{{ settings.minimum ? settings.minimum : '50' }}}" data-max="{{{ settings.maximum ? settings.maximum : '200' }}}">
                        <?php for ( $x = 0; $x < 36; $x++ ) { ?>
                            <li></li>
                        <?php } ?>
                    </ul>
                    <div class="temperature-imagebg" data-colorStart="rgb(242,242,242)" data-colorEnd="rgb(255,243,201)"></div>
                    <div class="temperature-handle">
                        <svg>
                            <use xlink:href="<?= ConfigHelper::get('sprite') ?>#handle"></use>
                        </svg>
                    </div>
                </div>
                <div class="temperature-counter celsius">
                    <svg>
                        <use xlink:href="<?= ConfigHelper::get('sprite') ?>#celsius"></use>
                    </svg>
                    <span></span>
                </div>
                <div class="temperature-counter fahrenheit">
                    <svg>
                        <use xlink:href="<?= ConfigHelper::get('sprite') ?>#fahrenheit"></use>
                    </svg>
                    <span></span>
                </div>
            </div>
        </div>
    </div>
</div>