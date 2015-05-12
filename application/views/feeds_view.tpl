<h1>Список новостных лент</h1>

<br/>
{*<pre class="black">{$data|print_r}</pre>*}

<div id="no-more-tables">
    <table class="table table-condensed">
        <thead>
        <tr>
            <th>ID</th>
            <th>Лента</th>
            <th>Комментарий</th>
            <th>&nbsp;</th>
        </tr>
        </thead>

        <tbody>
        {foreach from=$data item=line}
            <tr {if $line.active == 0}class="disabled" {/if}>
                <td data-title="ID">{$line.id}</td>
                <td data-title="Лента">
                    <b>{$line.name}</b> <br/>
                    {$line.rss}
                    <a target="_blank" class="glyphicon glyphicon-arrow-down" href="{$line.rss} "></a>
                </td>
                <td data-title="Коммент" class="widecell comment-cell">
                    {$line.comment}
                </td>
                <td class="menu-cell">
                    <div class="btn-group btn-group-md">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
                            Меню
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(1);" onclick="editFeed({$line.id}, this);">Изменить</a></li>
                            <li><a href="javascript:void(1);" onclick="delFeed({$line.id});">Удалить</a></li>
                            <li class="divider"></li>
                            <li><a class="check_connection" href="news/feed?id={$line.id}" >Проверить ленту</a></li>
                        </ul>
                    </div>
                    <span class="feed-info invisible">
                        <img src="/{$subfolder}images/fbloader.gif" alt="loading"/>
                    </span>

                    {*костыль для $subfolder*}
                    <span class="feed-info2 invisible">
                        <img src="/{$subfolder}images/fbloader.gif" alt="loading"/>
                    </span>

                </td>
            </tr>
        {/foreach}
        </tbody>

    </table>
</div>


<br/>

<div class="add-form hidden">
    <form name="add_feed" id="add_feed">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">

                <div class="form-group">
                    <label for="InputName">Название ленты:</label>
                    <input type="hidden" name="id" id="InputID" value="" />
                    <input type="text" name="name" class="form-control" id="InputName" placeholder="Введите название ленты">
                </div>
                <div class="form-group">
                    <label for="InputRSS">Ссылка ленты:</label>
                    <input type="text" name="rss" class="form-control" id="InputRSS" placeholder="Укажите ссылку RSS-ленты" value="">
                </div>
            </div>

        </div>

    </form>
</div>

<button type="button" class="btn btn-danger" id="btn-add-feed">Добавить ленту</button>
<button type="button" class="btn btn-danger hidden" id="btn-edit-feed">Изменить ленту</button>
<button type="button" class="btn btn-primary hidden" id="btn-cancel-feed">Отмена</button>
<span class="add-feed-status"></span>