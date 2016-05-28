<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\FormRegister;
use app\models\Users;
use yii\widgets\ActiveForm;
use yii\web\Response;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\User;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'login'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex($language = null)
    {
        if (!is_null($language)) {
            $session = Yii::$app->session;
            $session['language'] = $language;
        }
        
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(["site/index"]);
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(["site/index"]);
        } else {
            return $this->render('login', [
            'model' => $model,
        ]);
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout(){
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionContact(){
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout(){
        return $this->render('about');
    }
    private function randKey($str='', $long=0){
        $key = null;
        $str = str_split($str);
        $start = 0;
        $limit = count($str)-1;
        for($x=0; $x<$long; $x++)
        {
            $key .= $str[rand($start, $limit)];
        }
        return $key;
    }
   
   public function actionConfirm(){
    //Confirmar los usuarios
    $table = new Users;
    if (Yii::$app->request->get()){
        //Obtenemos el valor de los parámetros get
        $id = Html::encode($_GET["id"]);
        $authKey = $_GET["authKey"];
        if ((int) $id){
            //Realizamos la consulta para obtener el registro
            $model = $table
            ->find()
            ->where("id=:id", [":id" => $id])
            ->andWhere("authKey=:authKey", [":authKey" => $authKey]);
            //Si el registro existe
            if ($model->count() == 1){
                $activar = Users::findOne($id);
                $activar->activate = 1;
                if ($activar->update()){
                    echo "Registro existoso";
                    echo "<meta http-equiv='refresh' content='8; ".Url::to(["site/login"], true)."'>";
                }
                else
                {
                    echo "Error en el registro";
                    echo "<meta http-equiv='refresh' content='8; ".Url::to(["site/login"], true)."'>";
                }
             }
            else{ 
            //Si no existe redireccionamos a login
                return $this->redirect(["site/login"]);
            }
        }
        else{ //Si id no es un número entero redireccionamos a login
            return $this->redirect(["site/login"]);
        }
    }
 }
  
 public function actionRegister(){
  $model = new FormRegister;
  $msg = null;
  //Validación formulario
  if ($model->load(Yii::$app->request->post())){
   if($model->validate()){
    //Consulta para guardar el usuario
    $table = new Users;
    $table->username = $model->username;
    $table->email = $model->email;
    //Encriptar password
    $table->password = crypt($model->password, Yii::$app->params["salt"]);
    //Creamos una cookie para autenticar al usuario cuando decida recordar la sesión, esta misma
    //clave será utilizada para activar el usuario
    $table->authKey = $this->randKey("abcdef0123456789", 200);
    //Creamos un token de acceso único para el usuario
    $table->accessToken = $this->randKey("abcdef0123456789", 200);
    if($model->jugador){
        $table->tipo = '1';
    } else{
        $table->tipo = '2';
    }
    //Si el registro es guardado correctamente
    if ($table->insert()){
     //Nueva consulta para obtener el id del usuario
     //Para confirmar al usuario se requiere su id y su authKey
     $user = $table->find()->where(["email" => $model->email])->one();
     $id = urlencode($user->id);
     $authKey = urlencode($user->authKey);
     $subject = "Torneo de futbol EIA";
     $body = "<h1>Bienvenido al Torneo de Futbol EIA</h1>";
     $body .= "<h2>Haz click en el link para finalizar tu registro</h2>";
     $body .= "<a href='" . Url::to(['site/confirm', 'id' => $id, 'authKey' => $authKey], true). "'>Confirmar</a>";
     //Enviar el correo
     Yii::$app->mailer->compose()
     ->setTo($user->email)
     ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
     ->setSubject($subject)
     ->setHtmlBody($body)
     ->send();
     $model->username = null;
     $model->email = null;
     $model->password = null;
     $model->password_repeat = null;
     $msg = Yii::t('app', 'Por favor confirma tu registro en tu cuenta de correo');
    }
    else{
     $msg = Yii::t('app', 'Ha ocurrido un error en el registro');
    } 
   }
   else
   {
    $model->getErrors();
   }
  }
  return $this->render("register", ["model" => $model, "msg" => $msg]);
 }

    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $adminPersona = $auth->createPermission('adminPersona');
        $adminPersona->description = 'Administrar las personas';
        $auth->add($adminPersona);

        $adminArbitro = $auth->createPermission('adminArbitro');
        $adminArbitro->description = 'Administrar los arbitros';
        $auth->add($adminArbitro);

        $adminPartido = $auth->createPermission('adminPartido');
        $adminPartido->description = 'Administrar los partidos';
        $auth->add($adminPartido);

        $adminTarjeta = $auth->createPermission('adminTarjeta');
        $adminTarjeta->description = 'Administrar las tarjetas';
        $auth->add($adminTarjeta);

        $adminGol = $auth->createPermission('adminGol');
        $adminGol->description = 'Administrar los goles';
        $auth->add($adminGol);

        $adminEquipo = $auth->createPermission('adminEquipo');
        $adminEquipo->description = 'Administrar los equipos';
        $auth->add($adminEquipo);

        $adminJugador = $auth->createPermission('adminJugador');
        $adminJugador->description = 'Administrar los jugadores';
        $auth->add($adminJugador);

        $adminColor = $auth->createPermission('adminColor');
        $adminColor->description = 'Administrar los colores';
        $auth->add($adminColor);

        $jugador = $auth->createRole('jugador');
        $auth->add($jugador);
        $auth->addChild($jugador, $adminColor);

        $capitan = $auth->createRole('capitan');
        $auth->add($capitan);
        $auth->addChild($capitan, $adminEquipo);
        $auth->addChild($capitan, $jugador);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $adminPersona);
        $auth->addChild($admin, $adminArbitro);
        $auth->addChild($admin, $adminPartido);
        $auth->addChild($admin, $adminTarjeta);
        $auth->addChild($admin, $adminGol);
        $auth->addChild($admin, $adminJugador);
        $auth->addChild($admin, $capitan);

        $auth->assign($jugador, 7);
        $auth->assign($capitan, 6);
        $auth->assign($admin, 5);
    }
}
