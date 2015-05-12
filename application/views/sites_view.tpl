<h1>Список сайтов</h1>

<br/>
{*<pre class="black">{$data|print_r}</pre>*}

<div id="no-more-tables">
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>ID</th>
                <th>Сайт</th>
                <th>CMS</th>
                <th>RSS</th>
                <th>&nbsp;</th>
            </tr>
        </thead>

        <tbody>
            {foreach from=$data item=line}
            <tr>
                <td data-title="ID">{$line.id}</td>
                <td data-title="Сайт">
                    {$line.url}
                    <a target="_blank" class="glyphicon glyphicon-arrow-down" href="http://{$line.url} "></a>
                </td>
                <td data-title="CMS">{$line.type|strtoupper}</td>
                <td data-title="RSS">0</td>
                <td>
                    <div class="btn-group btn-group-md">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
                            Меню
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(1);" onclick="editSite({$line.id}, this);">Изменить</a></li>
                            <li><a href="javascript:void(1);" onclick="delSite({$line.id});">Удалить</a></li>
                            <li class="divider"></li>
                            <li><a class="check_connection" href="javascript:void(1);"  onclick="checkSite({$line.id}, this);">Проверить соединение</a></li>
                        </ul>
                    </div>
                    <span class="site-info invisible">
                        <img src="/{$subfolder}images/fbloader.gif" alt="loading"/>
                    </span>

                    {*костыль для $subfolder*}
                    <span class="site-info2 invisible">
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
    <form name="add_site" id="add_site">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">

                <div class="form-group">
                    <label for="InputURL">Адрес сайта:</label>
                    <input type="hidden" name="id" id="InputID" value="" />
                    <input type="text" name="url" class="form-control" id="InputURL" placeholder="Введите адрес сайта">
                </div>
                <div class="form-group">
                    <label for="InputType">Тип сайта:</label>
                    <select multiple name="type" class="form-control" id="InputType">
                        {foreach from=$cms_list item=line}
                        <option value="{$line|strtolower}">{$line}</option>
                        {/foreach}
                    </select>
                </div>

            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">

                <div class="form-group">
                    <label for="InputDBHost">Имя хоста бд:</label>
                    <input type="text" name="dbhost" class="form-control" id="InputDBHost" placeholder="Введите адрес хоста бд" value="localhost">
                </div>
                <div class="form-group">
                    <label for="InputDBName">Имя базы данных:</label>
                    <input type="text" name="dbname" class="form-control" id="InputDBName" placeholder="Введите имя базы данных">
                </div>

            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">

                <div class="form-group">
                    <label for="InputDBUser">Имя пользователя бд:</label>
                    <input type="text" name="dbuser" class="form-control" id="InputDBUser" placeholder="Введите имя пользователя">
                </div>
                <div class="form-group">
                    <label for="InputDBPass">Пароль пользователя бд:</label>
                    <input type="text" name="dbpass" class="form-control" id="InputDBPass" placeholder="Введите пароль пользователя">
                </div>
                <div class="form-group">
                    <label for="InputDBCharset">Кодировка базы данных:</label>
                    <input type="text" name="dbcharset" class="form-control" id="InputDBCharset" placeholder="Введите кодировку базы данных" value="utf8">
                </div>

            </div>
        </div>

    </form>
</div>

<button type="button" class="btn btn-danger" id="btn-add-site">Добавить сайт</button>
<button type="button" class="btn btn-danger hidden" id="btn-edit-site">Изменить сайт</button>
<button type="button" class="btn btn-primary hidden" id="btn-cancel-site">Отмена</button>
<span class="add-site-status"></span>