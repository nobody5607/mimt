<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\booking\models\Booking */

$this->title = Yii::t('app', 'Create Booking');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bookings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
