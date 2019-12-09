<?phpuse backend\modules\products\models\Shippings;use yii\helpers\Html;use yii\bootstrap\ActiveForm;use appxq\sdii\helpers\SDNoty;use appxq\sdii\helpers\SDHtml;use yii\web\View;/* @var $this yii\web\View *//* @var $model backend\modules\products\models\Shippings *//* @var $form yii\bootstrap\ActiveForm */?>    <div class="shippings-form">        <?php $form = ActiveForm::begin([            'id'=>$model->formName(),        ]); ?>        <div class="modal-header">            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>            <h4 class="modal-title" id="itemModalLabel"><?= $this->render('_icon');?> สถานที่จัดส่ง</h4>        </div>        <div class="modal-body">            <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>            <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>        </div>        <div class="modal-footer">            <div class="row">                <div class="col-md-6 col-md-offset-3">                    <button class="btn-submit-address btn btn-primary btn-block btn-lg">ยืนยัน</button>                </div>            </div>        </div>        <?php ActiveForm::end(); ?>    </div><?php  \richardfan\widget\JSRegister::begin(); ?>    <script>        function initShipping(){            let url = '<?= \yii\helpers\Url::to(['/product/shipping-all'])?>';            $.get(url, function (result) {                $("#shipping").html(result);            });        }        $('.btn-submit-address').on('click', function(e) {            let address = $("#shippings-address").val();            let id = $("#shippings-id").val();            let url = '<?= \yii\helpers\Url::to(['/product/shipping-create'])?>';            $.post(url,{address:address,id:id}, function (result) {                if(result.status == 'success') {                    swal({                        title: result.status,                        text: result.message,                        type: result.status,                        timer: 2000                    });                    $(document).find('#modal-shippings').modal('hide');                    setTimeout(function () {                        initShipping();                    },500);                } else {                    swal({                        title: result.status,                        text: result.message,                        type: result.status,                        timer: 2000                    });                }            });            return false;        });    </script><?php  \richardfan\widget\JSRegister::end(); ?>