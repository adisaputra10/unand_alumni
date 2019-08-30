<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\WsConn;
use app\models\Identitasalumni;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model {

    public $username;
    public $password;
    public $loginAs;
    public $rememberMe = true;
    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            // username and password are both required
                [['username', 'password', 'loginAs'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels() {
        return [
            'username' => 'Username',
            'password' => 'Password',
            'loginAs' => 'Akun Login'
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login() {
        $model = new Identitasalumni();
        $session = Yii::$app->session;
        $data = $model->find()
                ->where("(username=:usr) ", [
                    ':usr' => $this->username,
                ])
                ->one();
        if (isset($data)) {
            if ($data['password'] == md5($this->password)) {
                $identity = [
                    'userId' => $data['idalumni'],
                    'userNama' => ucwords(strtolower($data['namalengkap'])),
                    'userUsername' => $data['username'],
                    'userPassword' => $data['password'],
          
                ];
                // save to session for reading in model user
                $session->set('identity', $identity);
                // create instance form model user
                if ($user = User::findIdentity($data['username'])) {
                    $session->remove('message');
                    return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
                }
            } else {
                $session->set('message', 'Maaf, Password Salah!');
            }
        } else {
            $session->set('message', 'Maaf, Username tidak terdaftar!');
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser() {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

}
