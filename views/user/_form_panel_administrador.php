<?php

use yii\helpers\Html;
?>
<div class="custom-box">
      <h4>Panel de Administrador</h4>

      <p>
            <?= Html::a('Gestionar Usuarios', ['/user/index'], []) ?>
      </p>

      <p>
            <?= Html::a('Gestionar Datos', ['/producto/index'], []) ?>
      </p>

      <p>
            <?= Html::a('Gestionar Tipo de Dato', ['/categoria/index'], []) ?>
      </p>
</div>
