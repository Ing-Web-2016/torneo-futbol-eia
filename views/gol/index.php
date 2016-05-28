<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\GolSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Gols');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gol-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
            if (\Yii::$app->user->can('adminGol')) {
                Html::a(Yii::t('app', 'Create Gol'), ['create'], ['class' => 'btn btn-success']);
            }
        ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'minuto',
            'partido_id',
            'jugador_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'view' => true,
                    'update' => \Yii::$app->user->can('adminGol'),
                    'delete' => \Yii::$app->user->can('adminGol')
                ]
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
