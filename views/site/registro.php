<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Registrarse';

?>

<style>
      .div-boton {
            justify-content: center;
            align-items: center;
            text-align: center;
      }

      .custom-box {
            border-radius: 10px;
            padding: 15px 40px 16px 40px;
            box-shadow: 0 0 20px #00bfff;
      }

      @media (max-width: 768px) {
            .centro-celu {
                  padding: 0px 15px 0px 15px;
            }
      }
</style>
<div class="row justify-content-center overlay-div centro-celu">

      <div class="col-md-4">

      </div>

      <div class="col-md-4 custom-box">
            <h2><?= Html::encode($this->title) ?></h2>

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
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