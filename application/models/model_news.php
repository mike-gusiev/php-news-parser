<?php

function __rc_callback($response, $info, $request) {

    $url = $request->url;
    $id = 0;
    if (preg_match("~\?id=(.*)$~i", $url, $out)) {
        $id = $out[1];
    }

    if($id && strlen(trim($response)) > 0) {

        $dom = new DOMDocument();
        @$dom->loadHTML($response);

        $xpath = new DOMXPath( $dom );

        $items = GlobalStorage::get('items');
        $feed = GlobalStorage::get('feed');

        foreach($items as $k => $v) {
            if($items[$k]['news_id'] == $id) {

                if($items[$k]['title'] == 'parsed') {
                    $rule = $feed['rule_title'];
                    $_res = $xpath->query(trim($rule));
                    if(@$_res->length) {
                        $tmp = strip_tags($dom->saveHTML($_res->item(0)));
                        if(strlen($tmp) > 120) $tmp = mb_substr($tmp, 0, 120) . '...';

                        //mega hack for attribute xpath ;)
                        if(strpos($feed['rule_title'], '/@') !== false) {
                            $temp = explode('/@',$feed['rule_title']);
                            $param = end($temp);

                            if(strpos($tmp, $param.'=') !== false) {
                                $tmp = str_replace($param.'=','', $tmp);
                                $tmp = str_replace('"','', $tmp);
                            }

                        }

                        $items[$k]['title'] = $tmp;
                    } else {
                        $items[$k]['title'] = false;
                    }
                }

                if($items[$k]['image'] == 'parsed') {
                    $rule = $feed['rule_image'];
                    $_res = $xpath->query(trim($rule));
                    if(@$_res->length) {
                        $tmp = $dom->saveHTML($_res->item(0));

                        //if gotten text is not valid html tag (it could be just a link on image)
                        if(strpos($tmp,'<img') === false && strpos($tmp, 'http') !== false) {

                            //mega hack for attribute xpath ;)
                            if(strpos($feed['rule_image'], '/@') !== false) {
                                $temp = explode('/@',$feed['rule_image']);
                                $param = end($temp);

                                if(strpos($tmp, $param.'=') !== false) {
                                    $tmp = str_replace($param.'=','', $tmp);
                                    $tmp = str_replace('"','', $tmp);
                                }

                            }

                            $tmp = '<img align="left" src="'.$tmp.'" alt="" />';

                        }

                        //making responsive image
                        if($tmp) {
                            if(strpos($tmp,'class=') === false) {
                                $tmp = str_replace('<img','<img class="img-responsive"', $tmp);
                            } else {
                                if(strpos($tmp,'class="') !== false) $tmp = str_replace('class="','class="img-responsive ', $tmp);
                                if(strpos($tmp,"class='") !== false) $tmp = str_replace("class='","class='img-responsive ", $tmp);
                            }
                        }

                        //if img is internal, we should add website prefix
                        $old_src = '';
                        $img_src = '';

                        if (preg_match('~src="([^"]*)~i', $tmp, $out)) {
                            $old_src = $out[1];
                            $img_src = $out[1];
                        }

                        if (preg_match("~src='([^']*)~i", $tmp, $out)) {
                            $old_src = $out[1];
                            $img_src = $out[1];
                        }

                        if(strlen($old_src) && strpos($img_src, 'http') === false) {
                            $img_src = $feed['rss'] . $img_src;
                            $img_src = str_replace('//','/', $img_src);
                            $img_src = str_replace('http:/','http://', $img_src);
                            $tmp = str_replace($old_src, $img_src, $tmp);

                        }

                        $items[$k]['image'] = $tmp;
                    } else {
                        $items[$k]['image'] = false;
                    }
                }

                if($items[$k]['desc'] == 'parsed') {
                    $rule = $feed['rule_desc'];
                    $_res = $xpath->query(trim($rule));
                    if(@$_res->length) {
                        $tmp = strip_tags($dom->saveHTML($_res->item(0)));
                        if(strlen($tmp) > 300) $tmp = mb_substr($tmp, 0, 300) . '...';

                        //mega hack for attribute xpath ;)
                        if(strpos($feed['rule_desc'], '/@') !== false) {
                            $temp = explode('/@',$feed['rule_desc']);
                            $param = end($temp);

                            if(strpos($tmp, $param.'=') !== false) {
                                $tmp = str_replace($param.'=','', $tmp);
                                $tmp = str_replace('"','', $tmp);
                            }

                        }

                        $items[$k]['desc'] = $tmp;
                    } else {
                        $items[$k]['desc'] = false;
                    }
                }

                if($items[$k]['full'] == 'parsed') {
                    $rule = $feed['rule_full'];
                    $_res = $xpath->query(trim($rule));
                    if(@$_res->length) {
                        $str = '';
                        for($i=0; $i < $_res->length; $i++) {
                            $str.= $dom->saveHTML($_res->item($i));
                        }

                        //adding prefix to internal links
                        if(preg_match_all('/href="([^"]*)/',$str, $out)) {

                            $is_good = true;
                            if(isset($out[1][0]) && $out[1][0] == '#') $is_good = false;
                            if(!is_array($out)) $is_good = false;


                            if($is_good) {
                                for($i=1; $i<=count($out); $i++) {
                                    if(!isset($out[$i])) continue;

                                    $old_link = $out[$i];

                                    //bugfix
                                    if(is_array($old_link)) $old_link = $old_link[0];

                                    if(strpos($old_link, 'http') === false) {

                                        $new_link = $feed['rss'] . $old_link;
                                        $new_link = str_replace('//','/', $new_link);
                                        $new_link = str_replace('http:/','http://', $new_link);
                                        $str = str_replace($old_link, $new_link, $str);
                                    }
                                }
                            }

                        }


                        //if img is internal, we should add website prefix
                        $found_images = Array();

                        if (preg_match_all('~src="([^"]*)~i', $str, $out)) {
                            $found_images = $out;
                        }

                        if (preg_match_all("~src='([^']*)~i", $str, $out)) {
                            $found_images = $out;
                        }


                        for($i=1; $i<=count($found_images); $i++) {
                            if(!isset($found_images[$i])) continue;

                            $old_src = $found_images[$i];
                            $img_src = $old_src;

                            //bugfix
                            if(is_array($old_src)) $old_src = $old_src[0];
                            if(is_array($img_src)) $img_src = $img_src[0];


                            if(strlen($old_src) && strpos($img_src, 'http') === false) {
                                $img_src = $feed['rss'] . $img_src;
                                $img_src = str_replace('//','/', $img_src);
                                $img_src = str_replace('http:/','http://', $img_src);
                                $str = str_replace($old_src, $img_src, $str);

                            }
                        }

                        //removing image dublicates
                        if(strlen($items[$k]['image']) && $items[$k]['image'] != 'none') {

                            $img_full = str_replace('class="img-responsive" ','',$items[$k]['image']);

                            if(strpos($str, $img_full) !== false) {
                                $str = str_replace($img_full,'',$str);
                            }

                            if(preg_match('/src="([^"]*)/',$items[$k]['image'], $out)) {
                                $link = $out[1];
                                $str = str_replace($link, '', $str);
                            }

                            if(preg_match("/src='([^']*)/",$items[$k]['image'], $out)) {
                                $link = $out[1];
                                $str = str_replace($link, '', $str);
                            }
                        }

                        //making all images responsive
                        $pat = '/(<img) ?(([^>]*)class="([^"]*)")?/';
                        $str = preg_replace($pat, '$1 $3 class="$4 img-responsive" ', $str);

                        $pat = "/(<img) ?(([^>]*)class='([^']*)')?/";
                        $str = preg_replace($pat, '$1 $3 class="$4 img-responsive" ', $str);

                        $items[$k]['full'] = $str;
                    }
                    else $items[$k]['full'] = false;
                }

                if($items[$k]['date'] == 'parsed') {
                    $rule = $feed['rule_date'];
                    $_res = $xpath->query(trim($rule));
                    if(@$_res->length) {
                        $tmp = strip_tags($dom->saveHTML($_res->item(0)));
                        if(strlen($tmp) > 80) $tmp = mb_substr($tmp, 0, 80) . '...';

                        //mega hack for attribute xpath ;)
                        if(strpos($feed['rule_date'], '/@') !== false) {
                            $temp = explode('/@',$feed['rule_date']);
                            $param = end($temp);

                            if(strpos($tmp, $param.'=') !== false) {
                                $tmp = str_replace($param.'=','', $tmp);
                                $tmp = str_replace('"','', $tmp);
                            }

                        }

                        $items[$k]['date'] = $tmp;
                    } else {
                        $items[$k]['date'] = false;
                    }
                }

            }
        }

        GlobalStorage::set('items', $items);
    }

}

