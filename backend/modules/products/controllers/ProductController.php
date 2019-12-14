<?php

namespace backend\modules\products\controllers;

use appxq\sdii\utils\SDUtility;
use appxq\sdii\utils\VarDumper;
use Yii;
use backend\modules\products\models\Products;
use backend\modules\products\models\ProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use appxq\sdii\helpers\SDHtml;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Products model.
 */
class ProductController extends Controller
{

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (in_array($action->id, array('create', 'update', 'delete', 'index'))) {

            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams); 
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->getRequest()->isAjax) {
            return $this->renderAjax('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    private function getMaxOrder(){
        $product = Products::find()->orderBy(['order'=>SORT_DESC])->one();
        if(!$product){
            return 1;
        }

        return isset($product['order'])?$product['order']+1:1;
    }
    private function uploadImage($model, $attribute){
        $image = UploadedFile::getInstances($model,$attribute);
        $fileName = "";
        if ($image) {
            $file = $image[0];
            $realFileName = \appxq\sdii\utils\SDUtility::getMillisecTime();
            $folder = "/web/uploads/";
            $path = Yii::getAlias('@storage') . "{$folder}";
            $type = $file->extension;
            $filePath = "{$path}/{$realFileName}.{$type}";
            if ($file->saveAs("{$filePath}")) {
                $fileName = "{$realFileName}.{$type}";
            }
        }
        return $fileName;
    }
    public function actionCreate()
    {


            $model = new Products();
            if ($model->load(Yii::$app->request->post())) {
                $model->id = SDUtility::getMillisecTime();
                $image = $this->uploadImage($model,'image');
                if($image != ''){
                    $model->image = $image;
                }
                $model->rstat = 1;
                $model->create_date = date('Y-m-d H:i:s');
                $model->create_by = isset(\Yii::$app->user->id) ? \Yii::$app->user->id : '';
                if ($model->save()) {
                    return \cpn\chanpan\classes\CNMessage::getSuccess('Create successfully');
                } else {
                   // VarDumper::dump($model->errors);
                    return \cpn\chanpan\classes\CNMessage::getError('Can not create the data.',$model->errors);
                }
            } else {
                $model->order = $this->getMaxOrder();
                return $this->render('create', [
                    'model' => $model,
                ]);
            }

    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

            $model = $this->findModel($id);
            Yii::$app->session['image'] = $model->image;
            if ($model->load(Yii::$app->request->post())) {
                $image = $this->uploadImage($model,'image');
                if($image != ''){
                    $model->image = $image;
                }else{
                    $model->image = Yii::$app->session['image'];
                }
                $model->rstat = 1;
                $model->update_date = date('Y-m-d H:i:s');
                $model->update_by = isset(\Yii::$app->user->id) ? \Yii::$app->user->id : '';
                if ($model->save()) {
                    return \cpn\chanpan\classes\CNMessage::getSuccess('Update successfully');
                } else {
                    return \cpn\chanpan\classes\CNMessage::getError('Can not update the data.');
                }
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }

    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->getRequest()->isAjax) {
            $model = $this->findModel($id);
            $model->rstat = 3;
            $model->update_date = date('Y-m-d H:i:s');
            $model->update_by = isset(\Yii::$app->user->id) ? \Yii::$app->user->id : '';
            if ($model->save()) {

                return \cpn\chanpan\classes\CNMessage::getSuccess('Delete successfully');
            } else {
                return \cpn\chanpan\classes\CNMessage::getError('Can not delete the data.');
            }
        } else {
            throw new NotFoundHttpException('Invalid request. Please do not repeat this request again.');
        }
    }

    public function actionDeletes()
    {
        if (Yii::$app->getRequest()->isAjax) {

            if (isset($_POST['selection'])) {
                foreach ($_POST['selection'] as $id) {
                    $model = $this->findModel($id);
                    $model = $this->findModel($id);
                    $model->rstat = 3;
                    $model->update_date = date('Y-m-d H:i:s');
                    $model->update_by = isset(\Yii::$app->user->id) ? \Yii::$app->user->id : '';
                    $model->save();
                }
                return \cpn\chanpan\classes\CNMessage::getSuccess('Delete successfully');
            } else {
                return \cpn\chanpan\classes\CNMessage::getError('Can not delete the data.');
            }
        } else {
            throw new NotFoundHttpException('Invalid request. Please do not repeat this request again.');
        }
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
