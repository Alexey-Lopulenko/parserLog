<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ParsData $model */

$this->title = 'Update Pars Data: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pars Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pars-data-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