class Model_News extends Model
{
    private $parse_counter = Array ();
    private $parse_limit = 20;
    private $rc = null;

    private function __parse_title($feed, $xpath)
    {
        $result = false;

        $_res = $xpath->query('//channel/title');
        if($_res->length) $result = $_res->item(0)->nodeValue;

        return $result;
    }

    private function __parse_image($feed, $xpath)
    {
        $result = false;

        $_res = $xpath->query('//channel/image/*');
        if($_res->length) {
            $image = Array();

            foreach($_res as $obj) {
                $image[$obj->tagName] = $obj->nodeValue;
            }

            $result = $image;
        }

        return $result;
    }

    private function __parse_desc($feed, $xpath)
    {
        $result = false;

        $_res = $xpath->query('//channel/description');
        if($_res->length) $result = $_res->item(0)->nodeValue;

        return $result;
    }

    private function __parse_items($feed, $xpath)
    {
        return $xpath->query('//channel/item');
    }

    private function __parse_items_html($feed, $xpath)
    {
        return $xpath->query($feed['rule_base']);
    }

    private function __parse_item_title($feed, $xpath, $item)
    {
        $result = false;

        if(strlen(trim($feed['rule_title']))) {
            @$_res = $xpath->query(trim($feed['rule_title']), $item);
            if(@$_res->length) $result = $_res->item(0)->nodeValue;

            if($result == false) {
                if($this->parse_counter['title'] >= $this->parse_limit) {
                    $result = 'limit';
                } else {
                    $result = 'parsed';
                    $this->parse_counter['title']++;
                }
            }
        } else {
            $_res = $xpath->query('title', $item);
            if($_res->length) $result = $_res->item(0)->nodeValue;
        }

        if(strlen($result) > 200) $result = mb_substr($result, 0, 200) . '...';

        return $result;
    }

