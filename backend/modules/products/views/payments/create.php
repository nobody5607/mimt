<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\products\models\Payments */

$this->title = Yii::t('app', 'Create Payments');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
