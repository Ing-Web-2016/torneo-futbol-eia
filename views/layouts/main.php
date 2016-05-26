
<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Carousel;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="row">
<?php
    NavBar::begin([
        'options' => [
            'class' => 'navbar navbar-fixed-top',
            'id'=>'navegador',
            
        ],
    ]);
    echo Nav::widget([
        'options' => ['class'=>'nav nav-justified'],
        'items' => [ 
            ['label' => 'INICIO', 'url' => ['/site/inicio'], 'linkOptions'=>['id'=>'letra']], 
            ['label' => 'LOGIN', 'url' => ['/site/login'], 'linkOptions'=>['id'=>'letra']],
            ['label' => 'JUGADORES', 'url' => ['/site/jugadores'], 'linkOptions'=>['id'=>'letra']],
            ['label' => 'EQUIPOS', 'url' => ['/site/equipos'], 'linkOptions'=>['id'=>'letra']],
            ['label' => 'PARTIDOS', 'url' => ['/site/partidos'], 'linkOptions'=>['id'=>'letra']]
        ],
    ]);
    NavBar::end();
    ?>
    </div>
<div class="wrap">
<div class="row" id="cabezote">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        
    
    <?php
    echo Carousel::widget([
    'items' => [
        '<img id="imagen" src="http://localhost/torneo-futbol-eia/views/layouts/img/eia1.jpeg"/>',
        '<img id="imagen" src="http://localhost/torneo-futbol-eia/views/layouts/img/eia2.jpeg"/>',
        '<img id="imagen" src="http://localhost/torneo-futbol-eia/views/layouts/img/eia3.jpeg"/>',
        '<img id="imagen" src="http://localhost/torneo-futbol-eia/views/layouts/img/eia4.jpeg"/>',
        '<img id="imagen" src="http://localhost/torneo-futbol-eia/views/layouts/img/eia5.jpeg"/>',
        '<img id="imagen" src="http://localhost/torneo-futbol-eia/views/layouts/img/eia6.jpeg"/>',
    ],
    'options'=>[
     'icon'=>('GLYPHICON_CIRCLE_ARROW_LEFT'),
    'icon'=>('GLYPHICON_CIRCLE_ARROW_RIGHT'),
    ],
    ]);
    ?>
    
    </div>
    <div class="col-md-2"></div>
    </div>

    
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <img src="http://localhost/torneo-futbol-eia/views/layouts/img/pie.jpg" class="img-responsive center-block" id="pie">
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
