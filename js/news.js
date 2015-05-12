(function ($) {

    $(document).ready(function () {

        $('.feed-item').click(function () {

            if(location.href.indexOf('feed?id') != -1) return;
            if(location.href.indexOf('feed?vtype=1&id') != -1) return;
            if(location.href.indexOf('feed?vtype=2&id') != -1) return;

            $($(this).children()[0]).toggleClass('panel-danger').toggleClass('panel-primary');

            var checkBox = $(this).find('input');
            checkBox.prop("checked", !checkBox.prop("checked"));

            reloadButton();
        });

        $('.vtype').change(function () {
           $(this).parents('form').submit();
        });

        $('#affectedSites').change(function () {
            reloadButton();
        });

        $('#addSiteBtn').click(function () {
            $('#addNewsThrobber').css('visibility','visible');
            $('#addSiteBtn').prop('disabled', true);

            var heroic_link = $('#sitesList').serialize() + '&' + $('#news_list').serialize();

            $.ajax({
                type: 'post',
                data: 'add_news=1&'+heroic_link
            })
                .done(function( msg ) {
                    console.log(msg);

                    $('#addNewsThrobber').css('visibility','hidden');
                    $('#addSiteBtn').prop('disabled', false);

                    var answer = JSON.parse(msg);


                    $('#myModal .modal-body').html(answer.message);

                    if(answer.status == false) {
                        $('#myModal .modal-body').html('<p class="red">Ошибка:</p><br/>' + $('#myModal .modal-body').html());
                    }

                    $('#myModal').modal('show')


                });

            return false;
        });

        $('#news_list a').click(function (e) {
            e.stopPropagation();
        });

        $('#sitesList select').change(function () {
            var sites = $('#sitesList select').val();
            if(sites == null || sites.length == 0) return;

            var ajax_link = '';

            var link_arr = location.href.split('/news');
            if(link_arr.length > 1) {
                ajax_link = link_arr[0] + '/news/cats';
            } else {
                ajax_link = link_arr[0].split('?')[0].split('#')[0];

                if(ajax_link.substr(ajax_link.length-1) == '/')
                    ajax_link = ajax_link + 'news/cats';
                else
                    ajax_link = ajax_link + '/news/cats';
            }

            $.ajax({
                url: ajax_link,
                type: 'post',
                data: 'sites='+sites.join(',')
            })
                .done(function( msg ) {
                    var answer = JSON.parse(msg);
//                    reloadCats(answer);
                });

        });
    });

    window.reloadButton = function () {
        if($('#affectedSites').val() != null && $('.panel-primary').length) {
            $('#addSiteBtn').prop('disabled', false);
        } else {
            $('#addSiteBtn').prop('disabled', true);
        }
    }

    window.reloadCats = function (cats) {
        var resultHTML = '';

        for(var i in cats) {
            resultHTML += '<optgroup label="'+cats[i].site.url+'">';
            resultHTML += '<option value="s'+cats[i].site.id+'_0" selected="selected">По умолчанию</option>';
            for(var k in cats[i].cats) {
                resultHTML += '<option value="s'+cats[i].site.id+'_'+cats[i].cats[k].id+'">'+cats[i].cats[k].name+'</option>';
            }
            resultHTML += '</optgroup>';
        }

        var selectItem =  $('.item-cats').find('option').parent();
        selectItem.html(resultHTML);
        $('.item-cats').selectpicker('refresh');
        console.log(cats);
    }

})(jQuery);