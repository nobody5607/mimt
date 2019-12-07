<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\products\models\Shippings */

$this->title = Yii::t('app', 'Create Shippings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shippings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shippings-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
