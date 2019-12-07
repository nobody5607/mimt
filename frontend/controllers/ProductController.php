<?php
namespace frontend\controllers;

use appxq\sdii\utils\SDdate;
use appxq\sdii\utils\VarDumper;
use backend\modules\products\models\Carts;
use backend\modules\products\models\Products;
use backend\modules\products\models\ProductsSearch;
use common\modules\user\classes\CNUserFunc;
use cpn\chanpan\classes\CNMessage;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

class ProductController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionDetail()
    {
        $id = Yii::$app->request->get('id');
        $product = Products::find()->where('id=:id AND rstat not in(0,3)',[
            ':id' => $id
        ])->one();
        return $this->render('detail', [
            'product'=>$product
        ]);
    }
    public function actionDelToCart(){
        $cart_id = Yii::$app->request->post('cart_id');
        $model = Carts::findOne($cart_id);
        $model->rstat = 3;
        if($model->save()){
            return CNMessage::getSuccess("Success");
        }else{
            return CNMessage::getError("Error");
        }
    }
    public function actionCart()
    {
        $model  = Carts::find()->where('create_by=:user_id AND rstat not in(0,3) AND status = 1',[
            ':user_id' => CNUserFunc::getUserId()
        ])->all();
        $output = [];
        if($model){
            $storageUrl = isset(Yii::$app->params['storageUrl'])?Yii::$app->params['storageUrl']:'';
            $sum=0;
            foreach($model as $k=>$v){
                $product = Products::findOne($v->pro_id);
                $sum += $v->price;
                $output[] = [
                    'cart_id'=>$v->id,
                    'qty'=>$v->qty,
                    'totalPrice'=>$v->price,
                    'pro_price'=>$product->price, //ราคารวม จำนวน
                    'pro_id'=>$product->id,//ราคาสินค้า
                    'pro_name'=>$product->name,
                    'pro_img'=>$product->image,
                    'pro_img_path'=>$storageUrl
                ];
            }
        }
//        VarDumper::dump($output);
        return $this->render('cart', [
            'output'=>$output,
            'sum'=>$sum
        ]);
    }
    public function actionAddToCart()
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect(['/user/login']);
        }
        $proId = Yii::$app->request->post('pro_id');
        $qty = Yii::$app->request->post('qty');
        $cart_id = Yii::$app->request->post('cart_id');

        $model = Carts::find()->where('create_by=:user_id AND pro_id=:pro_id AND rstat not in(0,3) AND status = 1',[
            ':user_id' => CNUserFunc::getUserId(),
            ':pro_id' => $proId
        ])->one();
        $product = Products::findOne($proId);
        if($cart_id){
            $model->qty = $qty;
            $model->price = $product['price'] * $model->qty;
        }else{
            if($model){
                $model->qty += $qty;
                $model->price = $product['price'] * $model->qty;
            }else{
//                VarDumper::dump($product);
                $model = new Carts();
                $model->pro_id = $proId;
                $model->qty = $qty;
                $model->price = $product['price'] * $model->qty;
                $model->rstat = 1;
                $model->status = 1;
                $model->create_by = CNUserFunc::getUserId();
                $model->create_date = date('Y-m-d H:i:s');
            }
        }


        if($model->save()){
            return CNMessage::getSuccess("Success");
        }else{
            return CNMessage::getError("error", $model->errors);
        }
    }

    public function actionNumberFormat(){
        $number = Yii::$app->request->get('number');
        return number_format($number);
    }
    public function actionCheckout(){
        $ids = Yii::$app->request->post('ids');
        VarDumper::dump($ids);
    }

}
