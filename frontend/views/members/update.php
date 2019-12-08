<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\booking\models\Members */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Members',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Members'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="members-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
