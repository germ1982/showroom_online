<?php

use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
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
                        <?php //$this->renderFile('@webroot/publicidades/liliana_catering.php'); 
                        ?>
                  </div>
            </div>
      </div>

      <div class="col-md-4">
            <div class="custom-box" id='mis-datos'>
                  <h4>Mis Datos</h4>

                  <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

                  <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                  <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

                  <div class="div-boton">
                        <?= Html::submitButton('Guardar', ['class' => 'btn btn-search']) ?>
                        <?= Html::button('Cambiar Contraseña', [
                              'class' => 'btn btn-search',
                              'onclick' => "$('#mis-datos').hide(); $('#new-password').show();"
                        ]) ?>
                  </div>
            </div>
            <div class="custom-box" id='new-password' style="display:none">
                  <h4>Cambiar Contraseña</h4>

                  <div class="mb-3">
                        <label>Contraseña Actual</label>
                        <?= Html::passwordInput('pass_actual', '', ['class' => 'form-control', 'id' => 'pass_actual']) ?>
                  </div>

                  <div class="mb-3">
                        <label>Nueva Contraseña</label>
                        <?= Html::passwordInput('pass_nueva', '', ['class' => 'form-control', 'id' => 'pass_nueva']) ?>
                  </div>

                  <div class="mb-3">
                        <label>Repetir Nueva Contraseña</label>
                        <?= Html::passwordInput('pass_repetir', '', ['class' => 'form-control', 'id' => 'pass_repetir']) ?>
                  </div>

                  <div class="div-boton">
                        <?= Html::button('Confirmar Cambio', ['class' => 'btn btn-search', 'id' => 'btn-confirmar-pass']) ?>

                        <?= Html::button('Cancelar', [
                              'class' => 'btn btn-search',
                              'onclick' => "$('#new-password').hide(); $('#mis-datos').show();"
                        ]) ?>
                  </div>

                  <div id="password-message" style="margin-top: 10px;"></div>

            </div>
      </div>


      <div class="col-md-4">

            <?php //$this->renderFile('@webroot/publicidades/hector_catering.php'); 
            ?>
      </div>

</div>



<?php ActiveForm::end(); ?>

<?php
$urlCambio = Url::to(['user/change_password']); // Ajusta a tu controller
$script = <<< JS
$('#btn-confirmar-pass').on('click', function() {

    var pActual  = $('#pass_actual').val();
    var pNueva   = $('#pass_nueva').val();
    var pRepetir = $('#pass_repetir').val();
    

      if (pNueva === '' || pRepetir === '' || pActual === '') {
      $('#password-message').html('<span class="text-danger">Hay Campos Vacios.</span>');
      return;
      }

    // Validación básica en JS antes de enviar
    if(pNueva !== pRepetir) {
        $('#password-message').html('<span class="text-danger">Las nuevas contraseñas no coinciden.</span>');
        return;
    }

    console.log('validaciones de campos correctas');

    $.ajax({
        url: '$urlCambio',
        type: 'POST',
        data: {
            actual: pActual,
            nueva: pNueva,
        },
        success: function(response) {
            console.log('llego hasta aca');
            if(response.success) {
                  Swal.fire({
                  icon: 'success',
                  title: '¡Contraseña actualizada!',
                  text: 'Tu sesión se cerrará por seguridad. Ingresa con tu nueva clave.',
                  timer: 3000, // 3 segundos
                  timerProgressBar: true,
                  showConfirmButton: false
            }).then(() => {
                // REDIRECCIÓN AL LOGIN
                window.location.href = response.url;
            });
            } else {
                $('#password-message').html('<span class="text-danger">' + response.message + '</span>');
            }
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: response.message,
            });
        }
    });
});
JS;
$this->registerJs($script);
?>