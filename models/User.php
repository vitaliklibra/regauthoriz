<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $password
 */
class User extends \yii\db\ActiveRecord
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'user';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['name', 'email', 'phone', 'password'], 'required'],
      [['name', 'password'], 'string', 'max' => 255],
      [['email'], 'string', 'max' => 100],
      [['phone'], 'string', 'max' => 25],
      [['authkey'], 'string', 'max' => 32],
      [['accesstoken'], 'string', 'max' => 32],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'name' => 'Name',
      'email' => 'Email',
      'phone' => 'Phone',
      'password' => 'Password',
      'authkey' => 'Authorization key',
      'accesstoken' => 'Access token',
    ];
  }
}
