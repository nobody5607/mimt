<?php

namespace backend\modules\products\models;

use Yii;

/**
 * This is the model class for table "shippings".
 *
 * @property int $id รหัส
 * @property int $user_id รหัสผู้ใช้
 * @property int $default ใช้งาน
 * @property string $address ที่อยู่
 * @property int $rstat สถานะ
 * @property int $create_by สร้างโดย
 * @property string $create_date สร้างเมื่อ
 * @property int $update_by แก้ไขโดย
 * @property string $update_date แก้ไขเมื่อ
 */
class Shippings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shippings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'default', 'rstat', 'create_by', 'update_by'], 'integer'],
            [['address'], 'string'],
            [['create_date', 'update_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'รหัส'),
            'user_id' => Yii::t('app', 'รหัสผู้ใช้'),
            'default' => Yii::t('app', 'ใช้งาน'),
            'address' => Yii::t('app', 'ที่อยู่'),
            'rstat' => Yii::t('app', 'สถานะ'),
            'create_by' => Yii::t('app', 'สร้างโดย'),
            'create_date' => Yii::t('app', 'สร้างเมื่อ'),
            'update_by' => Yii::t('app', 'แก้ไขโดย'),
            'update_date' => Yii::t('app', 'แก้ไขเมื่อ'),
        ];
    }
}
