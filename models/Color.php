<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "color".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $hex
 * @property string $created_at
 * @property string $updated_at
 *
 * @property EquipoColor[] $equipoColores
 * @property Equipo[] $equipos
 */
class Color extends \yii\db\ActiveRecord
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
        return 'color';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'hex'], 'required'],
            // [['created_at', 'updated_at'], 'safe'],
            [['nombre', 'hex'], 'string', 'max' => 255],
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
            'hex' => Yii::t('app', 'Hex'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipoColores()
    {
        return $this->hasMany(EquipoColor::className(), ['color_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipos()
    {
        return $this->hasMany(Equipo::className(), ['id' => 'equipo_id'])->viaTable('equipo_color', ['color_id' => 'id']);
    }
}
