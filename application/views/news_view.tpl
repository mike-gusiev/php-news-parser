{*<pre class="black">{$data.sites|print_r}</pre>*}
{if $data.status == 0}

    <div class="bg-danger">{$data.error}</div>

{elseif $data.status == 1}

    <h1>Новости из выбранных лент</h1>

    <br/>

    {*<pre class="black">{$data|print_r}</pre>*}

    <div class="row">
        <div class="col-md-6 col-sm-6">
            <form action="">
                <div class="btn-group-vertical" data-toggle="buttons">

                    {foreach from=$data.feeds item=feed}
                        {if $feed.active}
                            <label class="btn btn-danger {if isset($smarty.get.feed_id) && in_array($feed.id, $smarty.get.feed_id)}active{/if}">
                                <span class="glyphicon glyphicon-ok"></span>
                                <input title="{$feed.rss}" name="feed_id[]" value="{$feed.id}" type="checkbox" autocomplete="off" {if isset($smarty.get.feed_id) && in_array($feed.id, $smarty.get.feed_id)}checked{/if}> {$feed.name}
                            </label>
                        {/if}
                    {/foreach}
                </div>

                <button type="submit" class="btn btn-primary">Выбрать</button>
            </form>
        </div>

        <div class="col-md-6 text-right">

            <div class="row">
                <div class="col-md-9">
                    {if isset($data.sites)}
                        <form action="" id="sitesList">
                            <select id="affectedSites" name="sites[]" class="selectpicker" data-style="btn-success" multiple data-selected-text-format="count">
                                {foreach from=$data.sites item=site}
                                    <option value="{$site.id}">{$site.url}</option>
                                {/foreach}
                            </select>

                            <button id="addSiteBtn" class="btn btn-primary" disabled>Добавить</button>
                            <span id="addNewsThrobber">
                                <img src="/{$subfolder}images/fbloader.gif" alt="loading"/>
                            </span>
                        </form>
                    {/if}
                </div>

                <div class="col-md-3">
                    <form action="">
                        <div class="btn-group vtype" data-toggle="buttons">
                            <label class="btn btn-danger {if $view_type == 1}active{/if}">
                                <input type="radio" name="vtype" value="1" autocomplete="off" {if $view_type == 1}checked{/if}> <span class="glyphicon glyphicon-th-large"></span>
                            </label>
                            <label class="btn btn-danger {if $view_type == 2}active{/if}">
                                <input type="radio" name="vtype" value="2" autocomplete="off" {if $view_type == 2}checked{/if}> <span class="glyphicon glyphicon-list"></span>
                            </label>
                        </div>
                        {foreach from=$smarty.get key=k item=v}
                            {if $smarty.get.$k|is_array}
                                {foreach from=$v item=v2}
                                    <input name="{$k}[]" value="{$v2}" type="hidden"/>
                                {/foreach}
                            {else}
                                {if $k != 'vtype'}
                                    <input name="{$k}" value="{$v}" type="hidden"/>
                                {/if}
                            {/if}
                        {/foreach}
                    </form>
                </div>
            </div>




        </div>
    </div>



    {if isset($data.feed.news)}
        <hr/>

        {include file='assets/news_list.tpl'}
    {/if}

