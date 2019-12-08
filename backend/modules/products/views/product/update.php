<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\products\models\Products */

$this->title = "แก้ไขสินค้า";
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'รายการสินค้า'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-body">
        <?= $this->render('_form', [
            'model' => $model,
            'title'=>$this->title
        ]) ?>
    </div>
</div>
