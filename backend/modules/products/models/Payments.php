<?php

namespace backend\modules\products\models;

use Yii;

/**
 * This is the model class for table "payments".
 *
 * @property int $id รหัส
 * @property int $order_id รหัสสั่งซ์้อ
 * @property string $price ยอดโอน
 * @property string $image หลักฐานการโอน
 * @property string $note หมายเหตุ
 * @property int $rstat สถานะ
 * @property int $create_by สร้างโดย
 * @property string $create_date สร้างเมื่อ
 * @property int $update_by แก้ไขโดย
 * @property string $update_date แก้ไขเมื่อ
 */
class Payments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image','price','date'], 'required'],
            [['rstat', 'create_by', 'update_by'], 'integer'],
            [['price'], 'number'],
            [['note'], 'string'],
            [['create_date', 'update_date','order_id','date'], 'safe'],
            [['image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'รหัส'),
            'order_id' => Yii::t('app', 'รหัสสั่งซ์้อ'),
            'price' => Yii::t('app', 'ยอดโอน'),
            'image' => Yii::t('app', 'หลักฐานการโอน'),
            'note' => Yii::t('app', 'หมายเหตุ'),
            'rstat' => Yii::t('app', 'สถานะ'),
            'create_by' => Yii::t('app', 'สร้างโดย'),
            'create_date' => Yii::t('app', 'สร้างเมื่อ'),
            'update_by' => Yii::t('app', 'แก้ไขโดย'),
            'update_date' => Yii::t('app', 'แก้ไขเมื่อ'),
            'date'=>'วันที่โอนเงิน'
        ];
    }
}
