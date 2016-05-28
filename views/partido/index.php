<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PartidoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Partidos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partido-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
            if (\Yii::$app->user->can('adminPartido')) {
                Html::a(Yii::t('app', 'Create Partido'), ['create'], ['class' => 'btn btn-success']);
            }
        ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fecha',
            'lugar',
            'arbitro_id',
            'equipo_local_id',
            // 'equipo_visitante_id',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'view' => true,
                    'update' => \Yii::$app->user->can('adminPartido'),
                    'delete' => \Yii::$app->user->can('adminPartido')
                ]
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
