<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
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
            ['label' => Yii::t('app', 'Inicio'), 'url' => ['/site/index'], 'linkOptions'=>['id'=>'letra']], 
            ['label' => Yii::t('app', 'Jugadores'), 'url' => ['/jugador/index'], 'linkOptions'=>['id'=>'letra']],
            ['label' => Yii::t('app', 'Arbitros'), 'url' => ['/arbitro/index'], 'linkOptions'=>['id'=>'letra']],
            ['label' => Yii::t('app', 'Equipos'), 'url' => ['/equipo/index'], 'linkOptions'=>['id'=>'letra']],
            ['label' => Yii::t('app', 'Partidos'), 'url' => ['/partido/index'], 'linkOptions'=>['id'=>'letra']],
            [
                'label' => Yii::t('app', 'Más'),
                'linkOptions'=>['id'=>'letra'],
                'items' => [
                    ['label' => Yii::t('app', 'Personas'), 'url' => ['/persona/index']],
                    ['label' => Yii::t('app', 'Goles'), 'url' => ['/gol/index']],
                    ['label' => Yii::t('app', 'Tarjetas'), 'url' => ['/tarjeta/index']],
                    ['label' => Yii::t('app', 'Colores'), 'url' => ['/color/index']]
                ]
            ],
            [
                'label' => Yii::t('app', 'Language'),
                'linkOptions'=>['id'=>'letra'],
                'items' => [
                    ['label' => 'English', 'url' => Url::to(['/site/index', 'language' => 'en-US'])],
                    ['label' => 'Español', 'url' => Url::to(['/site/index', 'language' => 'es-ES'])]
                ]
            ],
            Yii::$app->user->isGuest ? (
                ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login'], 'linkOptions'=>['id'=>'letra']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    Yii::t('app', 'Logout') . ' (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link', 'id' => 'letra']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>
    </div>
<div class="wrap">
    <div class="row" id="cabezote">
        <div class="col-md-offset-2 col-md-8">
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
