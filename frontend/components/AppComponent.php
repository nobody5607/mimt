<?php

namespace frontend\components; 
use appxq\sdii\utils\VarDumper;
use Yii;
use yii\base\Component;
use yii\web\UnauthorizedHttpException;

class AppComponent extends Component {
    public function init() {
        parent::init();
        Yii::$app->language = 'th-TH';
	    $storageUrl = isset( Yii::$app->params['storageUrl'])? Yii::$app->params['storageUrl']:'';
        $backendUrl = isset( Yii::$app->params['backendUrl'])? Yii::$app->params['backendUrl']:'';
        $frontendUrl = isset( Yii::$app->params['frontendUrl'])? Yii::$app->params['frontendUrl']:'';
        Yii::setAlias('storageUrl', $storageUrl);
        Yii::setAlias('backendUrl', $backendUrl);
        Yii::setAlias('frontendUrl',$frontendUrl);
        $params = \common\modules\cores\classes\CoreQuery::getOptionsParams();
        Yii::$app->params = \yii\helpers\ArrayHelper::merge(Yii::$app->params, $params);

    }
}
