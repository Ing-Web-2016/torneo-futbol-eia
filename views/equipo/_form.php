<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Jugador;
use app\models\Persona;

/* @var $this yii\web\View */
/* @var $model app\models\Equipo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'capitan_id')->label(Yii::t('app', 'Capitan'))->dropdownList(
        ArrayHelper::map(Jugador::find()->asArray()->all(),
            'id',
            function($model, $defaultValue) {
                $persona = Persona::find()->where(['id'=>$model['id']])->one();
                return $persona['nombre'].' '.$persona['apellido'];
            }
        ),
        ['prompt'=>Yii::t('app', 'Elegir Capitán:')]
    ) ?>

<!--     <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
