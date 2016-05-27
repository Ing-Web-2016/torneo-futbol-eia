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
                'only' => ['logout', 'user', 'admin'],
                'rules' => [
                    [
                        'actions' => ['logout', 'admin'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserAdmin(Yii::$app->user->identity->id);
                        },
                    ],
                    [
                        'actions' => ['logout', 'jugador'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserJugador(Yii::$app->user->identity->id);
                        },
                    ],
                    [
                        'actions' => ['logout', 'capitan', 'jugador'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserCapitan(Yii::$app->user->identity->id);
                        },
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
            if (User::isUserAdmin(Yii::$app->user->identity->id)){
                return $this->redirect(["site/admin"]);
            } else if (User::isUserCapitan(Yii::$app->user->identity->id)){
                return $this->redirect(["site/capitan"]);
            } else {
                return $this->redirect(["site/jugador"]);
            }
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (User::isUserAdmin(Yii::$app->user->identity->id)) {
                return $this->redirect(["site/admin"]);
            } else if (User::isUserCapitan(Yii::$app->user->identity->id)) {
                return $this->redirect(["site/capitan"]);
            } else {
                return $this->redirect(["site/jugador"]);
            }
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

    public function actionJugador(){
        return $this->render("jugador");
    }
    public function actionCapitan(){
        return $this->render("capitan");
    }
    public function actionAdmin(){
        return $this->render("admin");
    }
}
