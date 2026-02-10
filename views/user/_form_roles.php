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
    <h5 class="mb-0">
        Roles de <?= Html::encode($user->username) ?>
    </h5>

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





    $(document).on('ajaxSuccess', function(event, xhr, settings) {
        console.log('campturando ajaxSuccess en roles y solo actuo si es el ajax de crear rol');

        if (!settings.url.includes('user_rol/create')) return;

        let success = xhr.responseJSON?.success;
        let nuevoRolId = xhr.responseJSON?.nuevoRolId;
        let userId = xhr.responseJSON?.userId;

        if (!success || !nuevoRolId || !userId) return;

         $('#ajaxCrudModal').trigger('modal:loaded');

        volverARoles(userId, nuevoRolId);

        /* agregar_rol_a_rolesTemp(nuevoRolId);
        abrir_modal_roles(userId); */


    });

    function agregar_rol_a_rolesTemp(nuevoRolId) {
        if (!nuevoRolId) return;

        let rolesGuardados = JSON.parse(sessionStorage.getItem('rolesTemp') || '[]'); // recupero lo que ya estaba guardado

        if (!rolesGuardados.includes(String(nuevoRolId))) { // si el nuevo rol no estaba ya guardado, lo agrego
            rolesGuardados.push(String(nuevoRolId));
            sessionStorage.setItem('rolesTemp', JSON.stringify(rolesGuardados)); // guardo el nuevo estado con el nuevo rol incluido
        }
    }

    function abrir_modal_roles(userId) {
        $.get(
            'index.php?r=user/roles&id=' + userId,
            function(data) {
                $('#ajaxCrudModal .modal-title').html(data.title);
                $('#ajaxCrudModal .modal-body').html(data.content);
                $('#ajaxCrudModal .modal-footer').html(data.footer);
                marcar_roles_tildados_desde_sessionStorage();
            }
        );
    }

    function marcar_roles_tildados_desde_sessionStorage() {
        let rolesGuardados = JSON.parse(sessionStorage.getItem('rolesTemp') || '[]');

        $('input[name="roles[]"]').each(function() {
            if (rolesGuardados.includes($(this).val())) {
                $(this).prop('checked', true);
            }
        });
    }

    function limpiarRolesTemp() {
        console.log('Limpiando rolesTemp de sessionStorage');
        sessionStorage.removeItem('rolesTemp');
    }
</script>