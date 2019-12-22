<?php

namespace backend\modules\products\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property string $order_id รหัสการสั่งซื้อ
 * @property int $status สถานะ
 * @property string $total จำนวนเงิน
 * @property int $rstat สถานะ
 * @property int $create_by สร้างโดย
 * @property string $create_date สร้างเมื่อ
 * @property int $update_by แก้ไขโดย
 * @property string $update_date แก้ไขเมื่อ
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id'], 'required'],
            [['status', 'rstat', 'create_by', 'update_by','del_status'], 'integer'],
            [['total'], 'number'],
            [['create_date', 'update_date'], 'safe'],
            [['order_id'], 'string', 'max' => 100],
            [['order_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_id' => Yii::t('app', 'รหัสการสั่งซื้อ'),
            'status' => Yii::t('app', 'สถานะ'),
            'total' => Yii::t('app', 'จำนวนเงิน'),
            'rstat' => Yii::t('app', 'สถานะ'),
            'create_by' => Yii::t('app', 'สร้างโดย'),
            'create_date' => Yii::t('app', 'สร้างเมื่อ'),
            'update_by' => Yii::t('app', 'แก้ไขโดย'),
            'update_date' => Yii::t('app', 'แก้ไขเมื่อ'),
            'del_status'=>'สถานะการจัดส่ง'
        ];
    }
}
