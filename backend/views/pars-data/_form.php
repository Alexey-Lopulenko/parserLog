<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ParsData $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pars-data-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?php //= $form->field($model, 'file_id')->textInput() ?>

    <?= $form->field($model, 'client_ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time_local')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'request')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body_bytes_sent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'http_referer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'http_user_agent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'full_row')->textarea(['rows' => 6]) ?>

<!--    --><?php //= $form->field($model, 'created_at')->textInput() ?>

<!--    --><?php //= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
