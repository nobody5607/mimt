<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\products\models\Categorys */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Categorys',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categorys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorys-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
