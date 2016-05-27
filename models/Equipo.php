<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "equipo".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $capitan_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Jugador $capitan
 * @property EquipoColor[] $equipoColores
 * @property Color[] $colores
 * @property JugadorEquipo[] $jugadorEquipos
 * @property Jugador[] $jugadores
 * @property Partido[] $partidoslocal
 * @property Partido[] $partidosvisitante
 */
class Equipo extends \yii\db\ActiveRecord
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
        return 'equipo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'capitan_id'], 'required'],
            [['capitan_id'], 'integer'],
            // [['created_at', 'updated_at'], 'safe'],
            [['nombre'], 'string', 'max' => 255],
            [['capitan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jugador::className(), 'targetAttribute' => ['capitan_id' => 'id']],
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
            'capitan_id' => Yii::t('app', 'Capitan ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCapitan()
    {
        return $this->hasOne(Jugador::className(), ['id' => 'capitan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipoColores()
    {
        return $this->hasMany(EquipoColor::className(), ['equipo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColores()
    {
        return $this->hasMany(Color::className(), ['id' => 'color_id'])->viaTable('equipo_color', ['equipo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJugadorEquipos()
    {
        return $this->hasMany(JugadorEquipo::className(), ['equipo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJugadores()
    {
        return $this->hasMany(Jugador::className(), ['id' => 'jugador_id'])->viaTable('jugador_equipo', ['equipo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartidosLocal()
    {
        return $this->hasMany(Partido::className(), ['equipo_local_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartidosVisitante()
    {
        return $this->hasMany(Partido::className(), ['equipo_visitante_id' => 'id']);
    }
}
