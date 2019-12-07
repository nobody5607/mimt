<?php

namespace backend\modules\products\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property string $id
 * @property string $name ชื่อสินค้า
 * @property string $detail รายละเอียดสินค้า
 * @property string $price ราคา
 * @property int $rstat สถานะ
 * @property int $create_by สร้างโดย
 * @property string $create_date สร้างเมื่อ
 * @property int $update_by แก้ไขโดย
 * @property string $update_date แก้ไขเมื่อ
 * @property string $image รูปภาพหน้าสินค้า
 * @property int $order ลำดับที่
 * @property int $category หมวดหมู่
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['detail'], 'string'],
            [['rstat', 'create_by', 'update_by', 'order', 'category'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
            [['id'], 'string', 'max' => 100],
            [['name', 'image'], 'string', 'max' => 255],
            [['price'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'ชื่อสินค้า'),
            'detail' => Yii::t('app', 'รายละเอียดสินค้า'),
            'price' => Yii::t('app', 'ราคา'),
            'rstat' => Yii::t('app', 'สถานะ'),
            'create_by' => Yii::t('app', 'สร้างโดย'),
            'create_date' => Yii::t('app', 'สร้างเมื่อ'),
            'update_by' => Yii::t('app', 'แก้ไขโดย'),
            'update_date' => Yii::t('app', 'แก้ไขเมื่อ'),
            'image' => Yii::t('app', 'รูปภาพหน้าสินค้า'),
            'order' => Yii::t('app', 'ลำดับที่'),
            'category' => Yii::t('app', 'หมวดหมู่'),
        ];
    }
}
