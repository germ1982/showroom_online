<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin(); ?>
<div class="row justify-content-center overlay-div centro-celu">

      <div class="col-md-4">
            <div class="row">
                  <div class="col-md-12">
                        <?= $model->rol == 1 ? $this->render('_form_panel_administrador') : '' ?>
                  </div>
            </div>
            <br>
            <div class="row">
                  <div class="col-md-12">
                        <?= $this->renderFile('@webroot/publicidades/liliana_catering.php'); ?>
                  </div>
            </div>
      </div>

      <div class="col-md-4">
            <div class="custom-box">
                  <h4>Mis Datos</h4>

                  <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

                  <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                  <div class="div-boton">
                        <?= Html::submitButton('Update', ['class' => 'btn btn-search']) ?>
                  </div>
            </div>
      </div>


      <div class="col-md-4">

            <?= $this->renderFile('@webroot/publicidades/hector_catering.php'); ?>
      </div>

</div>







<?php ActiveForm::end(); ?>