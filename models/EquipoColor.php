<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "equipo_color".
 *
 * @property integer $equipo_id
 * @property integer $color_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Color $color
 * @property Equipo $equipo
 */
class EquipoColor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'equipo_color';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['equipo_id', 'color_id', 'created_at'], 'required'],
            [['equipo_id', 'color_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['color_id'], 'exist', 'skipOnError' => true, 'targetClass' => Color::className(), 'targetAttribute' => ['color_id' => 'id']],
            [['equipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['equipo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'equipo_id' => Yii::t('app', 'Equipo ID'),
            'color_id' => Yii::t('app', 'Color ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColor()
    {
        return $this->hasOne(Color::className(), ['id' => 'color_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipo()
    {
        return $this->hasOne(Equipo::className(), ['id' => 'equipo_id']);
    }
}
