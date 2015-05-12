<?php

class Model_Feeds extends Model
{
    public function get_data()
    {
        $feeds_db = unserialize(file_get_contents('db/feeds.db'));
        return $feeds_db;
    }


    public function add_feed($post)
    {
        $feeds = unserialize(file_get_contents('db/feeds.db'));

        $max = 0;
        foreach($feeds as $v)
            if($v['id'] > $max) $max = $v['id'];


        $feeds[] = Array(
            'id'            => $max+1,
            'name'          => $post['name'],
            'rss'           => $post['rss'],
            'rule_base'     => '',
            'rule_title'    => '',
            'rule_image'    => '',
            'rule_desc'     => '',
            'rule_full'     => '',
            'rule_date'     => '',
            'feed_type'     => 1,
            'active'        => 0,
            'comment'       => '',
        );

        if(file_put_contents('db/feeds.db',serialize($feeds))) return true;
        else return false;
    }

    public function del_feed($post)
    {
        $feeds = unserialize(file_get_contents('db/feeds.db'));

        $id = intval($post['id']);


        $new_feeds = Array();
        foreach($feeds as $v) {
            if($v['id'] == $id) continue;

            $new_feeds[] = $v;
        }

        if(file_put_contents('db/feeds.db',serialize($new_feeds))) return true;
        else return false;
    }

    public function edit_feed_get($post)
    {
        $feeds = unserialize(file_get_contents('db/feeds.db'));
        $id = intval($post['id']);

        $found = false;
        $feed = Array();

        foreach($feeds as $v) {
            if($v['id'] == $id) {
                $feed = $v;
                $found = true;
            }
        }

        if($found) {
            $result = Array(
                'success' => true,
                'feed'    => $feed,
            );
        } else {
            $result['success'] = false;
        }

        return json_encode($result);
    }

    public function edit_feed_put($post)
    {
        $feeds = unserialize(file_get_contents('db/feeds.db'));
        $id = intval($post['id']);

        $found = false;
        foreach($feeds as $k => $v) {
            if($v['id'] == $id) {
                $found = true;

                $feeds[$k]['name']  = $post['name'];
                $feeds[$k]['rss']   = $post['rss'];

            }
        }

        if($found) {
            if(file_put_contents('db/feeds.db',serialize($feeds))) return true;
            else return false;
        } else {
            return false;
        }
    }
}

?>