    private function __parse_item_base($feed, $xpath, $item)
    {
        $result = false;

        if(strlen(trim($feed['rule_base']))) {
            @$_res = $xpath->query(trim($feed['rule_base']), $item);
            if(@$_res->length) $result = $_res->item(0)->nodeValue;
        } else {
            $_res = $xpath->query('link', $item);
            if($_res->length) $result = $_res->item(0)->nodeValue;
        }

        if(strpos($result, 'http') === false) $result = false;

        return $result;
    }

    private function __parse_item_desc($feed, $xpath, $item)
    {
        $result = false;

        if(strlen(trim($feed['rule_desc']))) {
            @$_res = $xpath->query(trim($feed['rule_desc']), $item);
            if(@$_res->length) {
                $result = $_res->item(0)->nodeValue;
                if(strlen($result) > 300) $result = mb_substr($result, 0, 300) . '...';
            }

            if($result == false) {
                if($this->parse_counter['desc'] >= $this->parse_limit) {
                    $result = 'limit';
                } else {
                    $result = 'parsed';
                    $this->parse_counter['desc']++;
                }
            }
        } else {
            $_res = $xpath->query('description', $item);
            if($_res->length) {
                $result = $_res->item(0)->nodeValue;
                if(strlen($result) > 300) $result = mb_substr($result, 0, 300) . '...';
            }
        }

        return $result;
    }

