<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-19 22:30:21
         compiled from "application/views/feeds_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:127016663554e0dd1016fc69-31743023%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'caf45fb576e7cea93afa76fadf5f942e0b92c242' => 
    array (
      0 => 'application/views/feeds_view.tpl',
      1 => 1424374219,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '127016663554e0dd1016fc69-31743023',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54e0dd101c18c8_48309455',
  'variables' => 
  array (
    'data' => 0,
    'line' => 0,
    'subfolder' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54e0dd101c18c8_48309455')) {function content_54e0dd101c18c8_48309455($_smarty_tpl) {?><h1>Список новостных лент</h1>

<br/>


<div id="no-more-tables">
    <table class="table table-condensed">
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Лента</th>
            <th>&nbsp;</th>
        </tr>
        </thead>

        <tbody>
        <?php  $_smarty_tpl->tpl_vars['line'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['line']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['line']->key => $_smarty_tpl->tpl_vars['line']->value) {
$_smarty_tpl->tpl_vars['line']->_loop = true;
?>
            <tr>
                <td data-title="ID"><?php echo $_smarty_tpl->tpl_vars['line']->value['id'];?>
</td>
                <td data-title="Название"><?php echo $_smarty_tpl->tpl_vars['line']->value['name'];?>
</td>
                <td data-title="Лента" class="widecell">
                    <?php echo $_smarty_tpl->tpl_vars['line']->value['rss'];?>

                    <a target="_blank" class="glyphicon glyphicon-arrow-down" href="<?php echo $_smarty_tpl->tpl_vars['line']->value['rss'];?>
 "></a>
                </td>
                <td>
                    <div class="btn-group btn-group-md">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
                            Меню
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(1);" onclick="editFeed(<?php echo $_smarty_tpl->tpl_vars['line']->value['id'];?>
, this);">Изменить</a></li>
                            <li><a href="javascript:void(1);" onclick="delFeed(<?php echo $_smarty_tpl->tpl_vars['line']->value['id'];?>
);">Удалить</a></li>
                            <li class="divider"></li>
                            <li><a class="check_connection" href="news/feed?id=<?php echo $_smarty_tpl->tpl_vars['line']->value['id'];?>
" >Проверить ленту</a></li>
                        </ul>
                    </div>
                    <span class="feed-info invisible">
                        <img src="/<?php echo $_smarty_tpl->tpl_vars['subfolder']->value;?>
images/fbloader.gif" alt="loading"/>
                    </span>

                    
                    <span class="feed-info2 invisible">
                        <img src="/<?php echo $_smarty_tpl->tpl_vars['subfolder']->value;?>
images/fbloader.gif" alt="loading"/>
                    </span>

                </td>
            </tr>
        <?php } ?>
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
<span class="add-feed-status"></span><?php }} ?>
