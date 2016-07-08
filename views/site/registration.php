<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models;

$this->title = 'Registration of new user';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
	<h1><?= Html::encode($this->title) ?></h1>

  <p>Please fill out the following fields to registration in this site:</p><br>

	<?php $form = ActiveForm::begin([
    'id' => 'registration-form',
    'options' => ['class' => 'form-horizontal'],
    'enableAjaxValidation' => true,
    'fieldConfig' => [
  		'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-6\">{error}</div>",
      'labelOptions' => ['class' => 'col-lg-2 control-label'],
    ],
	]); ?>

  <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

  <?= $form->field($model, 'email')->textInput() ?>

  <?= $form->field($model, 'phone')->textInput(['placeholder' => 'Enter phone in format +38XXXXXXXXXX']) ?>

  <?= $form->field($model, 'password')->passwordInput() ?>

  <?= $form->field($model, 'verifypassword')->passwordInput() ?>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <?= Html::submitButton('Registration', ['class' => 'btn btn-primary', 'name' => 'reg-button']) ?>
    </div>
  </div>

	<?php ActiveForm::end(); ?>

</div>