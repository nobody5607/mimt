<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use appxq\sdii\helpers\SDNoty;
use appxq\sdii\helpers\SDHtml;

/* @var $this yii\web\View */
/* @var $model backend\modules\products\models\Orders */
/* @var $form yii\bootstrap\ActiveForm */
?>

    <div class="orders-form">

        <?php $form = ActiveForm::begin([
            'id' => $model->formName(),
        ]); ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="itemModalLabel">
                <img src="data:image/png;base64,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">
                รายการสั่งซื้อ</h4>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-8"><?= $form->field($model, 'order_id')->textInput(['maxlength' => true, 'readonly' => true]) ?></div>
                <div class="col-md-4">
                    <?= $form->field($model, 'total')->textInput(['maxlength' => true, 'readonly' => true]) ?>
                </div>
            </div>
            <?= $form->field($model, 'status')->inline()
                ->radioList(['1' => 'รอการชำระเงิน', '2' => 'ชำระเงินแล้ว','3'=>'ขายสินค้าแล้ว','4'=>'ยกเลิกคำสั่งซื้อ']) ?>
            <div id="preview-product"></div>
            <hr>
            <h3>หลักฐานการชำระเงิน</h3>
            <div id="preview-payment"></div>
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

<?php \richardfan\widget\JSRegister::begin([
    //'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_READY
]); ?>
    <script>
        function initPreviewProduct(){
            let url = '<?= \yii\helpers\Url::to(['/products/orders/product?order_id='.$model->order_id])?>';
            $.get(url, function (result) {
                $("#preview-product").html(result);
            });
        }
        function initPayment(){
            $("#preview-payment").html("<h3 class='text-center'>กำลังโหลดข้อมูล...</h3>");
            let order_id = '<?= $model->order_id; ?>';
            let url = '<?= \yii\helpers\Url::to(['/products/orders/payment'])?>';
            $.get(url,{order_id:order_id}, function (result) {
                $("#preview-payment").html(result);
            });
            return false;
        }
        initPayment();
        initPreviewProduct();
        // JS script
        $('form#<?= $model->formName()?>').on('beforeSubmit', function (e) {
            $('.btn-submit').prepend('<span class="icon-spin"><i class="fa fa-spinner fa-spin"></i></span> ');
            $('.btn-submit').attr('disabled', true);

            var $form = $(this);
            $.post(
                $form.attr('action'), //serialize Yii2 form
                $form.serialize()
            ).done(function (result) {
                $('.btn-submit .icon-spin').remove();
                $('.btn-submit').attr('disabled', false);
                if (result.status == 'success') {
                    swal({
                        title: result.status,
                        text: result.message,
                        type: result.status,
                        timer: 2000
                    });
                    $(document).find('#modal-orders').modal('hide');
                    $.pjax.reload({container: '#orders-grid-pjax'});

                } else {
                    swal({
                        title: result.status,
                        text: result.message,
                        type: result.status,
                        timer: 2000
                    });
                }
            }).fail(function () {
                <?= SDNoty::show("'" . SDHtml::getMsgError() . "Server Error'", '"error"')?>
                console.log('server error');
            });
            return false;
        });
    </script>
<?php \richardfan\widget\JSRegister::end(); ?>