<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-15 18:12:48
         compiled from "application/views/news_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:87501945854b3a2f3a0ab46-64782819%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '00bb8a261d221608bdbcc793c6f4f39517274249' => 
    array (
      0 => 'application/views/news_view.tpl',
      1 => 1424020362,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '87501945854b3a2f3a0ab46-64782819',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54b3a2f3a82c32_68280804',
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
<?php if ($_valid && !is_callable('content_54b3a2f3a82c32_68280804')) {function content_54b3a2f3a82c32_68280804($_smarty_tpl) {?>
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
                        <label class="btn btn-danger <?php if (isset($_GET['feed_id'])&&in_array($_smarty_tpl->tpl_vars['feed']->value['id'],$_GET['feed_id'])) {?>active<?php }?>">
                            <span class="glyphicon glyphicon-ok"></span>
                            <input title="<?php echo $_smarty_tpl->tpl_vars['feed']->value['rss'];?>
" name="feed_id[]" value="<?php echo $_smarty_tpl->tpl_vars['feed']->value['id'];?>
" type="checkbox" autocomplete="off" <?php if (isset($_GET['feed_id'])&&in_array($_smarty_tpl->tpl_vars['feed']->value['id'],$_GET['feed_id'])) {?>checked<?php }?>> <?php echo $_smarty_tpl->tpl_vars['feed']->value['name'];?>

                        </label>
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
            <td><b>Название:</b></td>
            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['feed']['name'];?>
</td>
        </tr>
        <tr>
            <td><b>Ссылка:</b></td>
            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['feed']['rss'];?>
 <a target="_blank" class="glyphicon glyphicon-arrow-down" href="<?php echo $_smarty_tpl->tpl_vars['data']->value['feed']['rss'];?>
 "></a></td>
        </tr>
        <tr>
            <td><b>Картинка:</b></td>
            <td><img src="<?php echo $_smarty_tpl->tpl_vars['data']->value['feed']['image']['url'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['data']->value['feed']['image']['description'];?>
" /></td>
        </tr>
        <tr>
            <td><b>Описание:</b></td>
            <td><?php echo $_smarty_tpl->tpl_vars['data']->value['feed']['description'];?>
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

    <?php echo $_smarty_tpl->getSubTemplate ('assets/news_list.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

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