{elseif $data.status == 2}
    <h1>Информация о ленте</h1>

    <br/>
    <table class="table table-condensed">
        <tr>
            <td><b>ID:</b></td>
            <td>{$data.feed.id}</td>
        </tr>
        <tr>
            <td><b>Лента:</b></td>
            <td>{$data.feed.name}</td>
        </tr>
        {if isset($data.feed.title)}
            <tr>
                <td><b>Название:</b></td>
                <td>{$data.feed.title}</td>
            </tr>
        {/if}
        <tr>
            <td><b>Ссылка:</b></td>
            <td>{$data.feed.rss} <a target="_blank" class="glyphicon glyphicon-arrow-down" href="{$data.feed.rss} "></a></td>
        </tr>
        {if isset($data.feed.image) && isset($data.feed.image.url)}
            <tr>
                <td><b>Картинка:</b></td>
                <td><img class="img-responsive" src="{$data.feed.image.url}" alt="{if isset($data.feed.image.description)} {$data.feed.image.description}{/if}" /></td>
            </tr>
        {/if}
        {if isset($data.feed.description) }
            <tr>
                <td><b>Описание:</b></td>
                <td>{$data.feed.description}</td>
            </tr>
        {/if}

        <tr>
            <td><b>Новостей:</b></td>
            <td>{$data.feed.news|count}</td>
        </tr>

    </table>

    <br/>
    <form action="">
        <div class="btn-group vtype" data-toggle="buttons">
            <label class="btn btn-danger {if $view_type == 1}active{/if}">
                <input type="radio" name="vtype" value="1" autocomplete="off" {if $view_type == 1}checked{/if}> <span class="glyphicon glyphicon-th-large"></span>
            </label>
            <label class="btn btn-danger {if $view_type == 2}active{/if}">
                <input type="radio" name="vtype" value="2" autocomplete="off" {if $view_type == 2}checked{/if}> <span class="glyphicon glyphicon-list"></span>
            </label>
        </div>
        {foreach from=$smarty.get key=k item=v}
            {if $smarty.get.$k|is_array}
                {foreach from=$v item=v2}
                    <input name="{$k}[]" value="{$v2}" type="hidden"/>
                {/foreach}
            {else}
                {if $k != 'vtype'}
                    <input name="{$k}" value="{$v}" type="hidden"/>
                {/if}
            {/if}
        {/foreach}
    </form>
    <br/>

    <div class="row">
        <div class="col-md-9 col-sm-8 col-xs-12">
            {include file='assets/news_list.tpl'}
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="panel panel-default sidebar">
                <div class="panel-heading">
                    <h3 class="panel-title">XPath настройки</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post">

                        {if isset($smarty.get.id)}
                            <input name="id" type="hidden" value="{$smarty.get.id}"/>
                        {/if}

                        <select name="feed_type" class="selectpicker show-tick">
                            <option value="1" {if $data.feed.feed_type == 1} selected="selected" {/if}>RSS+HTML</option>
                            <option value="2" {if $data.feed.feed_type == 2} selected="selected" {/if}>XHTML</option>
                        </select>

                        <br/><br/>

                        <div class="form-group">
                            <label for="base_input">Ссылка:</label>
                            <input name="rule_base" class="form-control" id="base_input" placeholder="" value="{$data.feed.rule_base|escape}">
                        </div>

                        <div class="form-group">
                            <label for="title_input">Заголовок:</label>
                            <input name="rule_title" class="form-control" id="title_input" placeholder="" value="{$data.feed.rule_title|escape}">
                        </div>

                        <div class="form-group">
                            <label for="image_input">Картинка:</label>
                            <input name="rule_image" class="form-control" id="image_input" placeholder="" value="{$data.feed.rule_image|escape}">
                        </div>

                        <div class="form-group">
                            <label for="desc_input">Описание:</label>
                            <input name="rule_desc" class="form-control" id="desc_input" placeholder="" value="{$data.feed.rule_desc|escape}">
                        </div>

                        <div class="form-group">
                            <label for="full_input">Текст статьи:</label>
                            <input name="rule_full" class="form-control" id="full_input" placeholder="" value="{$data.feed.rule_full|escape}">
                        </div>

                        <div class="form-group">
                            <label for="date_input">Дата:</label>
                            <input name="rule_date" class="form-control" id="date_input" placeholder="" value="{$data.feed.rule_date|escape}">
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input name="feed_active" type="checkbox" {if $data.feed.active}checked="checked"{/if}> <b>Включить ленту</b>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date_input">Комментарий:</label>
                            <textarea name="feed_comment" class="form-control" rows="3">{$data.feed.comment|escape}</textarea>
                        </div>

                        <button name="save_xpath" type="submit" class="btn btn-primary">Сохранить</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


{else}
    <p>Hi</p>
{/if}


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Результат</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>