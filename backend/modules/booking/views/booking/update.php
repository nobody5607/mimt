<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\booking\models\Booking */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Booking',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bookings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
