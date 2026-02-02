<?php

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;


AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
$this->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css');
//$this->registerCssFile('@web/css/tema-moderno-elegante.css');
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
      <title><?= Html::encode($this->title) ?></title>
      <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
      <?php $this->beginBody() ?>

      <?= $this->render('header') ?><!-- HEADER IMPORTADO -->


      <main id="main" class="flex-shrink-0" role="main">
            <div class="container">

                  
                  <?= $content ?>
            </div>
      </main>

      <?= $this->render('footer') ?><!-- FOOTER IMPORTADO -->


      <?php $this->endBody() ?>

      <?php
      // BLOQUE PARA DISPARAR SWEETALERT
      // Este código solo se encarga de imprimir el JS de configuración, 
      // la librería ya la cargó el AppAsset.

      $flashes = Yii::$app->session->getAllFlashes();
      if ($flashes) {
            foreach ($flashes as $type => $message) {
                  $icon = 'info';
                  $title = 'Información';

                  if ($type === 'success') {
                        $icon = 'success';
                        $title = '¡Éxito!';
                  } elseif ($type === 'error' || $type === 'danger') {
                        $icon = 'error';
                        $title = 'Error';
                  } elseif ($type === 'warning') {
                        $icon = 'warning';
                        $title = 'Atención';
                  }

                  //$msgJson = \yii\helpers\Json::htmlEncode($message);
                  $msgJson = \yii\helpers\Json::encode($message);

                  $this->registerJs("
            Swal.fire({
                title: '$title',
                html: $msgJson,
                icon: '$icon',
                confirmButtonText: 'Aceptar'
            });
        ");
            }
      }
      ?>

</body>

</html>
<?php $this->endPage() ?>