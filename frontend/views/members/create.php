<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\booking\models\Members */

$this->title = Yii::t('app', 'Create Members');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Members'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="members-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
