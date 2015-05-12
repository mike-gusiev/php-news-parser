<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AutoParser v1.0</title>

    <link href="/{$subfolder}images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

    <link href="/{$subfolder}vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/{$subfolder}vendors/bootstrap/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/{$subfolder}css/main.css?v=3"/>

    <!--[if lt IE 9]>
    <script src="/{$subfolder}vendors/bootstrap/js/html5shiv.min.js"></script>
    <script src="/{$subfolder}vendors/bootstrap/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="container">

    <div class="ribbon-box">
        <div class="ribbon">
            <div class="ribbon-stitches-top"></div>
            <strong class="ribbon-content">
                <h1>
                    <a href="/{$subfolder}news">Новости</a> |
                    <a href="/{$subfolder}feeds">Ленты</a> |
                    <a href="/{$subfolder}sites">Cайты</a>
                </h1>
            </strong>
            <div class="ribbon-stitches-bottom"></div>
        </div>

    </div>

    <div class="form-container">

        {if isset($smarty.get.opp)}
            {if $smarty.get.opp == 'success'}
            <div class="bg-success">Готово!</div>
            {else}
            <div class="bg-danger">Не получилось!</div>
            {/if}
        {/if}

        {include file="$content_view"}
    </div>

</div>

<script src="/{$subfolder}vendors/jquery/jquery-1.11.2.min.js"></script>
<script src="/{$subfolder}vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="/{$subfolder}vendors/bootstrap/js/bootstrap-select.min.js"></script>
<script src="/{$subfolder}vendors/masonry.pkgd.min.js"></script>
<script src="/{$subfolder}js/main.js"></script>
<script src="/{$subfolder}js/{Route::$controller_name}.js"></script>
</body>
</html>