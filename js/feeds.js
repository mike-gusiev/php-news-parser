(function ($) {

    var pathArr = location.pathname.split('feeds');
    var trimPath = pathArr[0] + 'feeds';

    //скрываем или показываем форму добавления сайта
    window.hideForm = function (type) {

        $('.feed-info2')
            .html( $('.feed-info').html() )
            .addClass('invisible');

        $('.add-feed-status').html('');

        var form = $('.add-form')[0];

        if(type == 1) {
            if($(form).hasClass('hidden')) {
                $(form).removeClass('hidden');
                $('#btn-cancel-feed').removeClass('hidden');
                $('#btn-edit-feed').addClass('hidden');
                $('#btn-add-feed').removeClass('hidden');
            }
        } else {
            $(form).addClass('hidden');
            $('#btn-cancel-feed').addClass('hidden');
            $('#btn-edit-feed').addClass('hidden');
            $('#btn-add-feed').removeClass('hidden');
        }
    };

    //доп. меню - Изменить ленту
    window.editFeed = function (id, obj) {
        $(obj).parents('tr').find('.feed-info').removeClass('invisible');

        $.ajax({
            type: "POST",
            url: trimPath + '/edit_get',
            data: 'id='+id
        })
            .done(function( msg ) {

                var answer = JSON.parse(msg);
                if(answer.success == false) {
                    location.href = trimPath + '?opp=fail'
                }

                $('#InputID').val(answer.feed.id);
                $('#InputName').val(answer.feed.name);
                $('#InputRSS').val(answer.feed.rss);

                hideForm(1);
                $('#btn-edit-feed').removeClass('hidden');
                $('#btn-add-feed').addClass('hidden');

                $(obj).parents('tr').find('.feed-info').addClass('invisible');

            });
    }

    //доп.меню - Удалить ленту
    window.delFeed = function (id) {
        hideForm(0);

        $.ajax({
            type: "POST",
            url: trimPath + '/del',
            data: 'id='+id
        })
            .done(function( msg ) {
                if(parseInt(msg)) {
                    location.href = trimPath + '?opp=success';
                } else {
                    location.href = trimPath + '?opp=fail';
                }
            });
    }

    $(document).ready(function () {
        //нажатие кнопки "добавить ленту"
        $('#btn-add-feed').click(function () {
            var form = $('.add-form')[0];

            if($(form).hasClass('hidden')) {
                hideForm(1);
            } else {
                $('.add-feed-status').html( $('.feed-info').html() ); //картинка fbloader.gif

                if(validateForm(form) == false) {
                    $('.add-feed-status').html('Неверно заполенны поля!');
                } else {

                    $.ajax({
                        type: "POST",
                        url: trimPath + '/add',
                        data: $('#add_feed').serialize()
                    })
                        .done(function( msg ) {
                            if(parseInt(msg)) {
                                location.href = trimPath + '?opp=success';
                            } else {
                                location.href = trimPath + '?opp=fail';
                            }
                        });
                }
            }

        });

        //нажатие кнопки "изменить ленту"
        $('#btn-edit-feed').click(function () {
            var form = $('.add-form')[0];

            $('.add-feed-status').html( $('.feed-info2').html() ); //картинка fbloader.gif

            if(validateForm(form) == false) {
                var form = $('.add-form')[0];

                $('.add-feed-status').html('Неверно заполенны поля!');
            } else {

                $.ajax({
                    type: "POST",
                    url: trimPath + '/edit_put',
                    data: $('#add_feed').serialize()
                })
                    .done(function( msg ) {
                        if(parseInt(msg)) {
                            location.href = trimPath + '?opp=success';
                        } else {
                            location.href = trimPath + '?opp=fail';
                        }
                    });
            }
        });

        //нажатие кнопки "отмена" в форме добавления ленты
        $('#btn-cancel-feed').click(function () {
            var form = $('.add-form')[0];

            if($(form).hasClass('hidden') === false) {
                $(form).addClass('hidden');
                $('#btn-cancel-feed').addClass('hidden');
                $('#btn-add-feed').removeClass('hidden');
                $('#btn-edit-feed').addClass('hidden');
                $('.add-feed-status').html('');
            }
        });
    });

})(jQuery);