<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use appxq\sdii\helpers\SDNoty;
use appxq\sdii\helpers\SDHtml;

/* @var $this yii\web\View */
/* @var $model backend\modules\products\models\Products */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin([
	    'id'=>$model->formName(),
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="itemModalLabel"><?= $this->render('_icon');?> จัดการสินค้า</h4>
    </div>
    <div class="modal-body">
        <?php
            if($model->image){
                $storageUrl = isset(Yii::$app->params['storageUrl'])?Yii::$app->params['storageUrl']:'';
                $fileName = "{$storageUrl}/uploads/{$model->image}";
                echo Html::img($fileName,['class'=>'img img-responsive','id'=>'image','style'=>'width:50px;']);
            }else{
                echo Html::img('',['id'=>'img img-responsive','id'=>'image','style'=>'width:50px;display:none;']);
            }
        ?>


        <?= $form->field($model, 'image')->fileInput() ?>
        <?= $form->field($model, 'category')
            ->dropDownList(\yii\helpers\ArrayHelper::map(\backend\modules\products\models\Categorys::find()->where('rstat not in(0,3)')->all(),'id','name'),['prompt'=>'--เลือกหมวดหมู่สินค้า--'])?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>
        <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'order')->textInput(['type'=>'number']) ?>
    </div>
    <div class="modal-footer">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-lg btn-block btn-submit' : 'btn btn-primary btn-lg btn-block btn-submit']) ?>
            </div>
        </div>
    </div> 

    <?php ActiveForm::end(); ?>

</div>

<?php  \richardfan\widget\JSRegister::begin([
    //'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_READY
]); ?>
<script>
// JS script
$('form#<?= $model->formName()?>').on('beforeSubmit', function (e) {

    $('.btn-submit').prepend('<span class="icon-spin"><i class="fa fa-spinner fa-spin"></i></span> ');
    $('.btn-submit').attr('disabled',true);

    var $form = $(this);
    var formData = new FormData($(this)[0]);
    $.ajax({
        url: $form.attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        enctype: 'multipart/form-data',
        success: function (result){
            $('.btn-submit .icon-spin').remove();
            $('.btn-submit').attr('disabled',false);

            if (result.status == 'success') {
                swal({
                    title: result.status,
                    text: result.message,
                    type: result.status,
                    timer: 1000
                });
                $(document).find('#modal-products').modal('hide');
                $.pjax.reload({container:'#products-grid-pjax'});

            } else {
                swal({
                    title: result.status,
                    text: result.message,
                    type: result.status,
                    //timer: 1000
                });

            }
        }
    }).fail(function (err) {
        $('.btn-submit .icon-spin').remove();
        $('.btn-submit').attr('disabled',false);
    });
    return false;
});


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#image').show();
            $('#image').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#products-image").change(function() {
    readURL(this);
});
</script>
<?php  \richardfan\widget\JSRegister::end(); ?>