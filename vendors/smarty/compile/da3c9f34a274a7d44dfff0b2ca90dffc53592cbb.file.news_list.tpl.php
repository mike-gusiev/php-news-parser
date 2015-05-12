<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-04-21 03:33:28
         compiled from "application/views/assets/news_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:68541599554ff6ac99e4203-88230317%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da3c9f34a274a7d44dfff0b2ca90dffc53592cbb' => 
    array (
      0 => 'application/views/assets/news_list.tpl',
      1 => 1429587201,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '68541599554ff6ac99e4203-88230317',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54ff6ac9ca8681_88560066',
  'variables' => 
  array (
    'data' => 0,
    'view_type' => 0,
    'news' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ff6ac9ca8681_88560066')) {function content_54ff6ac9ca8681_88560066($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include '/home/perepelka/public_html/parser/vendors/smarty/plugins/modifier.replace.php';
?><form id="news_list" action="">
    <div class="row">
        <?php  $_smarty_tpl->tpl_vars['news'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['news']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['feed']['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['news']->key => $_smarty_tpl->tpl_vars['news']->value) {
$_smarty_tpl->tpl_vars['news']->_loop = true;
?>

            <?php if ($_smarty_tpl->tpl_vars['view_type']->value==1) {?>
                <?php if ($_smarty_tpl->tpl_vars['data']->value['status']==2) {?>
            <div class="col-md-6 col-sm-12 news-tile feed-item">
                <?php } else { ?>
            <div class="col-md-4 col-sm-6 news-tile feed-item">
                <?php }?>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['view_type']->value==2) {?>
            <div class="col-md-12 news-default feed-item">
            <?php }?>

                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-ok"></span>
                        <h3 class="panel-title"><a target="_blank" href="<?php if (isset($_smarty_tpl->tpl_vars['news']->value['link'])) {
echo $_smarty_tpl->tpl_vars['news']->value['link'];
} else { ?>javascript:void(1);<?php }?>"><?php if ($_smarty_tpl->tpl_vars['news']->value['title']) {
echo $_smarty_tpl->tpl_vars['news']->value['title'];
} else { ?>&lt;Нет заголовка&gt;<?php }?></a></h3>
                    </div>
                    <div class="panel-body">

                        <?php if (isset($_smarty_tpl->tpl_vars['news']->value['feed_name'])) {?>
                            <div class="panel-date"><b>Лента:</b> <?php echo $_smarty_tpl->tpl_vars['news']->value['feed_name'];?>
</div><br/>
                        <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['news']->value['date']&&$_smarty_tpl->tpl_vars['news']->value['date']!='none') {?>
                            <div class="panel-date"><b>Дата:</b> <?php echo $_smarty_tpl->tpl_vars['news']->value['date'];?>
</div><br/>
                        <?php }?>

                        <input name="news_id[]" type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['news']->value['news_id'];?>
" />

                        <?php if ($_smarty_tpl->tpl_vars['news']->value['date']&&$_smarty_tpl->tpl_vars['news']->value['desc']!='none') {?>
                            <div><?php echo htmlspecialchars(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['news']->value['desc']), ENT_QUOTES, 'UTF-8', true);?>
</div><br/>
                        <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['news']->value['image']&&$_smarty_tpl->tpl_vars['news']->value['image']!='none') {?>
                            <div class="img-block">
                                <a target="_blank" href="<?php if (isset($_smarty_tpl->tpl_vars['news']->value['link'])) {
echo $_smarty_tpl->tpl_vars['news']->value['link'];
} else { ?>javascript:void(1);<?php }?>"><?php echo $_smarty_tpl->tpl_vars['news']->value['image'];?>
 </a>
                            </div>
                        <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['news']->value['full']&&$_smarty_tpl->tpl_vars['news']->value['full']!='none') {?>
                            <a class="show-full-text" onclick="$('#modal_<?php echo $_smarty_tpl->tpl_vars['news']->value['news_id'];?>
').modal('show')" href="javascript:void(1);"><span class="glyphicon glyphicon-comment"></span></a>
                        <?php }?>

                        <div class="clearfix"></div>
                        <br/>
                        
                            
                                
                            
                        

                        <div class="bg-primary clearfix">
                            <?php if (!isset($_smarty_tpl->tpl_vars['news']->value['link'])) {?><p><span>Ссылка:</span> не найдено</p><?php }?>
                            <?php if (!$_smarty_tpl->tpl_vars['news']->value['desc']) {?> <p><span>Описание:</span> не найдено</p><?php }?>
                            <?php if (!$_smarty_tpl->tpl_vars['news']->value['full']) {?> <p><span>Текст статьи:</span> не найдено</p><?php }?>
                            <?php if (!$_smarty_tpl->tpl_vars['news']->value['image']) {?> <p><span>Картинка:</span> не найдено</p><?php }?>
                            <?php if (!$_smarty_tpl->tpl_vars['news']->value['date']) {?> <p><span>Дата:</span> не найдено</p><?php }?>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal fade full_text" id="modal_<?php echo $_smarty_tpl->tpl_vars['news']->value['news_id'];?>
">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><?php if ($_smarty_tpl->tpl_vars['news']->value['title']) {
echo $_smarty_tpl->tpl_vars['news']->value['title'];
} else { ?>&lt;Нет заголовка&gt;<?php }?></h4>
                        </div>
                        <div class="modal-body">
                            <?php if ($_smarty_tpl->tpl_vars['news']->value['full']) {?>

                                <?php if ($_smarty_tpl->tpl_vars['news']->value['image']) {?>
                                    <p><?php echo $_smarty_tpl->tpl_vars['news']->value['image'];?>
</p>
                                <?php }?>

                                <?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['news']->value['full'],'script','');?>

                            <?php } else { ?>&lt;Нет контента&gt;<?php }?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
        <?php } ?>
    </div>
</form><?php }} ?>
