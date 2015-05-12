<?php

class Model_Sites extends Model
{
    public function get_data()
    {
        $sites_db = unserialize(file_get_contents('db/sites.db'));
        return $sites_db;
    }

    public function add_site($post)
    {
        $sites = unserialize(file_get_contents('db/sites.db'));

        $max = 0;
        foreach($sites as $v)
            if($v['id'] > $max) $max = $v['id'];


        $url = $post['url'];
        $url = preg_replace('/http(s)?:\/\//','',$url);
        $url = preg_replace('/\/$/','',$url);

        $sites[] = Array(
            'id'        => $max+1,
            'url'       => $url,
            'type'      => $post['type'],
            'dbhost'    => $post['dbhost'],
            'dbname'    => $post['dbname'],
            'dbuser'    => $post['dbuser'],
            'dbpass'    => $post['dbpass'],
            'dbcharset' => $post['dbcharset'],
        );

        if(file_put_contents('db/sites.db',serialize($sites))) return true;
        else return false;
    }

    public function del_site($post)
    {
        $sites = unserialize(file_get_contents('db/sites.db'));

        $id = intval($post['id']);


        $new_sites = Array();
        foreach($sites as $v) {
            if($v['id'] == $id) continue;

            $new_sites[] = $v;
        }

        if(file_put_contents('db/sites.db',serialize($new_sites))) return true;
        else return false;
    }

    public function edit_site_get($post)
    {
        $sites = unserialize(file_get_contents('db/sites.db'));
        $id = intval($post['id']);

        $found = false;
        $site = Array();

        foreach($sites as $v) {
            if($v['id'] == $id) {
                $site = $v;
                $found = true;
            }
        }

        if($found) {
            $result = Array(
                'success' => true,
                'site'    => $site,
            );
        } else {
            $result['success'] = false;
        }

        return json_encode($result);
    }

    public function edit_site_put($post)
    {
        $sites = unserialize(file_get_contents('db/sites.db'));
        $id = intval($post['id']);

        $found = false;
        foreach($sites as $k => $v) {
            if($v['id'] == $id) {
                $found = true;

                $sites[$k]['url']       = $post['url'];
                $sites[$k]['type']      = $post['type'];
                $sites[$k]['dbhost']    = $post['dbhost'];
                $sites[$k]['dbname']    = $post['dbname'];
                $sites[$k]['dbuser']    = $post['dbuser'];
                $sites[$k]['dbpass']    = $post['dbpass'];
                $sites[$k]['dbcharset'] = $post['dbcharset'];

            }
        }

        if($found) {
            if(file_put_contents('db/sites.db',serialize($sites))) return true;
            else return false;
        } else {
            return false;
        }
    }

    public function check_site($post)
    {
        $sites = unserialize(file_get_contents('db/sites.db'));
        $id = intval($post['id']);
        $site = Array();

        $found = false;
        foreach($sites as $k => $v) {
            if($v['id'] == $id) {
                $found = true;
                $site = $v;
            }
        }

        if($found) {
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

            $result = Array('status' => true);

            return json_encode($result);
        }

        return $found;
    }

}

?>