    private function __parse_item_full($feed, $xpath, $item)
    {
        $result = false;

        if(strlen(trim($feed['rule_full']))) {
            @$_res = $xpath->query(trim($feed['rule_full']), $item);
            if(@$_res->length) $result = $_res->item(0)->nodeValue;

            if($result == false) {
                if($this->parse_counter['full'] >= $this->parse_limit) {
                    $result = 'limit';
                } else {
                    $result = 'parsed';
                    $this->parse_counter['full']++;
                }
            }

        } else {
            $_res = $xpath->query('fulltext', $item);
            if($_res->length) $result = $_res->item(0)->nodeValue;
        }

        return $result;
    }

    private function __parse_item_image($feed, $xpath, $item)
    {
        $result = false;

        if(strlen(trim($feed['rule_image']))) {
            @$_res = $xpath->query(trim($feed['rule_image']), $item);
            if(@$_res->length) {
                $result = $_res->item(0)->nodeValue;
                if(strpos($result, 'src=') === false) $result = '<img align="left" src="'.$result.'" alt="" />';
            }

            if($result == false) {
                if($this->parse_counter['image'] >= $this->parse_limit) {
                    $result = 'limit';
                } else {
                    $result = 'parsed';
                    $this->parse_counter['image']++;
                }
            }
        } else {

            $_res = $xpath->query('image', $item);
            if($_res->length) $result = $_res->item(0)->nodeValue;

            if($result == false) {
                $_res = $xpath->query('enclosure/@url', $item);
                if($_res->length) $result = '<img align="left" src="'.$_res->item(0)->nodeValue.'" alt="" />';
            }
        }

        //making responsive image
        if($result) {
            if(strpos($result,'class=') === false) {
                $result = str_replace('<img','<img class="img-responsive"', $result);
            } else {
                if(strpos($result,'class="') !== false) $result = str_replace('class="','class="img-responsive ', $result);
                if(strpos($result,"class='") !== false) $result = str_replace("class='","class='img-responsive ", $result);
            }
        }

        return $result;
    }

    private function __parse_item_date($feed, $xpath, $item)
    {
        $result = false;

        if(strlen(trim($feed['rule_date']))) {
            @$_res = $xpath->query(trim($feed['rule_date']), $item);
            if(@$_res->length) $result = $_res->item(0)->nodeValue;

            if($result == false) {
                if($this->parse_counter['date'] >= $this->parse_limit) {
                    $result = 'limit';
                } else {
                    $result = 'parsed';
                    $this->parse_counter['date']++;
                }
            }
        } else {
            $_res = $xpath->query('pubDate', $item);
            if($_res->length) $result = $_res->item(0)->nodeValue;
        }



        return $result;
    }

    public function get_data()
    {

        $feeds = unserialize(file_get_contents('db/feeds.db'));

        $result = Array(
            'status' => 1,
            'feeds'  => $feeds,
        );

        return $result;
    }

