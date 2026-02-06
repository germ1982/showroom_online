<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User_rol;

/* @var $user app\models\User */
/* @var $rolesActuales array */

// Traigo TODOS los roles
$roles = User_rol::find()
    ->orderBy(['nombre' => SORT_ASC])
    ->all();
?>

<div class="d-flex justify-content-between align-items-center mb-2">
    <h4 class="mb-0">
        Roles de <?= Html::encode($user->username) ?>
    </h4>

    <?= Html::a(
        '<i class="fas fa-plus"></i> Nuevo Rol',
        ['user_rol/create'],
        [
            'class' => 'btn btn-success btn-sm',
            'role' => 'modal-remote',
            'title' => 'Crear rol',
            'onclick' => 'guardarEstadoRoles();',
        ]
    ) ?>
</div>


<?php $form = ActiveForm::begin(); ?>

<table class="table table-bordered table-hover table-sm">
    <thead class="thead-light">
        <tr>
            <th style="width:60px">ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th style="width:90px; text-align:center">Asignado</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($roles as $rol): ?>
            <tr>
                <td><?= $rol->idrol ?></td>
                <td><?= Html::encode($rol->nombre) ?></td>
                <td><?= Html::encode($rol->descripcion) ?></td>
                <td style="text-align:center">
                    <input
                        type="checkbox"
                        name="roles[]"
                        value="<?= $rol->idrol ?>"
                        <?= in_array($rol->idrol, $rolesActuales) ? 'checked' : '' ?>>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php ActiveForm::end(); ?>

<script>
    function guardarEstadoRoles() {
        let roles = [];

        $('input[name="roles[]"]:checked').each(function() {
            roles.push($(this).val());
        });

        sessionStorage.setItem('rolesTemp', JSON.stringify(roles));
    }

    $(document).ready(function() {

        let rolesGuardados =
            JSON.parse(sessionStorage.getItem('rolesTemp') || '[]');

        $('input[name="roles[]"]').each(function() {

            if (rolesGuardados.includes($(this).val())) {
                $(this).prop('checked', true);
            }

        });
    });

    function volverARoles() {

        $.get('index.php?r=user/roles&id=ID_USUARIO', function(data) {

            $('#ajaxCrudModal .modal-content').html(data);

        });

    }


    $(document).on('ajaxSuccess', function(event, xhr, settings) {

        if (xhr.responseJSON && xhr.responseJSON.success) {

            let nuevoRolId = xhr.responseJSON.nuevoRolId;
            let userId = xhr.responseJSON.userId;

            // recuperar estado guardado
            let rolesGuardados =
                JSON.parse(sessionStorage.getItem('rolesTemp') || '[]');

            // agregar nuevo rol
            rolesGuardados.push(String(nuevoRolId));

            sessionStorage.setItem(
                'rolesTemp',
                JSON.stringify(rolesGuardados)
            );

            // reabrir modal roles automáticamente
            $.get(
                '/user/roles?id=' + userId,
                function(data) {
                    $('.modal-body').html(data.content);
                    $('.modal-title').html(data.title);
                    $('.modal-footer').html(data.footer);
                }
            );
        }
    });
</script>