<?php
namespace app\models;
use Yii;
use yii\base\Model;
use app\models\Users;

class FormRegister extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $jugador = true;
   
    public function rules(){
        return [
            [['username', 'email', 'password', 'password_repeat'], 'required', 'message' => Yii::t('app', 'Campo requerido')],
            ['username', 'match', 'pattern' => "/^.{3,20}$/", 'message' => Yii::t('app', 'Mínimo 3 y máximo 20 caracteres')],
            ['username', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => Yii::t('app', 'Sólo se aceptan letras y números')],
            ['username', 'username_existe'],
            ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => Yii::t('app', 'Mínimo 5 y máximo 80 caracteres')],
            ['email', 'email', 'message' => Yii::t('app', 'Formato no válido')],
            ['email', 'email_existe'],
            ['password', 'match', 'pattern' => "/^.{6,16}$/", 'message' => Yii::t('app', 'Mínimo 6 y máximo 16 caracteres')],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('app', 'Los contraseñas no coinciden')],
            ['jugador', 'boolean'],
        ];
    }
     
    public function attributeLabels(){
      return[
        'username' => Yii::t('app', 'Usuario'),
        'email' => Yii::t('app', 'Correo Electrónico'),
        'password' => Yii::t('app', 'Contraseña'),
        'password_repeat' => Yii::t('app', 'Confirmar Contraseña'),
        'jugador' => Yii::t('app', '¿Eres jugador?'),
      ];
    } 
    public function email_existe($attribute, $params)
    {
      //Buscar el email en la tabla
      $table = Users::find()->where("email=:email", [":email" => $this->email]);
      //Si el email existe mostrar el error
      if ($table->count() == 1){
        $this->addError($attribute, Yii::t('app', 'El email ya está registrado'));
      }
    }

    public function username_existe($attribute, $params)
    {
      //Buscar el username en la tabla
      $table = Users::find()->where("username=:username", [":username" => $this->username]);
      //Si el username existe mostrar el error
      if ($table->count() == 1){
          $this->addError($attribute, Yii::t('app', 'El usuario ya existe')) ;
      }
    }
}