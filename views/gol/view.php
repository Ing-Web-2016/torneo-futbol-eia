<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Gol */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gols'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gol-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php 
            if (\Yii::$app->user->can('adminGol')) {
                Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
            }
        ?>
        <?php 
            if (\Yii::$app->user->can('adminGol')) {
                Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]);
            }
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'minuto',
            'partido_id',
            'jugador_id',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
