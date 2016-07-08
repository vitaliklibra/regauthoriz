<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use yii\models;

class UserIdentity extends User implements IdentityInterface
{
  public static function findIdentity($id)
  {
  	return static::findOne($id);
  }

  public static function findIdentityByAccessToken($token, $type = null)
  {
  	return static::findOne(['accesstoken' => $token]);
  }

  public static function findByEmail($email)
  {
  	return static::findOne(['email' => $email]);
  }

  public function getId()
  {
  	return $this->id;
  }

  public function getAuthKey()
  {
  	return $this->authkey;
  }

  public function validateAuthKey($authKey)
  {
  	return $this->authkey === $authKey;
  }

  public function validatePassword($password)
  {
  	return $this->password === md5($password);
  }
}