<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-21 03:29:50
         compiled from "application/views/feeds_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:77126979554f9a4b38022e2-64173264%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7214a217691782deb91f6557fd6ee868d39fc6ff' => 
    array (
      0 => 'application/views/feeds_view.tpl',
      1 => 1429586976,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '77126979554f9a4b38022e2-64173264',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54f9a4b38a2e51_96533434',
  'variables' => 
  array (
    'data' => 0,
    'line' => 0,
    'subfolder' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f9a4b38a2e51_96533434')) {function content_54f9a4b38a2e51_96533434($_smarty_tpl) {?><h1>Список новостных лент</h1>

<br/>


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
        <?php  $_smarty_tpl->tpl_vars['line'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['line']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['line']->key => $_smarty_tpl->tpl_vars['line']->value) {
$_smarty_tpl->tpl_vars['line']->_loop = true;
?>
            <tr <?php if ($_smarty_tpl->tpl_vars['line']->value['active']==0) {?>class="disabled" <?php }?>>
                <td data-title="ID"><?php echo $_smarty_tpl->tpl_vars['line']->value['id'];?>
</td>
                <td data-title="Лента">
                    <b><?php echo $_smarty_tpl->tpl_vars['line']->value['name'];?>
</b> <br/>
                    <?php echo $_smarty_tpl->tpl_vars['line']->value['rss'];?>

                    <a target="_blank" class="glyphicon glyphicon-arrow-down" href="<?php echo $_smarty_tpl->tpl_vars['line']->value['rss'];?>
 "></a>
                </td>
                <td data-title="Коммент" class="widecell comment-cell">
                    <?php echo $_smarty_tpl->tpl_vars['line']->value['comment'];?>

                </td>
                <td class="menu-cell">
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
