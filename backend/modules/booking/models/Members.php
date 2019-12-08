<?php

namespace backend\modules\booking\models;

use Yii;

/**
 * This is the model class for table "members".
 *
 * @property int $id
 * @property string $fname
 * @property string $lname
 * @property string $tel
 * @property string $address
 * @property string $email
 * @property string $booking_type
 * @property int $rstat สถานะ
 * @property int $create_by สร้างโดย
 * @property string $create_date สร้างเมื่อ
 * @property int $update_by แก้ไขโดย
 * @property string $update_date แก้ไขเมื่อ
 */
class Members extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'members';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rstat', 'create_by', 'update_by'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
            [['fname', 'lname', 'tel', 'address', 'email', 'booking_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fname' => Yii::t('app', 'ชื่อ'),
            'lname' => Yii::t('app', 'นามสกุล'),
            'tel' => Yii::t('app', 'เบอร์โทรศัพท์'),
            'address' => Yii::t('app', 'ที่อยู่'),
            'email' => Yii::t('app', 'อีเมล์'),
            'booking_type' => Yii::t('app', 'ประเภทการอบรม'),
            'rstat' => Yii::t('app', 'สถานะ'),
            'create_by' => Yii::t('app', 'สร้างโดย'),
            'create_date' => Yii::t('app', 'สร้างเมื่อ'),
            'update_by' => Yii::t('app', 'แก้ไขโดย'),
            'update_date' => Yii::t('app', 'แก้ไขเมื่อ'),
        ];
    }
}
