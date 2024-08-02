<?php

use app\models\ParsData;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ParsDataSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pars Data';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pars-data-index">

<!--    <h1>--><?php //= Html::encode($this->title) ?><!--</h1>-->

<!--    <p>-->
<!--        --><?php //= Html::a('Create Pars Data', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'file.name',
            'client_ip',
            'time_local',
            'request',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, ParsData $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
        'pager' => ['class' => \yii\bootstrap5\LinkPager::class],
    ]); ?>


</div>
