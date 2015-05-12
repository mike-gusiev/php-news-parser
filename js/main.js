(function ($) {

    window.validateForm = function (form) {
        var result = true;

        var inputs = $(form).find('input');

        $.each(inputs, function () {
            if( $(this).attr('id') == 'InputDBPass' || $(this).attr('id') == 'InputID' ) return;

            if( $(this).val() == '' ) {
                $(this).parent().addClass('has-error');
                result = false;

                $(this).on('click.validator', function () {
                    $(this).parent().removeClass('has-error');
                    $(this).unbind('.validator');
                })
            }
        });

        var selects = $(form).find('select');

        $.each(selects, function () {
            if( $(this).val() == null ) {
                $(this).parent().addClass('has-error');
                result = false;

                $(this).on('click.validator', function () {
                    $(this).parent().removeClass('has-error');
                    $(this).unbind('.validator');
                })
            }
        });

        return result;
    }

    $(document).ready(function () {
        if( $('.btn-group.vtype input:checked').val() == 1 && $('#news_list').length) {

            var container = document.querySelector('#news_list');
            $(container).masonry({itemSelector: '.news-tile'});

        }
    });

    $(window).on('load', function () {
        if( $('.btn-group.vtype input:checked').val() == 1 && $('#news_list').length) {

            var container = document.querySelector('#news_list');
            $(container).masonry();

        }
    });

})(jQuery);