<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\products\models\Categorys */

$this->title = Yii::t('app', 'Create Categorys');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categorys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorys-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
