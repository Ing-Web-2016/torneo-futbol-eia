<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tarjeta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tarjeta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo')->textInput() ?>

    <?= $form->field($model, 'partido_id')->textInput() ?>

    <?= $form->field($model, 'jugador_id')->textInput() ?>

    <?= $form->field($model, 'causa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'minuto')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
