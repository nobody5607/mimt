<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\products\models\Orders */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Orders',
]) . ' ' . $model->order_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->order_id, 'url' => ['view', 'id' => $model->order_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
