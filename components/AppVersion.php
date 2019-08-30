<?php
namespace app\components;

use Yii;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AppVersion
 *
 */
class AppVersion {
    
    private $developBy="";
    private $version='-18.02.xx';
    private $year='2017';
    private $companyLink='http://www.unand.ac.id/';
    private $companyName='Universitas Andalas';// Maksimal 25 Karakter


    public function version(){
        return Yii::getVersion().$this->version;
    }
    
    public function year(){
        return $this->year;
    }
    
    public function companyLink(){
        return $this->companyLink;
    }
    
    public function companyName(){
        return $this->companyName;
    }
    public function developBy(){
        return $this->developBy;
    }
}
