<?php
      use yii\bootstrap5\Html;
?>

<footer id="footer" class="mt-auto py-3 bg-light">
      <div class="container">
            <div class="row text-muted">
                  <div class="col-md-6 text-center text-md-start">&copy; G.E.R.M. Servicios En Informatica <?= date('Y') ?></div>
                  <div class="col-md-6 text-center text-md-end">

                        <?= Html::a('Acerca de Tu Showroom Online', ['/site/about'], ['class' => 'footer-link']) ?>
                        &nbsp; | &nbsp;
                        <?= Html::a('Contacto', ['/site/contact'], ['class' => 'footer-link']) ?>

                  </div>
            </div>
      </div>
</footer>