<?php

use yii\helpers\Html;

$ismodal = $ismodal ?? false; // si no viene, asumimos false
?>
<div class="user-update">

    <?php
    if ($ismodal) {
        echo $this->render('_form_modal', [
            'model' => $model,
        ]);
    } else {
        echo $this->render('_form', [
            'model' => $model,
        ]);
    }
    ?>

</div>