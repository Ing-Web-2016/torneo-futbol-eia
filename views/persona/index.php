<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Personas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persona-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
            if (\Yii::$app->user->can('adminPersona')) {
                Html::a(Yii::t('app', 'Create Persona'), ['create'], ['class' => 'btn btn-success']);
            }
        ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'apellido',
            'fecha_nacimiento',
            //'direccion',
            // 'telefono',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'view' => true,
                    'update' => \Yii::$app->user->can('adminPersona'),
                    'delete' => \Yii::$app->user->can('adminPersona')
                ]
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
