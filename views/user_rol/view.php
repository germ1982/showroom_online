<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User_rol */
?>
<div class="user-rol-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idrol',
            'nombre',
            'descripcion',
            'activo',
            'created_at',
        ],
    ]) ?>

</div>
