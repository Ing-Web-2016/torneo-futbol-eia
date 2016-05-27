<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Persona;

/* @var $this yii\web\View */
/* @var $model app\models\Jugador */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jugador-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'persona_id')->label('Persona')->dropdownList(
        ArrayHelper::map(Persona::find()->asArray()->all(),
            'id',
            function($model, $defaultValue) {
                return $model['nombre'].' '.$model['apellido'];
            }
        ),
        ['prompt'=>'Elegir Persona:']
    ) ?>

    <?= $form->field($model, 'num_camiseta')->textInput() ?>

<!--     <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
