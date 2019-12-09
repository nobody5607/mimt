<?phpnamespace frontend\classes;use backend\modules\products\models\Banks;use backend\modules\products\models\Shippings;use common\modules\user\classes\CNUserFunc;use yii\db\Exception;class CNOrder{    public static function getDefaultBank(){        try{            $bank = Banks::find()->where('`order`=1 AND rstat not in(0,3)')->one();            return $bank;        }catch (Exception $ex){            return false;        }    }    public static function getOrderDetailByOrderId($order_id){        try{            $detail = \backend\modules\products\models\OrderDetails::find()                ->where('order_id=:id',[                    ':id'=>$order_id                ])                ->all();            return $detail;        }catch (Exception $ex){            return false;        }    }    public static function getShipping(){        try{            $model = Shippings::find()                ->where('create_by=:user_id AND `default`=1 AND rstat not in(0,3)',[                    ':user_id' => CNUserFunc::getUserId()                ])                ->one();            return $model;        }catch (Exception $ex){            return false;        }    }}