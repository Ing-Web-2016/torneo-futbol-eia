<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "persona".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $apellido
 * @property string $fecha_nacimiento
 * @property string $direccion
 * @property string $telefono
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Arbitro[] $arbitros
 * @property Jugador[] $jugadors
 */
class Persona extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'persona';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido', 'fecha_nacimiento', 'direccion', 'telefono'], 'required'],
            [['fecha_nacimiento'/*, 'created_at', 'updated_at'*/], 'safe'],
            [['nombre', 'apellido', 'direccion', 'telefono'], 'string', 'max' => 255],
            ['nombre', 'match', 'pattern'=> "/^.{3,225}$/", 'message'=> 'Mínimo 3 caracteres y máximo 225'],
            ['nombre', 'match', 'pattern'=> "/^.[a-zA-Z\s]+$/", 'message'=> 'Solo se aceptan letras'],
            ['apellido', 'match', 'pattern'=> "/^.{3,225}$/", 'message'=> 'Mínimo 3 caracteres y máximo 225'],
            [['fecha_nacimiento', 'to_date'], 'date'],
            ['apellido', 'match', 'pattern'=> "/^.[a-zA-Z\s]+$/", 'message'=> 'Solo se aceptan letras'],
            ['direccion', 'match', 'pattern'=> "/^.{3,225}$/", 'message'=> 'Mínimo 3 caracteres y máximo 225'],
            ['telefono', 'match', 'pattern'=> "/^.{7,12}$/", 'message'=> 'Mínimo 7 números y máximo 12'],
            ['telefono', 'match', 'pattern'=> "/^.[0-9\s]+$/", 'message'=> 'Solo se aceptan números'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'apellido' => Yii::t('app', 'Apellido'),
            'fecha_nacimiento' => Yii::t('app', 'Fecha Nacimiento'),
            'direccion' => Yii::t('app', 'Direccion'),
            'telefono' => Yii::t('app', 'Telefono'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArbitros()
    {
        return $this->hasMany(Arbitro::className(), ['persona_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJugadores()
    {
        return $this->hasMany(Jugador::className(), ['persona_id' => 'id']);
    }

    public function getFullname()
    {
        return $this->nombre . ' ' . $this->apellido;
    }
}
