<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-12 21:21:09
         compiled from "application/views/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:159219092254b3a0640790c3-62643241%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e23c6dd7427db430631aa2a3a6bdfaab0839adda' => 
    array (
      0 => 'application/views/index.tpl',
      1 => 1423772450,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '159219092254b3a0640790c3-62643241',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54b3a064309e64_53115221',
  'variables' => 
  array (
    'subfolder' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54b3a064309e64_53115221')) {function content_54b3a064309e64_53115221($_smarty_tpl) {?><!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AutoParser v1.0</title>

    <link href="/<?php echo $_smarty_tpl->tpl_vars['subfolder']->value;?>
images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

    <link href="/<?php echo $_smarty_tpl->tpl_vars['subfolder']->value;?>
vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/<?php echo $_smarty_tpl->tpl_vars['subfolder']->value;?>
vendors/bootstrap/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/<?php echo $_smarty_tpl->tpl_vars['subfolder']->value;?>
css/main.css"/>

    <!--[if lt IE 9]>
    <?php echo '<script'; ?>
 src="/<?php echo $_smarty_tpl->tpl_vars['subfolder']->value;?>
vendors/bootstrap/js/html5shiv.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/<?php echo $_smarty_tpl->tpl_vars['subfolder']->value;?>
vendors/bootstrap/js/respond.min.js"><?php echo '</script'; ?>
>
    <![endif]-->
</head>
<body>

<div class="container">

    <div class="ribbon-box">
        <div class="ribbon">
            <div class="ribbon-stitches-top"></div>
            <strong class="ribbon-content">
                <h1>
                    <a href="/<?php echo $_smarty_tpl->tpl_vars['subfolder']->value;?>
news">Новости</a> |
                    <a href="/<?php echo $_smarty_tpl->tpl_vars['subfolder']->value;?>
feeds">Ленты</a> |
                    <a href="/<?php echo $_smarty_tpl->tpl_vars['subfolder']->value;?>
sites">Cайты</a>
                </h1>
            </strong>
            <div class="ribbon-stitches-bottom"></div>
        </div>

    </div>

    <div class="form-container">

        <?php if (isset($_GET['opp'])) {?>
            <?php if ($_GET['opp']=='success') {?>
            <div class="bg-success">Готово!</div>
            <?php } else { ?>
            <div class="bg-danger">Не получилось!</div>
            <?php }?>
        <?php }?>

        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['content_view']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    </div>

</div>

<?php echo '<script'; ?>
 src="/<?php echo $_smarty_tpl->tpl_vars['subfolder']->value;?>
vendors/jquery/jquery-1.11.2.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/<?php echo $_smarty_tpl->tpl_vars['subfolder']->value;?>
vendors/bootstrap/js/bootstrap.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/<?php echo $_smarty_tpl->tpl_vars['subfolder']->value;?>
vendors/bootstrap/js/bootstrap-select.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/<?php echo $_smarty_tpl->tpl_vars['subfolder']->value;?>
js/main.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/<?php echo $_smarty_tpl->tpl_vars['subfolder']->value;?>
js/<?php echo Route::$controller_name;?>
.js"><?php echo '</script'; ?>
>
</body>
</html><?php }} ?>
