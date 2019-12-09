<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\products\models\Banks */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Banks',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Banks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banks-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
