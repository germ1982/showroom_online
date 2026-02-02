<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;

// Formulario de búsqueda
$boton_busqueda = Html::beginForm(['/site/buscar'], 'get', ['class' => 'navbar-form navbar-left'])
      . '<div class="input-group">'
      . Html::textInput('q', '', ['class' => 'form-control', 'placeholder' => 'Buscar...'])
      . '<span class="input-group-btn">'
      . Html::submitButton('<span class="glyphicon glyphicon-search"></span>', [
            'class' => 'btn btn-default',
            'encode' => false,
      ])
      . '</span>'
      . '</div>'
      . Html::endForm();

// Menú derecho
$menuItemsRight = [];
if (Yii::$app->user->isGuest) {
      $menuItemsRight[] = ['label' => 'INGRESAR', 'url' => ['/site/login']];
} else {
      $menuItemsRight[] = ['label' => 'FAVORITOS', 'url' => ['/producto/favoritos']];
      $menuItemsRight[] = ['label' => 'PUBLICAR', 'url' => ['/producto/crear']];
      $menuItemsRight[] = ['label' => 'MIS PRODUCTOS', 'url' => ['/producto/mis-productos']];
      $menuItemsRight[] = [
            'label' => mb_strtoupper(Yii::$app->user->identity->username),
            'url' => ['/user/update', 'id' => Yii::$app->user->id]
      ];
      $menuItemsRight[] = [
            'label' => 'SALIR',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post'],
      ];
}

NavBar::begin([
      'brandLabel' => '<img src="' . Yii::$app->request->baseUrl . '/img/TSO.png" style="height:24px;"> Showroom Online',
      'brandUrl' => Yii::$app->homeUrl,
      //'options' => ['class' => 'navbar-inverse navbar-fixed-top bg-dark'],
      'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
]);
?>

<?= $boton_busqueda ?>

<?= Nav::widget([
      'options' => ['class' => 'navbar-nav navbar-right'],
      'items' => $menuItemsRight,
]); ?>

<?php NavBar::end(); ?>
