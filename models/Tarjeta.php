<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "tarjeta".
 *
 * @property integer $id
 * @property resource $tipo
 * @property integer $partido_id
 * @property integer $jugador_id
 * @property string $causa
 * @property string $minuto
 *
 * @property Jugador $jugador
 * @property Partido $partido
 */
class Tarjeta extends \yii\db\ActiveRecord
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
        return 'tarjeta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo', 'partido_id', 'jugador_id', 'causa', 'minuto'], 'required'],
            [['tipo'], 'string'],
            [['partido_id', 'jugador_id'], 'integer'],
            [['causa', 'minuto'], 'string', 'max' => 255],
            [['jugador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jugador::className(), 'targetAttribute' => ['jugador_id' => 'id']],
            [['partido_id'], 'exist', 'skipOnError' => true, 'targetClass' => Partido::className(), 'targetAttribute' => ['partido_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo' => Yii::t('app', 'Tipo'),
            'partido_id' => Yii::t('app', 'Partido ID'),
            'jugador_id' => Yii::t('app', 'Jugador ID'),
            'causa' => Yii::t('app', 'Causa'),
            'minuto' => Yii::t('app', 'Minuto'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJugador()
    {
        return $this->hasOne(Jugador::className(), ['id' => 'jugador_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartido()
    {
        return $this->hasOne(Partido::className(), ['id' => 'partido_id']);
    }
}
