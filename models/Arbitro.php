<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "arbitro".
 *
 * @property integer $id
 * @property integer $persona_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Persona $persona
 * @property Partido[] $partidos
 */
class Arbitro extends \yii\db\ActiveRecord
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
        return 'arbitro';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['persona_id'], 'required'],
            [['persona_id'], 'integer'],
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
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
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
    public function getPartidos()
    {
        return $this->hasMany(Partido::className(), ['arbitro_id' => 'id']);
    }
}
