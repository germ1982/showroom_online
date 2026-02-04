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

<h4>Roles de <?= Html::encode($user->username) ?></h4>

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
                        <?= in_array($rol->idrol, $rolesActuales) ? 'checked' : '' ?>
                    >
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php ActiveForm::end(); ?>
