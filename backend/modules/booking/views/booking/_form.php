<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use appxq\sdii\helpers\SDNoty;
use appxq\sdii\helpers\SDHtml;

/* @var $this yii\web\View */
/* @var $model backend\modules\booking\models\Booking */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="booking-form">

    <?php $form = ActiveForm::begin([
	'id'=>$model->formName(),
    ]); ?>

    <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="itemModalLabel"><?= $this->render('_icon');?> จัดการการอบรม</h4>
    </div>

    <div class="modal-body">
	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-md-6">
            <?php
                echo $form->field($model, 'date')->widget(\kartik\date\DatePicker::classname(), [
                    'options' => ['placeholder' => '-- เลือกวันที่ --'],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                        'todayBtn' => true,
                    ]
                ]);
            ?>
        </div>
        <div class="col-md-6">
            <?php

                echo $form->field($model, 'time')
                    ->widget(\kartik\time\TimePicker::classname(), [
                            'size' => 'sm',
                            'pluginOptions' => [
                                'showSeconds' => true,
                                'showMeridian' => false,
                                'minuteStep' => 1,
                                'secondStep' => 5,
                            ]
                    ]);
            ?>
        </div>
    </div>
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
$('form#<?= $model->formName()?>').on('beforeSubmit', function(e) {
    $('.btn-submit').prepend('<span class="icon-spin"><i class="fa fa-spinner fa-spin"></i></span> ');
    $('.btn-submit').attr('disabled',true);

    var $form = $(this);
    $.post(
        $form.attr('action'), //serialize Yii2 form
        $form.serialize()
    ).done(function(result) {
        $('.btn-submit .icon-spin').remove();
        $('.btn-submit').attr('disabled',false);
        if(result.status == 'success') {
            swal({
                title: result.message,
                text: result.message,
                type: result.status,
                timer: 2000
            });
            $(document).find('#modal-booking').modal('hide');
            $.pjax.reload({container:'#booking-grid-pjax'});

        } else {
            swal({
                title: result.message,
                text: result.message,
                type: result.status,
                timer: 2000
            });
        } 
    }).fail(function() {
        <?= SDNoty::show("'" . SDHtml::getMsgError() . "Server Error'", '"error"')?>
        console.log('server error');
    });
    return false;
});
</script>
<?php  \richardfan\widget\JSRegister::end(); ?>