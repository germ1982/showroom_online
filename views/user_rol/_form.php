<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User_rol */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-rol-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-10">
            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'activo')->checkbox(['style' => 'margin-top: 25px;']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    console.log('Cargando script de form_roles');
    console.log('User ID en que viene en el request:', <?= Yii::$app->request->get('userId');?>);
    console.log('roles tildados en sessionStorage: ' + sessionStorage.getItem('rolesTemp'));
</script>