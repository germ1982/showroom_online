<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User_usuario_rol */
?>
<div class="user-usuario-rol-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'idusuario',
            'idrol',
            'created_at',
        ],
    ]) ?>

</div>
