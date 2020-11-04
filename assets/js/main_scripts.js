(function($){

    $(function(){

        $(".hoverBox1 a").mouseenter(
                function () {
                    $(this).find('i').css('background-position', '99px 86px');
                }
        ).mouseleave(
                function () {
                    $(this).find('i').css('background-position', '99px 170px');
                }
        );

        $(".hoverBox2 a").mouseenter(
                function () {
                    $(this).find('i').css('background-position', '-645px 83px');
                }
        ).mouseleave(
                function () {
                    $(this).find('i').css('background-position', '-645px 167px');
                }
        );

        $(".hoverBox3 a").mouseenter(
                function () {
                    $(this).find('i').css('background-position', '-354px 83px');
                }
        ).mouseleave(
                function () {
                    $(this).find('i').css('background-position', '-354px 166px');
                }
        );

        $(".hoverBox4 a").mouseenter(
                function () {
                    $(this).find('i').css('background-position', '-50px 83px');
                }
        ).mouseleave(
                function () {
                    $(this).find('i').css('background-position', '-50px 166px');
                }
        );

    });

})(jQuery);















// PayamWeber scripts
$(document).ready(function() {

});

