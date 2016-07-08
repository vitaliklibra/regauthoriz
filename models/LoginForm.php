<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
  public $email;
  public $password;
  public $rememberMe = false;

  private $_user = false;

  public function rules()
  {
    return [
      [['password', 'email'], 'required'],
      ['rememberMe', 'boolean'],
      ['password', 'validatePassword'],
    ];
  }

  public function validatePassword($attribute, $params)
  {
    if (!$this->hasErrors()) {
      $user = $this->getUser();

      if (!$user || !$user->validatePassword($this->password)) {
        $this->addError($attribute, 'Incorrect E-mail or password.');
      }
    }
  }

  public function login()
  {
    if ($this->validate()) {
      return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
    }
    return false;
  }

  public function getUser()
  {
    if ($this->_user === false) {
      $this->_user = UserIdentity::findByEmail($this->email);
    }

    return $this->_user;
  }
}
