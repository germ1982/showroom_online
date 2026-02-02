<?php

use yii\helpers\Html;
use yii\helpers\Url;

return [

    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'username',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'email',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'telefono',
    ],
    [
        'attribute' => 'rol',
        'label' => 'Rol',
        'value' => function ($model) {
            return implode(', ', array_column($model->roles, 'nombre'));
        },

    ],

    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'template' => '{view} {update} {delete} {roles}', // agregamos el botón roles
        'urlCreator' => function ($action, $model, $key, $index) {
            // Si es el botón Update, redirige a update_modal
            if ($action === 'update') {
                return Url::to(['update', 'id' => $key, 'ismodal' => true]);
            }
            // Para view y delete mantenemos la acción original
            return Url::to([$action, 'id' => $key]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => 'View', 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => 'Update', 'data-toggle' => 'tooltip'],
        'deleteOptions' => [
            'role' => 'modal-remote',
            'title' => 'Delete',
            'data-confirm' => false,
            'data-method' => false, // for overide yii data api
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => 'Are you sure?',
            'data-confirm-message' => 'Are you sure want to delete this item'
        ],
        'buttons' => [
            'roles' => function ($url, $model, $key) {
                return Html::a('<i class="glyphicon glyphicon-list"></i>',
                    ['user/roles', 'id' => $key], // URL directa
                    [
                        'title' => 'Editar Roles',
                        'role' => 'modal-remote',
                        'data-toggle' => 'tooltip',
                        
                    ]
                );
            },
        ],

    ],

];
