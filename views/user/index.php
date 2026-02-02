<?php

use app\helpers\AppIndexGenericoHelper;
use app\models\User_rol;
use app\models\User_usuario_rol;
use yii\helpers\Html;

$userid = Yii::$app->user->identity->id;
$idrol_admin = User_rol::find()->where(['nombre' => 'Administrador'])->one()->idrol;
$rol = User_usuario_rol::find()->where(['idusuario' => $userid,'idrol' => $idrol_admin])->one();

$gridColumns = require(__DIR__ . '/_columns.php');
$customButtonsA = ''; // o define aquí tus botones HTML::a(...) para la izquierda si es necesario
$customButtonsB = ''; // o define aquí tus botones HTML::a(...) para la derecha si es necesario
$anchoModal = '1200px'; // Ancho del modal en PX
$tamañoLetra = '12px'; // Tamaño de letra para la grilla

      //esta parte es especial para usuarios
            if ($rol) {
                  //si es admin
                  $customButtonsB = Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['role' => 'modal-remote', 'title' => 'Nuevo', 'class' => 'btn btn-default']) .
                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''], ['data-pjax' => 1, 'class' => 'btn btn-default', 'title' => 'Refrescar Grilla']) .
                        '{toggleData}' .
                        '{export}';
            } else {
                  //si no es admin
                  $customButtonsB = Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''], ['data-pjax' => 1, 'class' => 'btn btn-default', 'title' => 'Refrescar Grilla']) .
                                    '{toggleData}' .
                                    '{export}';
            }

      //aca termina la parte especial para usuarios
// 2. Renderizar la vista completa

echo AppIndexGenericoHelper::renderIndex(
      $this,                  // Objeto View ($this)
      'Usuarios',      // Título
      $gridColumns,           // Columnas
      $dataProvider,          // DataProvider (viene del controlador)
      $searchModel,           // SearchModel (viene del controlador)
      $customButtonsA,
      $customButtonsB,
      $anchoModal,
      $tamañoLetra,
);
