(function ($) {

    var pathArr = location.pathname.split('sites');
    var trimPath = pathArr[0] + 'sites';

    //скрываем или показываем форму добавления сайта
    window.hideForm = function (type) {

        $('.site-info2')
            .html( $('.site-info').html() )
            .addClass('invisible');

        $('.add-site-status').html('');

        var form = $('.add-form')[0];

        if(type == 1) {
            if($(form).hasClass('hidden')) {
                $(form).removeClass('hidden');
                $('#btn-cancel-site').removeClass('hidden');
                $('#btn-edit-site').addClass('hidden');
                $('#btn-add-site').removeClass('hidden');
            }
        } else {
            $(form).addClass('hidden');
            $('#btn-cancel-site').addClass('hidden');
            $('#btn-edit-site').addClass('hidden');
            $('#btn-add-site').removeClass('hidden');
        }
    };

    //доп. меню - Изменить сайт
    window.editSite = function (id, obj) {
        $(obj).parents('tr').find('.site-info').removeClass('invisible');

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

                $('#InputID').val(answer.site.id);
                $('#InputURL').val(answer.site.url);
                $('#InputType').val(answer.site.type);
                $('#InputDBHost').val(answer.site.dbhost);
                $('#InputDBName').val(answer.site.dbname);
                $('#InputDBUser').val(answer.site.dbuser);
                $('#InputDBPass').val(answer.site.dbpass);
                $('#InputDBCharset').val(answer.site.dbcharset);

                hideForm(1);
                $('#btn-edit-site').removeClass('hidden');
                $('#btn-add-site').addClass('hidden');

                $(obj).parents('tr').find('.site-info').addClass('invisible');

            });
    }

    //доп.меню - Удалить сайт
    window.delSite = function (id) {
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

    //доп.меню - Проверить соединение
    window.checkSite = function (id, obj) {
        hideForm(0);

        var $siteInfo = $(obj).parents('tr').find('.site-info');
        $siteInfo.removeClass('invisible');


        $.ajax({
            type: "POST",
            url: trimPath + '/check',
            data: 'id='+id
        })
            .done(function( msg ) {
                $siteInfo.addClass('invisible');

                var answer = JSON.parse(msg);

                var $siteInfo2 = $(obj).parents('tr').find('.site-info2');

                if(answer.status == true) {
                    $siteInfo2.html('<span>OK!</span>');
                    $siteInfo2.removeClass('invisible');
                } else {
                    $siteInfo2.html('<span class="red">BAD!</span>');
                    $siteInfo2.removeClass('invisible');

                    console.log('DbSimple error: ' + answer.message);
                    console.log('PHP error: '  + answer.phperror);

                    var msg = '';
                    if(answer.message.indexOf('No such file or directory') != -1) msg = 'Не удалось подключится к серверу!';
                    if(answer.message.indexOf('Unknown database') != -1) msg = 'Нету такой базы данных на сервере!';
                    if(answer.message.indexOf('Access denied for user') != -1) msg = 'Неправильный логин или пароль к базе данных!';

                    $('.add-site-status').html(msg);
                }

            });
    }


    $(document).ready(function () {

        //нажатие кнопки "добавить сайт"
        $('#btn-add-site').click(function () {
            var form = $('.add-form')[0];

            if($(form).hasClass('hidden')) {
                hideForm(1);
            } else {
                $('.add-site-status').html( $('.site-info').html() ); //картинка fbloader.gif

                if(validateForm(form) == false) {
                    $('.add-site-status').html('Неверно заполенны поля!');
                } else {

                    $.ajax({
                        type: "POST",
                        url: trimPath + '/add',
                        data: $('#add_site').serialize()
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

        //нажатие кнопки "изменить сайт"
        $('#btn-edit-site').click(function () {
            var form = $('.add-form')[0];

            $('.add-site-status').html( $('.site-info2').html() ); //картинка fbloader.gif

            if(validateForm(form) == false) {
                var form = $('.add-form')[0];

                $('.add-site-status').html('Неверно заполенны поля!');
            } else {

                $.ajax({
                    type: "POST",
                    url: trimPath + '/edit_put',
                    data: $('#add_site').serialize()
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

        //нажатие кнопки "отмена" в форме добавления сайта
        $('#btn-cancel-site').click(function () {
            var form = $('.add-form')[0];

            if($(form).hasClass('hidden') === false) {
                $(form).addClass('hidden');
                $('#btn-cancel-site').addClass('hidden');
                $('#btn-add-site').removeClass('hidden');
                $('#btn-edit-site').addClass('hidden');
                $('.add-site-status').html('');
            }
        });

    });
})(jQuery);