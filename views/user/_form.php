<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
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


    <?php $form = ActiveForm::begin(); ?>
    <div class="row justify-content-center overlay-div centro-celu">

      <div class="col-md-4">

      </div>

      <div class="col-md-4 custom-box">

          <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'access_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

        </div>

      <div class="col-md-4">

      </div>


  


    <?php ActiveForm::end(); ?>
    

