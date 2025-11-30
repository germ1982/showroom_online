<header id="header">
      <?php

      use yii\bootstrap5\NavBar;
      use yii\bootstrap5\Nav;
      use yii\bootstrap5\Html;

      // 1. PREPARACIÓN DEL FORMULARIO DE BÚSQUEDA
      $boton_busqueda = Html::beginForm(['/site/buscar'], 'get', ['class' => 'd-flex']) // Quitamos ms-3 aquí para controlarlo con la columna
            . '<div class="input-group neon">'
            . Html::textInput('q', '', ['class' => 'form-control', 'placeholder' => 'Buscar...'])
            . Html::button('<i class="bi bi-search"></i>', ['class' => 'btn btn-search', 'onclick' => 'buscar()'])
            . '</div>'
            . Html::endForm();

      // 2. PREPARACIÓN ITEMS DEL MENÚ DERECHO (USUARIO)
      // Lo sacamos afuera para que el widget quede limpio visualmente
      $menuItemsRight = [];
      if (Yii::$app->user->isGuest) {
            $menuItemsRight[] = ['label' => '<i class="bi bi-person neon"></i> INGRESAR', 'url' => ['/site/login'], 'encode' => false];
      } else {
            $menuItemsRight[] = ['label' => '<i class="bi bi-star neon"></i> FAVORITOS', 'url' => ['/producto/favoritos'], 'encode' => false];
            $menuItemsRight[] = ['label' => '<i class="bi bi-megaphone neon"></i> PUBLICAR', 'url' => ['/producto/crear'], 'encode' => false];
            $menuItemsRight[] = ['label' => '<i class="bi bi-box-seam neon"></i> MIS PRODUCTOS', 'url' => ['/producto/mis-productos'], 'encode' => false];
            $menuItemsRight[] = ['label' => '<i class="bi bi-person neon"></i> '.mb_strtoupper(Yii::$app->user->identity->username), 'url' => ['/producto/usuario'], 'encode' => false];
            // Botón Logout
            $menuItemsRight[] = [
                  'label' => 'SALIR <i class="bi bi-box-arrow-right neon"></i>',
                  'url' => ['/site/logout'],
                  'encode' => false,
                  'linkOptions' => [
                        'data-method' => 'post', // <--- ESTO ES LA CLAVE
                        'class' => 'nav-link',   // Asegura que tenga la misma clase que los demás (aunque Nav suele ponerla sola)
                  ],
            ];
      }

      // 3. INICIO DEL NAVBAR
      NavBar::begin([
            'brandLabel' => '<img src="' . Yii::$app->request->baseUrl . '/img/TSO.png" alt="TSO" style="height:24px;"> ' . Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
      ]);
      ?>

      <style>
            .container {
                  max-width: 100%;
            }
      </style>
      <div class="row w-100 align-items-center">


            <div class="col-md-3">
                  <?php
                  echo Nav::widget([
                        'options' => ['class' => 'navbar-nav justify-content-start'], // Alineación
                        'encodeLabels' => false,
                        'items' => [

                              [
                                    'label' => $boton_busqueda,
                                    'encode' => false,
                                    'options' => [] // Margen para separar del botón inicio
                              ],
                        ]
                  ]);
                  ?>
            </div>

            <div class="col-md-9 d-flex justify-content-end">
                  <?php
                  echo Nav::widget([
                        'options' => ['class' => 'navbar-nav justify-content-end'], // Alineamos todo a la derecha
                        'items' => $menuItemsRight, // Usamos la variable que preparamos arriba
                  ]);
                  ?>
            </div>

      </div> <?php NavBar::end(); ?>
</header>