<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "jugador".
 *
 * @property integer $id
 * @property integer $persona_id
 * @property integer $num_camiseta
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Equipo[] $equipos
 * @property Gol[] $goles
 * @property Persona $persona
 * @property JugadorEquipo[] $jugadorEquipos
 * @property Equipo[] $equipos0
 * @property Tarjeta[] $tarjetas
 */
class Jugador extends \yii\db\ActiveRecord
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
        return 'jugador';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['persona_id', 'num_camiseta'], 'required'],
            [['persona_id', 'num_camiseta'], 'integer'],
            // [['created_at', 'updated_at'], 'safe'],
            [['persona_id'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['persona_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'persona_id' => Yii::t('app', 'Persona ID'),
            'num_camiseta' => Yii::t('app', 'Num Camiseta'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipoCapitan()
    {
        return $this->hasMany(Equipo::className(), ['capitan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoles()
    {
        return $this->hasMany(Gol::className(), ['jugador_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Persona::className(), ['id' => 'persona_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJugadorEquipos()
    {
        return $this->hasMany(JugadorEquipo::className(), ['jugador_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipos()
    {
        return $this->hasMany(Equipo::className(), ['id' => 'equipo_id'])->viaTable('jugador_equipo', ['jugador_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTarjetas()
    {
        return $this->hasMany(Tarjeta::className(), ['jugador_id' => 'id']);
    }
}
