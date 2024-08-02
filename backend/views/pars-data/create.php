<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ParsData $model */

$this->title = 'Create Pars Data';
$this->params['breadcrumbs'][] = ['label' => 'Pars Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pars-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
