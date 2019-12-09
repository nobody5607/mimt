<?php use appxq\sdii\helpers\SDHtml;use appxq\sdii\helpers\SDNoty;use appxq\sdii\widgets\ModalForm;use yii\bootstrap\ActiveForm;use yii\helpers\Html;?><div class="text-right">    <button class="btn btn-success btn-shipping-create">เพิ่มที่อยู่ใหม่</button></div><?phpif($model):?>    <?php $form = ActiveForm::begin([        'id'=>$model->formName(),    ]); ?>    <?php        $model->default = $model->id;    ?>    <?= $form->field($model, 'default')        ->radioList(\yii\helpers\ArrayHelper::map(\backend\modules\products\models\Shippings::find()            ->where('create_by=:user_id AND rstat not in(0,3)',[                ':user_id' => \common\modules\user\classes\CNUserFunc::getUserId()            ])->all(),'id','address'))->label(false) ?>            <?= Html::submitButton('ยืนยัน', ['class' => 'btn btn-warning btn-submit']) ?>            <button class="btn btn-default btn-cancel" type="button">ยกเลิก</button>    <?php ActiveForm::end(); ?><?php endif;?><?=  ModalForm::widget([    'id' => 'modal-shippings',    //'size'=>'modal-lg',]);?><?php  \richardfan\widget\JSRegister::begin(); ?><script>    $(".btn-shipping-create").on('click', function () {        let url = '<?= \yii\helpers\Url::to(['/product/shipping-create'])?>';        modalShipping(url);        return false;    });    function modalShipping(url) {        $('#modal-shippings .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');        $('#modal-shippings').modal('show')            .find('.modal-content')            .load(url);    }    function initShipping(){        let url = '<?= \yii\helpers\Url::to(['/product/shipping'])?>';        $.get(url, function (result) {            $("#shipping").html(result);        });    }    $(".btn-cancel").on('click', function () {        initShipping()    });    $('form#<?= $model->formName()?>').on('beforeSubmit', function(e) {        var $form = $(this);        $.post(            $form.attr('action'), //serialize Yii2 form            $form.serialize()        ).done(function(result) {            if(result.status == 'success'){                swal({                    title: result.message,                    text: result.message,                    type: result.status,                    timer: 2000                });            }        }).fail(function() {            <?= SDNoty::show("'" . SDHtml::getMsgError() . "Server Error'", '"error"')?>            console.log('server error');        });        return false;    });</script><?php  \richardfan\widget\JSRegister::end(); ?>