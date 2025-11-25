<header id="header">

      <?php

      use yii\bootstrap5\NavBar;
      use yii\bootstrap5\Nav;
      use yii\bootstrap5\Html;

      NavBar::begin([
            'brandLabel' => '<img src="' . Yii::$app->request->baseUrl . '/img/TSO.png" alt="TSO" style="height:24px;"> ' . Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
      ]);

      $boton_busqueda = Html::beginForm(['/site/buscar'], 'get', ['class' => 'd-flex ms-3'])
            . '<div class="input-group neon">'
            . Html::textInput('q', '', [
                  'class' => 'form-control ',
                  'placeholder' => 'Buscar...'
            ])
            . Html::button(
                  '<i class="bi bi-search"></i>',
                  [
                        'class' => 'btn  btn-search',
                        'onclick' => 'buscar()'
                  ]
            )
            . '</div>'
            . Html::endForm();
      ?>

      <div class="d-flex w-100">

            <!-- MENÚ IZQUIERDO -->
            <div class="d-flex align-items-center flex-grow-1">
                  <?php
                  echo Nav::widget([
                        'options' => ['class' => 'navbar-nav'],
                        'encodeLabels' => false,
                        'items' => [

                              ['label' => '<i class="bi bi-house-door neon"></i> INICIO', 'url' => ['/site/index']],
                              [
                                    'label' => $boton_busqueda,
                                    'encode' => false, // IMPORTANTE para que renderice HTML
                                    'options' => ['class' => 'nav-item']
                              ],

                        ]
                  ]);
                  ?>
            </div>

            <!-- MENÚ DERECHO (LOGIN / LOGOUT) -->
            <div class="ms-auto">
                  <?= Nav::widget([
                        'options' => ['class' => 'navbar-nav'],
                        'items' => [
                              Yii::$app->user->isGuest ? '' : ['label' => 'FAVORITOS', 'url' => ['/producto/favoritos'],],
                              Yii::$app->user->isGuest ? '' : ['label' => 'PUBLICAR', 'url' => ['/producto/crear']],
                              Yii::$app->user->isGuest ? '' : ['label' => 'MIS PRODUCTOS', 'url' => ['/producto/mis-productos']],

                              Yii::$app->user->isGuest
                                    ? ['label' => '<i class="bi bi-person neon"></i> INGRESAR', 'url' => ['/site/login'],'encode' => false]
                                    : '<li class="nav-item">'
                                    . Html::beginForm(['/site/logout'])
                                    . Html::submitButton(
                                          'Logout (' . Yii::$app->user->identity->username . ')',
                                          ['class' => 'nav-link btn btn-link logout']
                                    )
                                    . Html::endForm()
                                    . '</li>'
                        ]
                  ]); ?>
            </div>

      </div>

      <?php
      NavBar::end(); ?>

</header>