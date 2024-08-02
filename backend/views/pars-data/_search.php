<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ParsDataSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pars-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'file_id') ?>

    <?= $form->field($model, 'client_ip') ?>

    <?= $form->field($model, 'time_local') ?>

    <?= $form->field($model, 'request') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'body_bytes_sent') ?>

    <?php // echo $form->field($model, 'http_referer') ?>

    <?php // echo $form->field($model, 'http_user_agent') ?>

    <?php // echo $form->field($model, 'full_row') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
