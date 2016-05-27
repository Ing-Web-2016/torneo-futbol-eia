<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tarjeta */

$this->title = Yii::t('app', 'Create Tarjeta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tarjetas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tarjeta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
