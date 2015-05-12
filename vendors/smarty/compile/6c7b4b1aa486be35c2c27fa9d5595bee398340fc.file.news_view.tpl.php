<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-21 03:33:28
         compiled from "application/views/news_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:152709936754f9a3a32fcac3-48295122%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c7b4b1aa486be35c2c27fa9d5595bee398340fc' => 
    array (
      0 => 'application/views/news_view.tpl',
      1 => 1429587175,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '152709936754f9a3a32fcac3-48295122',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54f9a3a3569589_36104076',
  'variables' => 
  array (
    'data' => 0,
    'feed' => 0,
    'site' => 0,
    'subfolder' => 0,
    'view_type' => 0,
    'k' => 0,
    'v' => 0,
    'v2' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f9a3a3569589_36104076')) {function content_54f9a3a3569589_36104076($_smarty_tpl) {?>
<?php if ($_smarty_tpl->tpl_vars['data']->value['status']==0) {?>

    <div class="bg-danger"><?php echo $_smarty_tpl->tpl_vars['data']->value['error'];?>
</div>

<?php } elseif ($_smarty_tpl->tpl_vars['data']->value['status']==1) {?>

    <h1>Новости из выбранных лент</h1>

    <br/>

    

    <div class="row">
        <div class="col-md-6 col-sm-6">
            <form action="">
                <div class="btn-group-vertical" data-toggle="buttons">

                    <?php  $_smarty_tpl->tpl_vars['feed'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['feed']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['feeds']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['feed']->key => $_smarty_tpl->tpl_vars['feed']->value) {
$_smarty_tpl->tpl_vars['feed']->_loop = true;
?>
                        <?php if ($_smarty_tpl->tpl_vars['feed']->value['active']) {?>
                            <label class="btn btn-danger <?php if (isset($_GET['feed_id'])&&in_array($_smarty_tpl->tpl_vars['feed']->value['id'],$_GET['feed_id'])) {?>active<?php }?>">
                                <span class="glyphicon glyphicon-ok"></span>
                                <input title="<?php echo $_smarty_tpl->tpl_vars['feed']->value['rss'];?>
" name="feed_id[]" value="<?php echo $_smarty_tpl->tpl_vars['feed']->value['id'];?>
" type="checkbox" autocomplete="off" <?php if (isset($_GET['feed_id'])&&in_array($_smarty_tpl->tpl_vars['feed']->value['id'],$_GET['feed_id'])) {?>checked<?php }?>> <?php echo $_smarty_tpl->tpl_vars['feed']->value['name'];?>

                            </label>
                        <?php }?>
                    <?php } ?>
                </div>

                <button type="submit" class="btn btn-primary">Выбрать</button>
            </form>
        </div>

        <div class="col-md-6 text-right">

            <div class="row">
                <div class="col-md-9">
                    <?php if (isset($_smarty_tpl->tpl_vars['data']->value['sites'])) {?>
                        <form action="" id="sitesList">
                            <select id="affectedSites" name="sites[]" class="selectpicker" data-style="btn-success" multiple data-selected-text-format="count">
                                <?php  $_smarty_tpl->tpl_vars['site'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['site']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['sites']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['site']->key => $_smarty_tpl->tpl_vars['site']->value) {
$_smarty_tpl->tpl_vars['site']->_loop = true;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['site']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['site']->value['url'];?>
</option>
                                <?php } ?>
                            </select>

                            <button id="addSiteBtn" class="btn btn-primary" disabled>Добавить</button>
                            <span id="addNewsThrobber">
                                <img src="/<?php echo $_smarty_tpl->tpl_vars['subfolder']->value;?>
images/fbloader.gif" alt="loading"/>
                            </span>
                        </form>
                    <?php }?>
                </div>

                <div class="col-md-3">
                    <form action="">
                        <div class="btn-group vtype" data-toggle="buttons">
                            <label class="btn btn-danger <?php if ($_smarty_tpl->tpl_vars['view_type']->value==1) {?>active<?php }?>">
                                <input type="radio" name="vtype" value="1" autocomplete="off" <?php if ($_smarty_tpl->tpl_vars['view_type']->value==1) {?>checked<?php }?>> <span class="glyphicon glyphicon-th-large"></span>
                            </label>
                            <label class="btn btn-danger <?php if ($_smarty_tpl->tpl_vars['view_type']->value==2) {?>active<?php }?>">
                                <input type="radio" name="vtype" value="2" autocomplete="off" <?php if ($_smarty_tpl->tpl_vars['view_type']->value==2) {?>checked<?php }?>> <span class="glyphicon glyphicon-list"></span>
                            </label>
                        </div>
                        <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_GET; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                            <?php if (is_array($_GET[$_smarty_tpl->tpl_vars['k']->value])) {?>
                                <?php  $_smarty_tpl->tpl_vars['v2'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v2']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['v']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v2']->key => $_smarty_tpl->tpl_vars['v2']->value) {
$_smarty_tpl->tpl_vars['v2']->_loop = true;
?>
                                    <input name="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
[]" value="<?php echo $_smarty_tpl->tpl_vars['v2']->value;?>
" type="hidden"/>
                                <?php } ?>
                            <?php } else { ?>
                                <?php if ($_smarty_tpl->tpl_vars['k']->value!='vtype') {?>
                                    <input name="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
" type="hidden"/>
                                <?php }?>
                            <?php }?>
                        <?php } ?>
                    </form>
                </div>
            </div>




        </div>
    </div>



    <?php if (isset($_smarty_tpl->tpl_vars['data']->value['feed']['news'])) {?>
        <hr/>

        <?php echo $_smarty_tpl->getSubTemplate ('assets/news_list.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <?php }?>

<?php } elseif ($_smarty_tpl->tpl_vars['data']->value['status']==2) {?>
    <h1>Информация о ленте</h1>

    <br/>
    <table class="table table-condensed">
        <tr>
            <td><b>ID:</b></td>
            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['feed']['id'];?>
</td>
        </tr>
        <tr>
            <td><b>Лента:</b></td>
            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['feed']['name'];?>
</td>
        </tr>
        <?php if (isset($_smarty_tpl->tpl_vars['data']->value['feed']['title'])) {?>
            <tr>
                <td><b>Название:</b></td>
                <td><?php echo $_smarty_tpl->tpl_vars['data']->value['feed']['title'];?>
</td>
            </tr>
        <?php }?>
        <tr>
            <td><b>Ссылка:</b></td>
            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['feed']['rss'];?>
 <a target="_blank" class="glyphicon glyphicon-arrow-down" href="<?php echo $_smarty_tpl->tpl_vars['data']->value['feed']['rss'];?>
 "></a></td>
        </tr>
        <?php if (isset($_smarty_tpl->tpl_vars['data']->value['feed']['image'])&&isset($_smarty_tpl->tpl_vars['data']->value['feed']['image']['url'])) {?>
            <tr>
                <td><b>Картинка:</b></td>
                <td><img class="img-responsive" src="<?php echo $_smarty_tpl->tpl_vars['data']->value['feed']['image']['url'];?>
" alt="<?php if (isset($_smarty_tpl->tpl_vars['data']->value['feed']['image']['description'])) {?> <?php echo $_smarty_tpl->tpl_vars['data']->value['feed']['image']['description'];
}?>" /></td>
            </tr>
        <?php }?>
        <?php if (isset($_smarty_tpl->tpl_vars['data']->value['feed']['description'])) {?>
            <tr>
                <td><b>Описание:</b></td>
                <td><?php echo $_smarty_tpl->tpl_vars['data']->value['feed']['description'];?>
</td>
            </tr>
        <?php }?>

        <tr>
            <td><b>Новостей:</b></td>
            <td><?php echo count($_smarty_tpl->tpl_vars['data']->value['feed']['news']);?>
</td>
        </tr>

    </table>

    <br/>
    <form action="">
        <div class="btn-group vtype" data-toggle="buttons">
            <label class="btn btn-danger <?php if ($_smarty_tpl->tpl_vars['view_type']->value==1) {?>active<?php }?>">
                <input type="radio" name="vtype" value="1" autocomplete="off" <?php if ($_smarty_tpl->tpl_vars['view_type']->value==1) {?>checked<?php }?>> <span class="glyphicon glyphicon-th-large"></span>
            </label>
            <label class="btn btn-danger <?php if ($_smarty_tpl->tpl_vars['view_type']->value==2) {?>active<?php }?>">
                <input type="radio" name="vtype" value="2" autocomplete="off" <?php if ($_smarty_tpl->tpl_vars['view_type']->value==2) {?>checked<?php }?>> <span class="glyphicon glyphicon-list"></span>
            </label>
        </div>
        <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_GET; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
            <?php if (is_array($_GET[$_smarty_tpl->tpl_vars['k']->value])) {?>
                <?php  $_smarty_tpl->tpl_vars['v2'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v2']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['v']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v2']->key => $_smarty_tpl->tpl_vars['v2']->value) {
$_smarty_tpl->tpl_vars['v2']->_loop = true;
?>
                    <input name="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
[]" value="<?php echo $_smarty_tpl->tpl_vars['v2']->value;?>
" type="hidden"/>
                <?php } ?>
            <?php } else { ?>
                <?php if ($_smarty_tpl->tpl_vars['k']->value!='vtype') {?>
                    <input name="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
" type="hidden"/>
                <?php }?>
            <?php }?>
        <?php } ?>
    </form>
    <br/>

    <div class="row">
        <div class="col-md-9 col-sm-8 col-xs-12">
            <?php echo $_smarty_tpl->getSubTemplate ('assets/news_list.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        </div>
        <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="panel panel-default sidebar">
                <div class="panel-heading">
                    <h3 class="panel-title">XPath настройки</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post">

                        <?php if (isset($_GET['id'])) {?>
                            <input name="id" type="hidden" value="<?php echo $_GET['id'];?>
"/>
                        <?php }?>

                        <select name="feed_type" class="selectpicker show-tick">
                            <option value="1" <?php if ($_smarty_tpl->tpl_vars['data']->value['feed']['feed_type']==1) {?> selected="selected" <?php }?>>RSS+HTML</option>
                            <option value="2" <?php if ($_smarty_tpl->tpl_vars['data']->value['feed']['feed_type']==2) {?> selected="selected" <?php }?>>XHTML</option>
                        </select>

                        <br/><br/>

                        <div class="form-group">
                            <label for="base_input">Ссылка:</label>
                            <input name="rule_base" class="form-control" id="base_input" placeholder="" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['feed']['rule_base'], ENT_QUOTES, 'UTF-8', true);?>
">
                        </div>

                        <div class="form-group">
                            <label for="title_input">Заголовок:</label>
                            <input name="rule_title" class="form-control" id="title_input" placeholder="" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['feed']['rule_title'], ENT_QUOTES, 'UTF-8', true);?>
