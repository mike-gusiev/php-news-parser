<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-12 20:54:11
         compiled from "application/views/assets/news_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:116808210454dc87f0d73827-77455856%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a4bb70fc11bd5b3a45d3853d6ff4b94ae9745b97' => 
    array (
      0 => 'application/views/assets/news_list.tpl',
      1 => 1423770850,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '116808210454dc87f0d73827-77455856',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54dc87f0e914f3_32471648',
  'variables' => 
  array (
    'data' => 0,
    'view_type' => 0,
    'news' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54dc87f0e914f3_32471648')) {function content_54dc87f0e914f3_32471648($_smarty_tpl) {?><form id="news_list" action="">
    <div class="row">
        <?php  $_smarty_tpl->tpl_vars['news'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['news']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['feed']['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['news']->key => $_smarty_tpl->tpl_vars['news']->value) {
$_smarty_tpl->tpl_vars['news']->_loop = true;
?>

            <?php if ($_smarty_tpl->tpl_vars['view_type']->value==1) {?>
                <div class="col-md-4 col-sm-6 news-tile feed-item">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-ok"></span>
                            <h3 class="panel-title"><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['news']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>
</a></h3>
                        </div>
                        <div class="panel-body">
                            <?php if (isset($_smarty_tpl->tpl_vars['news']->value['feed_name'])) {?>
                                <div class="panel-date"><b>Лента:</b> <?php echo $_smarty_tpl->tpl_vars['news']->value['feed_name'];?>
</div><br/>
                            <?php }?>
                            <div class="panel-date"><b>Дата:</b> <?php echo $_smarty_tpl->tpl_vars['news']->value['date'];?>
</div><br/>

                            <input name="news_id[]" type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['news']->value['news_id'];?>
" />

                            <div><?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['news']->value['desc']);?>
  </div><br/>

                            <div><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['news']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['news']->value['image'];?>
</a></div>
                        </div>
                    </div>
                </div>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['view_type']->value==2) {?>
                <div class="col-md-12 news-default feed-item">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="glyphicon glyphicon-ok"></span> <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['news']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>
</a></h3>
                        </div>
                        <div class="panel-body">
                            <?php if (isset($_smarty_tpl->tpl_vars['news']->value['feed_name'])) {?>
                                <div class="panel-date"><b>Лента:</b> <?php echo $_smarty_tpl->tpl_vars['news']->value['feed_name'];?>
</div><br/>
                            <?php }?>
                            <div class="panel-date"><b>Дата:</b> <?php echo $_smarty_tpl->tpl_vars['news']->value['date'];?>
</div><br/>

                            <input name="news_id[]" type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['news']->value['news_id'];?>
" />

                            <div><?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['news']->value['desc']);?>
  </div><br/>

                            <div><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['news']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['news']->value['image'];?>
</a></div>
                        </div>
                    </div>
                </div>
            <?php }?>


        <?php } ?>
    </div>
</form><?php }} ?>
