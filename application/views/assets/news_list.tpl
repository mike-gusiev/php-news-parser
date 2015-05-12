<form id="news_list" action="">
    <div class="row">
        {foreach from=$data.feed.news item=news}

            {if $view_type == 1}
                {if $data.status == 2}
            <div class="col-md-6 col-sm-12 news-tile feed-item">
                {else}
            <div class="col-md-4 col-sm-6 news-tile feed-item">
                {/if}
            {/if}

            {if $view_type == 2}
            <div class="col-md-12 news-default feed-item">
            {/if}

                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-ok"></span>
                        <h3 class="panel-title"><a target="_blank" href="{if isset($news.link)}{$news.link}{else}javascript:void(1);{/if}">{if $news.title}{$news.title}{else}&lt;Нет заголовка&gt;{/if}</a></h3>
                    </div>
                    <div class="panel-body">

                        {if isset($news.feed_name)}
                            <div class="panel-date"><b>Лента:</b> {$news.feed_name}</div><br/>
                        {/if}

                        {if $news.date && $news.date != 'none'}
                            <div class="panel-date"><b>Дата:</b> {$news.date}</div><br/>
                        {/if}

                        <input name="news_id[]" type="checkbox" value="{$news.news_id}" />

                        {if $news.date && $news.desc != 'none'}
                            <div>{$news.desc|strip_tags|escape}</div><br/>
                        {/if}

                        {if $news.image && $news.image != 'none'}
                            <div class="img-block">
                                <a target="_blank" href="{if isset($news.link)}{$news.link}{else}javascript:void(1);{/if}">{$news.image} </a>
                            </div>
                        {/if}

                        {if $news.full && $news.full != 'none'}
                            <a class="show-full-text" onclick="$('#modal_{$news.news_id}').modal('show')" href="javascript:void(1);"><span class="glyphicon glyphicon-comment"></span></a>
                        {/if}

                        <div class="clearfix"></div>
                        <br/>
                        {*<div class="cats-block">*}
                            {*<select class="selectpicker item-cats" multiple>*}
                                {*<option value="1" selected="selected">Категория</option>*}
                            {*</select>*}
                        {*</div>*}

                        <div class="bg-primary clearfix">
                            {if !isset($news.link)}<p><span>Ссылка:</span> не найдено</p>{/if}
                            {if !$news.desc} <p><span>Описание:</span> не найдено</p>{/if}
                            {if !$news.full} <p><span>Текст статьи:</span> не найдено</p>{/if}
                            {if !$news.image} <p><span>Картинка:</span> не найдено</p>{/if}
                            {if !$news.date} <p><span>Дата:</span> не найдено</p>{/if}
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal fade full_text" id="modal_{$news.news_id}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">{if $news.title}{$news.title}{else}&lt;Нет заголовка&gt;{/if}</h4>
                        </div>
                        <div class="modal-body">
                            {if $news.full}

                                {if $news.image}
                                    <p>{$news.image}</p>
                                {/if}

                                {$news.full|replace:'script':''}
                            {else}&lt;Нет контента&gt;{/if}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
        {/foreach}
    </div>
</form>