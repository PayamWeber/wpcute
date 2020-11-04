<div class="section">
    <div class="card-video">
        <# if( settings.main_title || settings.main_subtitle || settings.main_content_text ){ #>
            <div class="section-wrap pad-lg">
                <div class="card-video__content">
                    <div class="card-video__info">
                        <# if( settings.main_title ){ #>
                            <h3 class="card-video__title">{{{ settings.main_title }}}</h3>
                        <# } #>
                        <# if( settings.main_subtitle ){ #>
                            <p class="card-video__subtitle">{{{ settings.main_subtitle }}}</p>
                        <# } #>
                        <# if( settings.main_content_text ){ #>
                            <div class="card-video__text post">
                                <p>{{{ settings.main_content_text  }}}</p>
                            </div>
                        <# } #>
                    </div>
                </div>
            </div>
        <# } #>
        <div class="card-video__preview videoplayer" style="background-image: url({{{ settings.background_image.url }}})">
            <# if( settings.show_video == 'yes' ){ #>
                <div class="videoplayer-frame">
                    <video controls>
                        <source src="{{{ settings.video_url.url }}}" type="video/mp4">
                        Sorry, your browser doesn't support embedded videos.
                    </video>
                </div>
            <# } #>
            <div class="loading loading--blue"></div>
            <# if( settings.show_video == 'yes' ){ #>
                <button class="videoplayer-play">
                    <svg class="icon icon--play">
                        <use xlink:href="<?= ConfigHelper::get('sprite') ?>#play"></use>
                    </svg>
                </button>
            <# } #>
        </div>
    </div>
</div>
