<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\products\models\Shippings */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Shippings',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shippings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shippings-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