">
                        </div>

                        <div class="form-group">
                            <label for="image_input">Картинка:</label>
                            <input name="rule_image" class="form-control" id="image_input" placeholder="" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['feed']['rule_image'], ENT_QUOTES, 'UTF-8', true);?>
">
                        </div>

                        <div class="form-group">
                            <label for="desc_input">Описание:</label>
                            <input name="rule_desc" class="form-control" id="desc_input" placeholder="" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['feed']['rule_desc'], ENT_QUOTES, 'UTF-8', true);?>
">
                        </div>

                        <div class="form-group">
                            <label for="full_input">Текст статьи:</label>
                            <input name="rule_full" class="form-control" id="full_input" placeholder="" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['feed']['rule_full'], ENT_QUOTES, 'UTF-8', true);?>
">
                        </div>

                        <div class="form-group">
                            <label for="date_input">Дата:</label>
                            <input name="rule_date" class="form-control" id="date_input" placeholder="" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['feed']['rule_date'], ENT_QUOTES, 'UTF-8', true);?>
">
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input name="feed_active" type="checkbox" <?php if ($_smarty_tpl->tpl_vars['data']->value['feed']['active']) {?>checked="checked"<?php }?>> <b>Включить ленту</b>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date_input">Комментарий:</label>
                            <textarea name="feed_comment" class="form-control" rows="3"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['feed']['comment'], ENT_QUOTES, 'UTF-8', true);?>
</textarea>
                        </div>

                        <button name="save_xpath" type="submit" class="btn btn-primary">Сохранить</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


<?php } else { ?>
    <p>Hi</p>
<?php }?>


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
</div><?php }} ?>
