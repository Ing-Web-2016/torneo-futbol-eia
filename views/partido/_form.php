<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Partido */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="partido-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'lugar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'arbitro_id')->textInput() ?>

    <?= $form->field($model, 'equipo_local_id')->textInput() ?>

    <?= $form->field($model, 'equipo_visitante_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
