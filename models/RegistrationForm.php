<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RegistrationForm extends Model
{
  public $name;
  public $email;
  public $phone;
  public $password;
  public $verifypassword;

  public function rules()
  {
    return [
      [['name', 'email', 'phone', 'password', 'verifypassword'], 'required'],
      ['name', 'filter', 'filter' => 'trim'],
      ['password', 'filter', 'filter' => 'trim'],
      ['phone', 'match', 'pattern' => '/\+38\d{10,10}$/'],
      ['email', 'email'],
      //['email', 'unique'],
      //['email', 'validateEmail'],
      ['password', 'string', 'length'=>[6]],
      ['verifypassword', 'compare', 'compareAttribute'=>'password', 'operator'=>'==='],
    ];
  }

  public function attributeLabels()
  {
    return array(
      'name' => 'Full name',
      'email' => 'E-mail',
      'phone' => 'Phone',
      'password' => 'Password',
      'verifypassword' => 'Verify password',
    );
  }

  public function validateEmail($attribute, $params)
  {
    //
  }
}
