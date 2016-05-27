<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "partido".
 *
 * @property integer $id
 * @property string $fecha
 * @property string $lugar
 * @property integer $arbitro_id
 * @property integer $equipo_local_id
 * @property integer $equipo_visitante_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Gol[] $gols
 * @property Arbitro $arbitro
 * @property Equipo $equipoLocal
 * @property Equipo $equipoVisitante
 * @property Tarjeta[] $tarjetas
 */
class Partido extends \yii\db\ActiveRecord
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
        return 'partido';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha', 'lugar', 'arbitro_id', 'equipo_local_id', 'equipo_visitante_id'], 'required'],
            [['fecha'/*, 'created_at', 'updated_at'*/], 'safe'],
            [['arbitro_id', 'equipo_local_id', 'equipo_visitante_id'], 'integer'],
            [['lugar'], 'string', 'max' => 255],
            [['arbitro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Arbitro::className(), 'targetAttribute' => ['arbitro_id' => 'id']],
            [['equipo_local_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['equipo_local_id' => 'id']],
            [['equipo_visitante_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['equipo_visitante_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fecha' => Yii::t('app', 'Fecha'),
            'lugar' => Yii::t('app', 'Lugar'),
            'arbitro_id' => Yii::t('app', 'Arbitro ID'),
            'equipo_local_id' => Yii::t('app', 'Equipo Local ID'),
            'equipo_visitante_id' => Yii::t('app', 'Equipo Visitante ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGols()
    {
        return $this->hasMany(Gol::className(), ['partido_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArbitro()
    {
        return $this->hasOne(Arbitro::className(), ['id' => 'arbitro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipoLocal()
    {
        return $this->hasOne(Equipo::className(), ['id' => 'equipo_local_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipoVisitante()
    {
        return $this->hasOne(Equipo::className(), ['id' => 'equipo_visitante_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTarjetas()
    {
        return $this->hasMany(Tarjeta::className(), ['partido_id' => 'id']);
    }
}
