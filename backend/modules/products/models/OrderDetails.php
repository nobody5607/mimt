<?php

namespace backend\modules\products\models;

use Yii;

/**
 * This is the model class for table "order_details".
 *
 * @property int $id
 * @property string $order_id
 * @property string $pro_id
 * @property string $price
 * @property int $qty
 * @property string $totalPrice
 */
class OrderDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price', 'totalPrice'], 'number'],
            [['qty'], 'integer'],
            [['order_id', 'pro_id'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'pro_id' => Yii::t('app', 'Pro ID'),
            'price' => Yii::t('app', 'Price'),
            'qty' => Yii::t('app', 'Qty'),
            'totalPrice' => Yii::t('app', 'Total Price'),
        ];
    }
}
