<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Partido */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Partidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partido-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php 
            if (\Yii::$app->user->can('adminPartido')) {
                Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
            }
        ?>
        <?php 
            if (\Yii::$app->user->can('adminPartido')) {
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
            'fecha',
            'lugar',
            'arbitro_id',
            'equipo_local_id',
            'equipo_visitante_id',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
