<?php

use app\models\User_rol;
use app\models\User_usuario_rol;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


?>


<?php $form = ActiveForm::begin(); ?>
<div class="centro-celu ">


    <div id='mis-datos'>
        <?= $form->field($model, 'id')->hiddenInput(['id' => 'input_iduser'])->label(false) ?>

        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

        <br>
        <?= Html::a('Cambiar Contraseña', '#', ['id' => 'btnCambiarPass',
            'onclick' => "mostrar_div_password(); return false;"
        ]) ?>

    </div>
    <div id='new-password' style="display:none">
        <h4>Cambiar Contraseña</h4>

        <div class="mb-3">
            <label>Contraseña Actual</label>
            <?= Html::passwordInput('pass_actual', '', ['class' => 'form-control', 'id' => 'pass_actual', 'autocomplete' => 'new-password']) ?>
        </div>

        <div class="mb-3">
            <label>Nueva Contraseña</label>
            <?= Html::passwordInput('pass_nueva', '', ['class' => 'form-control', 'id' => 'pass_nueva', 'autocomplete' => 'new-password']) ?>
        </div>

        <div class="mb-3">
            <label>Repetir Nueva Contraseña</label>
            <?= Html::passwordInput('pass_repetir', '', ['class' => 'form-control', 'id' => 'pass_repetir', 'autocomplete' => 'new-password']) ?>
        </div>

        <br>

        <div class="div-boton">
            <?= Html::button('Confirmar Cambio', ['class' => 'btn btn-search', 'id' => 'btn-confirmar-pass']) ?>

            <?= Html::button('Cancelar', [
                'class' => 'btn btn-search',
                'onclick' => "mostrar_div_datos(); return false;"
            ]) ?>
        </div>

        <div id="password-message" style="margin-top: 10px;"></div>

    </div>




</div>



<?php ActiveForm::end(); ?>

<?php
$urlCambio = Url::to(['user/change_password']); // Ajusta a tu controller
$script = <<< JS

function mostrar_div_datos(){
    $('#mis-datos').show();
    $('#btnClose').show(); // oculta el botón
    $('#btnSave').show();
    $('#new-password').hide();
}

function mostrar_div_password(){
    $('#mis-datos').hide();
    $('#btnClose').hide(); // oculta el botón
    $('#btnSave').hide();
    $('#new-password').show();
}



$('#btn-confirmar-pass').on('click', function() {

    var pActual  = $('#pass_actual').val();
    var pNueva   = $('#pass_nueva').val();
    var pRepetir = $('#pass_repetir').val();
    var iduser   = $('#input_iduser').val();

    
    
    $('#password-message').html(''); // Limpiar mensajes previos
    

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
            iduser: iduser,
        },
        success: function(response) {
            console.log('llego hasta aca');
            if(response.success) {
                  Swal.fire({
                  icon: 'success',
                  title: '¡Contraseña actualizada!',
                  text: 'La contraseña ha sido actualizada.',
                  timer: 3000, // 3 segundos
                  timerProgressBar: true,
                  showConfirmButton: false
            }).then(() => {
               mostrar_div_datos();
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