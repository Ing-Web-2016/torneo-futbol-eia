<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Register');
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Yii::t('app', 'Crear nueva cuenta') ?></h1>
<h3><?= $msg ?></h3>

<?php 
//se accede a la clase active record 
$form = ActiveForm::begin([
 'method' => 'post',
 'id' => 'formulario',
 'enableClientValidation' => true,
// 'enableAjaxValidation' => false,
]);
?>
<div class="form-group">
 <?= $form->field($model, "username")->input("text") ?>  
</div>
<div class="form-group">
 <?= $form->field($model, "email")->input("email") ?>  
</div>
<div class="form-group">
 <?= $form->field($model, "password")->input("password") ?>  
</div>
<div class="form-group">
 <?= $form->field($model, "password_repeat")->input("password") ?>  
</div>
<div class="form-group">
 <?= $form->field($model, 'jugador')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>
</div>	
<?= Html::submitButton(Yii::t('app', 'Enviar'), ["class" => "btn btn-primary"]) ?>
<?php $form->end() ?>