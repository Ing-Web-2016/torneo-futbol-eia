<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jugador_equipo".
 *
 * @property integer $jugador_id
 * @property integer $equipo_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Equipo $equipo
 * @property Jugador $jugador
 */
class JugadorEquipo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jugador_equipo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jugador_id', 'equipo_id', 'created_at'], 'required'],
            [['jugador_id', 'equipo_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['equipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['equipo_id' => 'id']],
            [['jugador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jugador::className(), 'targetAttribute' => ['jugador_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'jugador_id' => Yii::t('app', 'Jugador ID'),
            'equipo_id' => Yii::t('app', 'Equipo ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipo()
    {
        return $this->hasOne(Equipo::className(), ['id' => 'equipo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJugador()
    {
        return $this->hasOne(Jugador::className(), ['id' => 'jugador_id']);
    }
}
