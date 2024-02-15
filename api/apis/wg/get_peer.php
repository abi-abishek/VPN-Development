<?php

${basename(__FILE__, '.php')} = function(){
    if($this->get_request_method() == "POST" and $this->isAuthenticated()){
        try{
            $wg = new Wireguard('wg0');
            $data = [
                "username" => $wg->getPeer($this->_request['peer']),
            ];
            $data = $this->json($data);
            $this->response($data, 200);
        } catch(Exception $e){
            $data = [
                "error" => $e->getMessage()
            ];
            $data = $this->json($data);
            $this->response($data, 403);
        }

    } else {
        $data = [
            "error" => "Bad request"
        ];
        $data = $this->json($data);
        $this->response($data, 400);
    }
};