    public function feed($get)
    {
        $result = Array(
            'status' => 0,
        );

        $this->parse_limit = GlobalStorage::get('parse_limit');
        $this->parse_counter['title'] = 0;
        $this->parse_counter['desc'] = 0;
        $this->parse_counter['full'] = 0;
        $this->parse_counter['date'] = 0;
        $this->parse_counter['image'] = 0;

        if(!isset($get['id']) || !intval($get['id']) ) {
            $result['error'] = 'Не указан ID ленты!';
            return $result;
        }

        /* getting feed from db */
        $feeds = unserialize(file_get_contents('db/feeds.db'));
        $id = intval($get['id']);

        $feed = Array();

        foreach($feeds as $v) {
            if($v['id'] == $id) {
                $feed = $v;
            }
        }

        if(empty($feed)) {
            $result['error'] = 'Не найдена лента с таким ID!';
            return $result;
        }

        $result['feed'] = $feed;
        /* getting feed from db (end) */

        /* parsing feed */
        $feed_text = file_get_contents($feed['rss']);

        $dom = new DOMDocument();

        if($feed['feed_type'] == 1) {
            @$dom->loadXML($feed_text);
        } elseif($feed['feed_type'] == 2) {
            @$dom->loadHTML($feed_text);
        }

        if($dom->childNodes->length){
            $xpath = new DOMXPath( $dom );
            $items = Array();
            $_res = Array();

            //rss+html
            if($feed['feed_type'] == 1) {
                //feed page info
                $result['feed']['title'] = $this->__parse_title($feed, $xpath);
                $result['feed']['image'] = $this->__parse_image($feed, $xpath);
                $result['feed']['description'] = $this->__parse_desc($feed, $xpath);

                //items
                $_res = $this->__parse_items($feed, $xpath);
            }

            //xhtml
            if($feed['feed_type'] == 2) {

                if(strlen($feed['rule_base'])) {
                    $_res = $this->__parse_items_html($feed, $xpath);
                }

            }

            foreach($_res as $item) {
                $new_item = Array();
                $new_item['news_id'] = rand(10000, 100000);

                if($feed['feed_type'] == 1) {
                    $new_item['link'] = $this->__parse_item_base($feed, $xpath, $item);
                }elseif($feed['feed_type'] == 2) {
                    $new_item['link'] = $item->getAttribute('href');

                    //if link is internal, we should add website prefix for parsing
                    if(strpos($new_item['link'], 'http') === false) {
                        $new_item['link'] = $feed['rss'] . $new_item['link'];
                        $new_item['link'] = str_replace('//','/', $new_item['link']);
                        $new_item['link'] = str_replace('http:/','http://', $new_item['link']);

                    }
                }

                if($feed['rule_title'] != 'none') {
                    $new_item['title'] = $this->__parse_item_title($feed, $xpath, $item);
                } else $new_item['title'] = 'none';


                if($feed['rule_desc'] != 'none') {
                    $new_item['desc'] = $this->__parse_item_desc($feed, $xpath, $item);
                } else $new_item['desc'] = 'none';

                if($feed['rule_full'] != 'none') {
                    $new_item['full'] = $this->__parse_item_full($feed, $xpath, $item);
                } else $new_item['full'] = 'none';

                if($feed['rule_image'] != 'none') {
                    $new_item['image'] = $this->__parse_item_image($feed, $xpath, $item);
                } else $new_item['image'] = 'none';

                if($feed['rule_date'] != 'none') {
                    $new_item['date'] = $this->__parse_item_date($feed, $xpath, $item);
                } else $new_item['date'] = 'none';

                if($new_item['title'] != 'limit') $items[] = $new_item;

            }

            GlobalStorage::set('items', $items);
            GlobalStorage::set('feed', $feed);
            /* parsing feed (end) */


            /* parsing feed items */
            if($this->parse_counter) {
                require_once 'vendors/RollingCurl.php';

                $urls = Array();

                foreach($items as $item) {
                    foreach($item as $k => $v) {
                        if($v == 'parsed') {
                            $urls[] = $item['link'] . '?id=' . $item['news_id'];
                            break;
                        }
                    }
                }

                $this->rc = new RollingCurl('__rc_callback');
                $this->rc->window_size = $this->parse_limit;

                //adding links for parsing
                $must_parse = 0;
                foreach ($urls as $url) {
                    if(strpos($url, 'http') !== false) {
                        $this->rc->get($url);
                        $must_parse++;
                    }
                }

                //if have links to parse (links are correct)
                if($must_parse) {
                    $this->rc->execute();
                } else {
                    $items = GlobalStorage::get('items');

                    //toogle everyting to false
                    foreach($items as $k => $v) {
                        foreach($items[$k] as $i => $w) {
                            if($w == 'parsed') $items[$k][$i] = false;
                        }
                    }

                    GlobalStorage::set('items', $items);
                }
            }
            /* parsing feed items (end) */

            $result['feed']['news'] = GlobalStorage::get('items');
            file_put_contents('db/parse.db',serialize($result['feed']['news']));
        } else {
            $result['feed']['news'] = Array();
        }

        $result['status'] = 2;
        return $result;
    }

