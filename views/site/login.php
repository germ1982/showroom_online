<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

use yii\bootstrap5\NavBar;
use yii\bootstrap5\Nav;


$this->title = 'Iniciar sesión';

?>


<div class="row justify-content-center overlay-div centro-celu">

      <div class="col-md-4">

      </div>

      <div class="col-md-4 custom-box">
            <h2><?= Html::encode($this->title) ?></h2>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>


                  <?= $form->field($model, 'username')->textInput(['autofocus' => true,])->label('Usuario') ?>
                  <?= $form->field($model, 'password')->passwordInput()->label('Contraseña') ?>


                  <?= $form->field($model, 'rememberMe')->checkbox()->label('Mantener sesión iniciada') ?>

                  <div class="div-boton">
                        <?= Html::submitButton('Iniciar', ['class' => 'btn btn-search', 'name' => 'login-button']) ?>
                  </div>

                  <div style="margin-top:15px;">
                        <?= Html::a('¿No tenés cuenta? Registrate acá', ['/site/registro'], [
                              'style' => 'font-size:14px; text-decoration: underline;'
                        ]) ?>
                  </div>

                  
                  <?php if ($model->hasErrors('password')): ?>
                        <div style="margin-top:15px;">
                              <?= Html::a('¿Olvidaste tu contraseña?', ['/site/solicitar-reset'], [
                                    'style' => 'font-size:14px; text-decoration: underline; display:block; margin-top:8px;'
                              ]) ?>
                        </div>
                  <?php endif; ?>
    



            <?php ActiveForm::end(); ?>

      </div>

      <div class="col-md-4">

      </div>
</div>
            
