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
        'Nuevo Rol', /// ete boton abre el modal para crear un nuevo rol desde el modal de roles del usuario, por eso el titulo es nuevo rol y no user_rol
        [
            /* debo pasar el userId porque al volver debo reabrir el modal de ese usuario
            tembien debo pasar lo que estaba tilf¡dado aunque no este guardado eso lo hace en la funcion  */
            'user_rol/create',
            'userId' => $user->id, //paso el id del usuario para que al cerrar o guardar
            // se carge nuevamente el modal de roles del usuario con el mismo usuario
        ],
        [
            'class' => 'btn btn-success btn-sm',
            'role' => 'modal-remote',
            'title' => 'Crear rol',
            'onclick' => 'guardarEstadoRoles(' . $user->id . ');', //eesto solo guarda los roles tildados 
            //antes de abrir el modal de crear nuevo rol, 
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
        //esto lo hace solo cuando va a agregar un nuevo rol
        let roles = [];

        $('input[name="roles[]"]:checked').each(function() {
            roles.push($(this).val());
        });

        sessionStorage.setItem('rolesTemp', JSON.stringify(roles));
    }

    /* $(document).ready(function() {
        alert("ocurre el readiy de roles");
        //aca vuelvo a levantar los roles tildados al volver del modal de crear nuevo rol, 
        // lo hago leyendo el estado guardado en sessionStorage 
        // en el caso de haber creado un nuevo rol, 
        // ese nuevo rol se debe agregar al array de roles, y tildarlo chequear esto
        let rolesGuardados = JSON.parse(sessionStorage.getItem('rolesTemp') || '[]');

        $('input[name="roles[]"]').each(function() {

            if (rolesGuardados.includes($(this).val())) {
                $(this).prop('checked', true);
            }

        });
    }); */

    function volverARoles(idUsuario, idnuevorol = 0) {

        console.log('Volviendo a roles en sessionStorage: ' + sessionStorage.getItem('rolesTemp'));
        console.log("ID usuario:", idUsuario);
        console.log('index.php?r=user/roles&id=' + idUsuario);
        $.get(

            'index.php?r=user/roles&id=' + idUsuario,
            function(data) {

                $('#ajaxCrudModal .modal-title').html(data.title);
                $('#ajaxCrudModal .modal-body').html(data.content);
                $('#ajaxCrudModal .modal-footer').html(data.footer);

                /* ahora tildamos lo que estaba */
                let rolesGuardados = JSON.parse(sessionStorage.getItem('rolesTemp') || '[]');

                $('input[name="roles[]"]').each(function() {

                    if (rolesGuardados.includes($(this).val())) {
                        $(this).prop('checked', true);
                    }

                });

                /* marcar rol nuevo si existe */
                if (idnuevorol != 0) {
                    $('input[name="roles[]"][value="' + idnuevorol + '"]').prop('checked', true);
                }
            }
        );
    }

    /* $(document).on('ajaxComplete', function(event, xhr) {

        let r;

        try {
            r = JSON.parse(xhr.responseText);
        } catch (e) {
            return;
        }

        if (r.success) {
            volverARoles(r.userId, r.nuevoRolId);
        }

    }); */







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
                'index.php?r=user/roles&id=' + userId,
                function(data) {
                    $('.modal-body').html(data.content);
                    $('.modal-title').html(data.title);
                    $('.modal-footer').html(data.footer);

                }
            );
        }
    });

    function limpiarRolesTemp() {
        console.log('Limpiando rolesTemp de sessionStorage');
        sessionStorage.removeItem('rolesTemp');
    }
</script>