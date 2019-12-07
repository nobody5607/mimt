<?php
namespace frontend\controllers;

use appxq\sdii\utils\VarDumper;
use backend\modules\products\models\Products;
use backend\modules\products\models\ProductsSearch;
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

}