    public function get_all($feeds)
    {
        $all_feeds = Array();

        //try to parse all feeds
        foreach($feeds as $feed_id) {
            $all_feeds[] = $this->feed(Array('id'=>$feed_id));
        }

        $all_news = Array();

        //try to get all news from parsed feeds
        foreach($all_feeds as $feed) {
            if($feed['status'] == 2 && count($feed['feed']['news'])) {

                foreach($feed['feed']['news'] as $k => $v) {
                    $feed['feed']['news'][$k]['feed_name'] = $feed['feed']['name'];
                }

                $all_news = array_merge($feed['feed']['news'], $all_news);
            }
        }

        //sorting news
        usort($all_news, function ($a, $b) {
            $x = strtotime($a['date']);
            $y = strtotime($b['date']);

            if($x == $y) return 0;
            return $x < $y?1:-1;
        });

        file_put_contents('db/parse.db',serialize($all_news));

        //for smarty universal recognition
        return Array('feed' => Array('news'=>$all_news) );
    }

    public function get_view_type()
    {
        $view_type = null;

        if(isset($_GET['vtype'])) {
            $view_type = $_GET['vtype'];
            setcookie('ap_vtype', $_GET['vtype'], (time() + (86400*30)));
        } else {
            $view_type = 1;
            if(isset($_COOKIE['ap_vtype'])) $view_type = intval($_COOKIE['ap_vtype']);
        }

        return $view_type;
    }

    public function get_sites()
    {
        $sites_db = unserialize(file_get_contents('db/sites.db'));
        return Array('sites'=>$sites_db);
    }

    public function add_news($post)
    {
        $sites_id = $post['sites'];
        $news_id = $post['news_id'];

        //getting parsed news to add
        $parsed_pool = unserialize(file_get_contents('db/parse.db'));

        $news = Array();
        foreach($news_id as $id) {
            foreach($parsed_pool as $item) {
                if($item['news_id'] == $id) {
                    $news[] = $item;
                }
            }
        }

        //getting sites to add
        $sites_db = unserialize(file_get_contents('db/sites.db'));

        $sites = Array();
        foreach($sites_id as $id) {
            foreach($sites_db as $item) {
                if($item['id'] == $id) {
                    $sites[] = $item;
                }
            }
        }

        //adding news to sites
        $result_text = '';
        foreach($sites as $site) {
            include_once 'db/cms/' . $site['type'] . '.php';
            $add_func = $site['type'] . '_add';

            $result_text .= '<p><b>'.$site['url'].':</b></p><br/>';
            foreach($news as $article) {
                $result_text .= $add_func($site, $article);
            }

            $result_text .= '<br/><br/>';
        }

        $result = Array(
            'status'   => true,
            'message'  => $result_text,
        );

        echo json_encode($result);
        exit();
    }

    public function change_rule($post)
    {
        $id = 0;
        if(isset($post['id'])) $id = $post['id'];

        $db = unserialize(file_get_contents('db/feeds.db'));

        $found = true;
        foreach($db as $k => $item) {
            if($item['id'] == $id) {
                $found = true;

                $db[$k]['feed_type'] = intval($post['feed_type']);
                $db[$k]['rule_base'] = $post['rule_base'];
                $db[$k]['rule_title'] = $post['rule_title'];
                $db[$k]['rule_image'] = $post['rule_image'];
                $db[$k]['rule_desc'] = $post['rule_desc'];
                $db[$k]['rule_full'] = $post['rule_full'];
                $db[$k]['rule_date'] = $post['rule_date'];
                $db[$k]['comment'] = $post['feed_comment'];
                if(isset($post['feed_active'])) $db[$k]['active'] = 1;
                else $db[$k]['active'] = 0;
            }
        }

        if($found) {
            file_put_contents('db/feeds.db',serialize($db));
        }

    }

    public function get_cats($post)
    {
        $sites = explode(',', $post['sites']);
        $db = unserialize(file_get_contents('db/sites.db'));
        $cats = Array();

        //getting sites info
        foreach($sites as $k => $v) {
            $cats[$v] = Array(
                'found' => false,
            );

            foreach($db as $item) {
                if($item['id'] == $v) {
                    $cats[$v]['found'] = true;
                    $cats[$v]['site'] = $item;
                }
            }
        }

        //getting cats for each site
        foreach($cats as $k => $v) {
            if($v['found']) {
                include_once 'db/cms/'.$v['site']['type'].'.php';

                $cat_func = $v['site']['type'] . '_cats';

                $cats[$k]['cats'] = $cat_func($v['site']);
            }
        }

        echo json_encode($cats);
        die();
    }
}

?>