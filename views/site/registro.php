<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Registrarse';

?>

<div class="row justify-content-center overlay-div centro-celu">

      <div class="col-md-4">

      </div>

      <div class="col-md-4 custom-box">
            <h2><?= Html::encode($this->title) ?></h2>

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'password_repeat')->passwordInput() ?>

            <div class="div-boton">
                  <?= Html::submitButton('Crear cuenta', ['class' => 'btn btn-search']) ?>
            </div>

            <?php ActiveForm::end(); ?>
      </div>

      <div class="col-md-4">

      </div>


</div>