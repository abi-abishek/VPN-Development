<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/api/lib/Database.class.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

use Carbon\Carbon;

class Wireguard{
    private $device;
    public function __construct($device){
        $this->device = $device;
        $this->db = Database::getConnection();
    }

    public function getPeers() {

    }

    public function getPeer($public){
        $cmd = "sudo wg show $this->device | grep -A4 '$public'";
        $output = trim(shell_exec($cmd));
        $result = explode(PHP_EOL, $output);
        $peer = array();
        $peer_count = 0;
        foreach($result as $value){
            if(!empty($value)){
                $value = trim($value);
                if(startsWith($value, 'peer:')){
                    $peer_count++;
                    if($peer_count >= 2){
                        break;
                    }
                }
                $data = explode(': ', $value);
                $peer[$data[0]] = $data[1];
            }
        }
        return $peer;
    }
}