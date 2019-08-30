<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use Yii;
use yii\httpclient\Client;

/**
 * Description of WsConn
 *
 * @author IDEAPAD
 */
class WsConn {

    private $conf;

    public function __construct() {
        $this->conf = AppService::findOne('WS-SIMTB');
    }

    public function getToken() {
        $client = new Client();
        $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl($this->conf->wsAddress . 'auth/login')
                ->setData([
                    'username' => $this->conf->wsUsername,
                    'password' => $this->conf->wsPassword,
                    'chost'=> \Yii::$app->request->userIP,
                ])
                ->send();
        if ($response->isOk) {
            $data = $response->data['data'];
            return $data['ws_token'];
        } else {
            return null;
        }
    }
    
    public function postRequest($token,$ctrlName,$params=[]) {
        $client = new Client();
        $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl($this->conf->wsAddress .$ctrlName .'?access-token='.$token)
                ->setData($params)
                ->send();
        if ($response->isOk) {
            return $response->data;
        } else {
            return null;
        }
    }
    
    public function getRequest($token,$ctrlName,$params=[]) {
        $client = new Client();
        $response = $client->createRequest()
                ->setMethod('GET')
                ->setUrl($this->conf->wsAddress .$ctrlName .'?access-token='.$token)
                ->setData($params)
                ->send();
        if ($response->isOk) {
            return $response->data;
        } else {
            return null;
        }
    }

}
