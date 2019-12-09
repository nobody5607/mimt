<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\products\models\Payments */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Payments',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
