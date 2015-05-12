<?php

function __dle_translit($string)
{
    $table = array(
        'А' => 'A',
        'Б' => 'B',
        'В' => 'V',
        'Г' => 'G',
        'Д' => 'D',
        'Е' => 'E',
        'Ё' => 'YO',
        'Ж' => 'ZH',
        'З' => 'Z',
        'И' => 'I',
        'Й' => 'J',
        'К' => 'K',
        'Л' => 'L',
        'М' => 'M',
        'Н' => 'N',
        'О' => 'O',
        'П' => 'P',
        'Р' => 'R',
        'С' => 'S',
        'Т' => 'T',
        'У' => 'U',
        'Ф' => 'F',
        'Х' => 'H',
        'Ц' => 'C',
        'Ч' => 'CH',
        'Ш' => 'SH',
        'Щ' => 'CSH',
        'Ь' => '',
        'Ы' => 'Y',
        'Ъ' => '',
        'Э' => 'E',
        'Ю' => 'YU',
        'Я' => 'YA',

        'а' => 'a',
        'б' => 'b',
        'в' => 'v',
        'г' => 'g',
        'д' => 'd',
        'е' => 'e',
        'ё' => 'yo',
        'ж' => 'zh',
        'з' => 'z',
        'и' => 'i',
        'й' => 'j',
        'к' => 'k',
        'л' => 'l',
        'м' => 'm',
        'н' => 'n',
        'о' => 'o',
        'п' => 'p',
        'р' => 'r',
        'с' => 's',
        'т' => 't',
        'у' => 'u',
        'ф' => 'f',
        'х' => 'h',
        'ц' => 'c',
        'ч' => 'ch',
        'ш' => 'sh',
        'щ' => 'csh',
        'ь' => '',
        'ы' => 'y',
        'ъ' => '',
        'э' => 'e',
        'ю' => 'yu',
        'я' => 'ya',

        ' ' => '-',
    );

    $output = str_replace(
        array_keys($table),
        array_values($table),$string
    );

    $output = mb_strtolower(trim($output));
    $output = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $output);
    $output = preg_replace("/[\/_|+ -]+/", '-', $output);

    return $output;
}

function dle_add($site, $article)
{

    if(count($site) && count($article)) {

        $db_config = array(
            'type'      => "mysql",
            'port'      => 3306,
            'hostname'  => $site['dbhost'],
            'username'  => $site['dbuser'],
            'password'  => $site['dbpass'],
            'database'  => $site['dbname'],
            'setnames'  => $site['dbcharset'],
        );


        $DB = DbSimple_Generic::connect(
            $db_config['type'] . '://' .
            $db_config['username'] . ':' .
            $db_config['password'] . '@' .
            $db_config['hostname'] . '/' .
            $db_config['database']
        );

        $DB->setErrorHandler('databaseErrorHandler');

        @$DB->query('SET NAMES ?', $db_config['setnames']);

        $thistime = date( "Y-m-d H:i:s", time() );

        $desc =  '<p>'. str_replace('<img', '<img class="preview__thumb preview__thumb_pattern_transparent"', $article['image']).'</p>'. strip_tags($article['desc']);
        $full = '<p>'. str_replace('<img', '<img class="preview__thumb preview__thumb_pattern_transparent"', $article['image']).'</p>'. $article['full'];
        $title = $article['title'];
        $link = __dle_translit($title);
        $descr = strip_tags($article['desc']);

//        echo '<pre>' . print_r(mb_detect_encoding($full), true) . '</pre>';
//        die();

        $desc = iconv("utf-8", "windows-1251//TRANSLIT", $desc);
        $full = iconv("utf-8", "windows-1251//TRANSLIT", $full);
        $title = iconv("utf-8", "windows-1251//TRANSLIT", $title);
        $descr = iconv("utf-8", "windows-1251//TRANSLIT", $descr);


        $category = 1;


        $sql = "
            INSERT INTO dle_post
            (
                date,
                autor,
                short_story,
                full_story,
                xfields,
                title,
                keywords,
                category,
                alt_name,
                allow_comm,
                approve,
                allow_main,
                fixed,
                allow_br,
                symbol,
                tags,
                descr
            )
                values
            (
                '$thistime',
                'admin',
                '". mysql_real_escape_string( $desc )."',
                '". mysql_real_escape_string( $full ) ."',
                '',
                '". mysql_real_escape_string( $title ) ."',
                '',
                '{$category}',
                '". ($link) ."',
                '0',
                '1',
                '1',
                '0',
                '1',
                '',
                '',
                '{$descr}'
            )
        ";


        $news_id = $DB->query($sql);


        $DB->query( "INSERT INTO dle_post_extras (news_id, allow_rate, votes, user_id ) VALUES ( '{$news_id}', '1', '0', '1')" );
        $DB->query( "UPDATE dle_images set news_id='$news_id' where author = 'admin' AND news_id = '0'" );
        $DB->query( "UPDATE dle_files set news_id='$news_id' where author = 'admin' AND news_id = '0'" );
        $DB->query( "UPDATE dle_users set news_num=news_num+1 where user_id='admin'" );

        if(json_encode($title) == 'null') $title = $article['title'];

        $result_text = '<p>'.$news_id.' <a target="_blank" href="http://'.$site['url'].'/admin.php?mod=editnews&action=editnews&id='.$news_id.'">'.$title.'</a></p><br/>';

        return $result_text;
    }


}

function dle_cats($site)
{
    $cats = Array();

    if(count($site)) {

        $db_config = array(
            'type'      => "mysql",
            'port'      => 3306,
            'hostname'  => $site['dbhost'],
            'username'  => $site['dbuser'],
            'password'  => $site['dbpass'],
            'database'  => $site['dbname'],
            'setnames'  => $site['dbcharset'],
        );


        $DB = DbSimple_Generic::connect(
            $db_config['type'] . '://' .
            $db_config['username'] . ':' .
            $db_config['password'] . '@' .
            $db_config['hostname'] . '/' .
            $db_config['database']
        );

        $sql = "SELECT id, name FROM dle_category";

        $result = $DB->query($sql);

        if($result) $cats = $result;
    }

    return $cats;
}

?>