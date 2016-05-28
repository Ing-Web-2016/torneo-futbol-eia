<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\models\Persona;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ArbitroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Arbitros');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="arbitro-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
            if (\Yii::$app->user->can('adminArbitro')) {
                Html::a(Yii::t('app', 'Create Arbitro'), ['create'], ['class' => 'btn btn-success']);
            }
        ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
            'attribute' => 'persona',
            'value' => 'persona.fullname'
            ],
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'view' => true,
                    'update' => \Yii::$app->user->can('adminArbitro'),
                    'delete' => \Yii::$app->user->can('adminArbitro')
                ]
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
