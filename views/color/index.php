<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ColorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Colors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="color-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
            if (\Yii::$app->user->can('adminColor')) {
                Html::a(Yii::t('app', 'Create Color'), ['create'], ['class' => 'btn btn-success']);
            }
        ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'hex',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'view' => true,
                    'update' => \Yii::$app->user->can('adminColor'),
                    'delete' => \Yii::$app->user->can('adminColor')
                ]
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
