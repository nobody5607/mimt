<?php

namespace backend\modules\booking\models;

use Yii;

/**
 * This is the model class for table "booking".
 *
 * @property int $id
 * @property string $name ชื่ออบรม
 * @property string $date
 * @property string $time
 * @property int $rstat สถานะ
 * @property int $create_by สร้างโดย
 * @property string $create_date สร้างเมื่อ
 * @property int $update_by แก้ไขโดย
 * @property string $update_date แก้ไขเมื่อ
 */
class Booking extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'time', 'name'], 'required'],
            [['date', 'time', 'create_date', 'update_date'], 'safe'],
            [['rstat', 'create_by', 'update_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'ชื่ออบรม'),
            'date' => Yii::t('app', 'วันที่'),
            'time' => Yii::t('app', 'เวลา'),
            'rstat' => Yii::t('app', 'สถานะ'),
            'create_by' => Yii::t('app', 'สร้างโดย'),
            'create_date' => Yii::t('app', 'สร้างเมื่อ'),
            'update_by' => Yii::t('app', 'แก้ไขโดย'),
            'update_date' => Yii::t('app', 'แก้ไขเมื่อ'),
        ];
    }
}
