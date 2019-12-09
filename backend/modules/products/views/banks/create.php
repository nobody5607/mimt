<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\products\models\Banks */

$this->title = Yii::t('app', 'Create Banks');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Banks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banks-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
