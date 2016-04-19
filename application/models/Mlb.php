<?php

class Saffron_Model_Mlb
{
    public function insertMlbs(array $item)
    {
        $adapter = Zend_Registry::get('adapter');

        $id = $item[ 'GameID' ];

        if(($adapter->fetchOne('SELECT id from game WHERE id = '.$id) == false)) {

            $date = $item['DateTime'];
            $home = $item['HomeTeam'];
            $guest = $item['AwayTeam'];
            $stadium = $item['StadiumID'];

            $query = "insert into game(id, home, guest, plays, stadium) values
                  ($id, '$home', '$guest', '$date', $stadium)";

            $adapter->query($query);
        }
    }

    public function retrieveMlbs()
    {
        $adapter = Zend_Registry::get('adapter');

        $data = $adapter->fetchAll('SELECT * FROM game');

        return $data;
    }

    public function retrieveMlbsJson()
    {
        $data = $this->retrieveMlbs();

        return json_encode($data);
    }

    public function saveMlbs()
    {
        $uri = Zend_Registry::get('config')->app->apiUrl;
        $key = Zend_Registry::get('config')->app->apiKey;

        $ch = curl_init($uri);
        curl_setopt_array($ch, array(
            CURLOPT_HTTPHEADER  => array('Ocp-Apim-Subscription-Key : '.$key),
            CURLOPT_RETURNTRANSFER  =>true,
            CURLOPT_VERBOSE     => 1
        ));
        $out = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($out, true);

        foreach($data as $item){
            $this->insertMlbs($item);
        }
    }
	
}