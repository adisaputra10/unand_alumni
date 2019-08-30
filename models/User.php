<?php

namespace app\models;

use Yii;
use app\models\AppUser;
use app\models\AppGroupMenu;
use yii\httpclient\Client;
use yii\helpers\Json;
use app\models\BiodataCalon;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface {

    const STATUS_AKTIF = '1';

    public $userId;
    public $userNama;
    public $userUsername;
    public $userPassword;
    public $userAuthKey;
    public $userGroupId;
    public $userTglEntri;
    public $userUnit;
    public $userIsAkunPortal;
    public $_status;

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        $session = Yii::$app->session;
        return ($session->has('identity')) ? new static($session->get('identity')) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        //Belum digunakan maksimal
        $session = Yii::$app->session;
        return ($session->has('identity')) ? new static($session->get('identity')) : null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username) {
        $session = Yii::$app->session;
        return ($session->has('identity')) ? new static($session->get('identity')) : null;
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->userId;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->userAuthKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->userAuthKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return $this->userPassword === $password;
    }

}
