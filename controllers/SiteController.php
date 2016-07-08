<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\User;
use app\models\RegistrationForm;
use app\models\UserIdentity;


class SiteController extends Controller
{
  public function behaviors()
  {
    return [
      'access' => [
        'class' => AccessControl::className(),
        'only' => ['logout'],
        'rules' => [
          [
            'actions' => ['logout'],
            'allow' => true,
            'roles' => ['@'],
          ],
        ],
      ],
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'logout' => ['post'],
        ],
      ],
    ];
  }

  public function actions()
  {
    return [
      'error' => [
        'class' => 'yii\web\ErrorAction',
      ],
      'captcha' => [
        'class' => 'yii\captcha\CaptchaAction',
        'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
      ],
    ];
  }

  public function actionIndex()
  {
    return $this->render('index');
  }

  public function actionLogin()
  {
    if (!Yii::$app->user->isGuest) {
      return $this->goHome();
    }

    $model = new LoginForm();
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
      return $this->goBack();
    }
    return $this->render('login', [
      'model' => $model,
    ]);
  }

  public function actionLogout()
  {
    Yii::$app->user->logout();

    return $this->goHome();
  }

  public function actionRegistration()
  {
    if (Yii::$app->request->post())
    {
      $modeluser = Yii::$app->request->post()['RegistrationForm'];

      $newUser = new User();
      $newUser->loadDefaultValues();
      $newUser->name = $modeluser['name'];
      $newUser->email = $modeluser['email'];
      $newUser->phone = $modeluser['phone'];
      $newUser->password = md5($modeluser['password']);
      $newUser->save();

      if (Yii::$app->user->login(UserIdentity::findByEmail($modeluser['email'])))
      {
        return $this->goHome();
      }

      return $this->goBack();
    }

    $model = new RegistrationForm();

    return $this->render('registration', ['model' => $model]);
  }
}