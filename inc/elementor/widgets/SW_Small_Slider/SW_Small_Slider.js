var html = '';
var _counter = 1;

html += '<div class="section ' + ( settings.gray_bg == 'yes' ? 'bg-f7' : '' ) + '">\n';
    html += '<div class="section-wrap section-wrap--posr pad-lg">\n';
        html += '<div class="section-bg section-bg--' + ( settings.reverse_direction == 'yes' ? 'va' : 'ref' ) + '" style="background-image:url(' + settings.background_image.url + ')"></div>\n';
        html += '<article class="flip flip--' + ( settings.reverse_direction == 'yes' ? 'left' : 'center' ) + ' card-a">\n';
            html += '<div class="flip-wrap">\n';
                html += '<div class="card-a__content">\n';
                    html += '<header class="card-a__header">\n';
                        html += '<h2 class="card-a__title">' + settings.main_title + '</h2>\n';
                        html += '<p class="card-a__subtitle">' + settings.main_subtitle + '</p>\n';
                    html += '</header>\n';
                    html += '<div class="card-a__body">\n';
                        html += '<p>' + settings.main_content_text + '</p>\n';
                    html += '</div>\n';
                    html += '<div class="flip-empty"></div>\n';
                    if ( settings.show_button == 'yes' )
                    {
                        html += '<div class="card-a__btn">\n';
                            html += '<a href="" class="btn btn--xlg btn--shadow">\n';
                                html += settings.button_text;
                            html += '</a>\n';
                        html += '</div>\n';
                    }
                html += '</div>\n';
            html += '</div>\n';
            html += '<div class="flip-alone">\n';
                html += '<div class="row row--10">\n';
                    html += '<div class="col-xs-24">\n';
                        html += '<div class="card-a__slider">\n';
                            html += '<div class="swiper-container">\n';
                                html += '<div class="swiper-wrapper">\n';
                                    _.each( settings.slider_images, function ( item ) {
                                        html += '<div class="swiper-slide" style="background-image: url(' + item.image.url + ')"></div>\n';
                                    })
                                html += '</div>\n';
                                html += '<div class="swiper-pagination"></div>\n';
                            html += '</div>\n';
                        html += '</div>\n';
                    html += '</div>\n';
                    _.each( settings.images, function ( item ) {
                        html += '<div class="col-xs-12">\n';
                            html += '<div class="card-a__preview" style="background-image: url(' + item.image.url + ')"></div>\n';
                        html += '</div>\n';
                    })
                html += '</div>\n';
            html += '</div>\n';
        html += '</article>\n';
    html += '</div>\n';
html += '</div>\n';

print( html );