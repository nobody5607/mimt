<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use appxq\sdii\widgets\GridView;
use appxq\sdii\widgets\ModalForm;
use appxq\sdii\helpers\SDNoty;
use appxq\sdii\helpers\SDHtml;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\products\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;

?>
    <div class="box box-primary">
        <div class="box-header">
            <img src="data:image/png;base64,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"> <?= Html::encode($this->title) ?>
            <div class="pull-right">
                <?= Html::button(SDHtml::getBtnDelete(), ['data-url' => Url::to(['orders/deletes']), 'class' => 'btn btn-danger btn-sm', 'id' => 'modal-delbtn-orders', 'disabled' => false])
                ?>
            </div>
        </div>
        <div class="box-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?php Pjax::begin(['id' => 'orders-grid-pjax']); ?>
            <?= GridView::widget([
                'id' => 'orders-grid',
                /*	'panelBtn' => Html::button(SDHtml::getBtnAdd(), ['data-url'=>Url::to(['orders/create']), 'class' => 'btn btn-success btn-sm', 'id'=>'modal-addbtn-orders']). ' ' .
                              Html::button(SDHtml::getBtnDelete(), ['data-url'=>Url::to(['orders/deletes']), 'class' => 'btn btn-danger btn-sm', 'id'=>'modal-delbtn-orders', 'disabled'=>true]),*/
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'class' => 'yii\grid\CheckboxColumn',
                        'checkboxOptions' => [
                            'class' => 'selectionOrderIds'
                        ],
                        'headerOptions' => ['style' => 'text-align: center;'],
                        'contentOptions' => ['style' => 'width:40px;text-align: center;'],
                    ],
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'headerOptions' => ['style' => 'text-align: center;'],
                        'contentOptions' => ['style' => 'width:60px;text-align: center;'],
                    ],

                    'order_id',
                    [
                        'format' => 'raw',
                        'attribute' => 'status',
                        'value' => function ($model) {
                            if ($model->status == '1') {
                                return '<label class="label label-warning">ยังไม่ชำระเงิน</label>';
                            } else if ($model->status == '2') {
                                return '<label class="label label-success">ชำระเงินแล้ว</label>';
                            }else if ($model->status == '3') {
                                return '<label class="label label-danger">ยกเลิกคำสั่งซื้อ</label>';
                            }
                        },
                        'filter' => ['1' => 'ยังไม่ชำระเงิน', '2' => 'ชำระเงินแล้ว','3'=>'ยกเลิกคำสั่งซื้อ']
                    ],
                    [
                        'attribute' => 'total',
                        'value' => function ($model) {
                            if (isset($model->total)) {
                                return number_format($model->total);
                            }
                        }
                    ],

                    [
                        'attribute' => 'create_date',
                        'value' => function ($model) {
                            if ($model->create_date) {
                                return \appxq\sdii\utils\SDdate::mysql2phpDateTime($model->create_date);
                            }
                        }
                    ],
                    // 'update_by',
                    // 'update_date',

                    [
                        'class' => 'appxq\sdii\widgets\ActionColumn',
                        'contentOptions' => ['style' => 'width:280px;text-align: center;'],
                        'template' => '{update} {delete}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<span class="fa fa-eye"></span> ' . Yii::t('app', 'View'),
                                    yii\helpers\Url::to(['orders/view?id=' . $model->order_id]), [
                                        'title' => Yii::t('app', 'View'),
                                        'class' => 'btn btn-default btn-xs',
                                        'data-action' => 'view',
                                        'data-pjax' => 0
                                    ]);
                            },
                            'update' => function ($url, $model) {
                                return Html::a('<span class="fa fa-pencil"></span> ' . Yii::t('app', 'Update'),
                                    yii\helpers\Url::to(['orders/update?id=' . $model->order_id]), [
                                        'title' => Yii::t('app', 'Update'),
                                        'class' => 'btn btn-primary btn-xs',
                                        'data-action' => 'update',
                                        'data-pjax' => 0
                                    ]);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<span class="fa fa-trash"></span> ' . Yii::t('app', 'Delete'),
                                    yii\helpers\Url::to(['orders/delete?id=' . $model->order_id]), [
                                        'title' => Yii::t('app', 'Delete'),
                                        'class' => 'btn btn-danger btn-xs',
                                        'data-confirm' => Yii::t('chanpan', 'Are you sure you want to delete this item?'),
                                        'data-method' => 'post',
                                        'data-action' => 'delete',
                                        'data-pjax' => 0
                                    ]);


                            },
                        ]
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>

        </div>
    </div>
<?= ModalForm::widget([
    'id' => 'modal-orders',
    //'size'=>'modal-lg',
]);
?>

<?php \richardfan\widget\JSRegister::begin([
    //'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_READY
]); ?>
    <script>
        // JS script
        $('#modal-addbtn-orders').on('click', function () {
            modalOrder($(this).attr('data-url'));
        });

        $('#modal-delbtn-orders').on('click', function () {
            selectionOrderGrid($(this).attr('data-url'));
        });

        $('#orders-grid-pjax').on('click', '.select-on-check-all', function () {
            window.setTimeout(function () {
                var key = $('#orders-grid').yiiGridView('getSelectedRows');
                disabledOrderBtn(key.length);
            }, 100);
        });

        $('.selectionCoreOptionIds').on('click', function () {
            var key = $('input:checked[class=\"' + $(this).attr('class') + '\"]');
            disabledOrderBtn(key.length);
        });

        $('#orders-grid-pjax').on('dblclick', 'tbody tr', function () {
            var id = $(this).attr('data-key');
            modalOrder('<?= Url::to(['orders/update', 'id' => ''])?>' + id);
        });

        $('#orders-grid-pjax').on('click', 'tbody tr td a', function () {
            var url = $(this).attr('href');
            var action = $(this).attr('data-action');

            if (action === 'update' || action === 'view') {
                modalOrder(url);
            } else if (action === 'delete') {
                yii.confirm('<?= Yii::t('chanpan', 'Are you sure you want to delete this item?')?>', function () {
                    $.post(
                        url
                    ).done(function (result) {
                        if (result.status == 'success') {
                            swal({
                                title: result.status,
                                text: result.message,
                                type: result.status,
                                timer: 2000
                            });
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
                });
            }
            return false;
        });

        function disabledOrderBtn(num) {
            if (num > 0) {
                $('#modal-delbtn-orders').attr('disabled', false);
            } else {
                $('#modal-delbtn-orders').attr('disabled', true);
            }
        }

        function selectionOrderGrid(url) {
            yii.confirm('<?= Yii::t('chanpan', 'Are you sure you want to delete these items?')?>', function () {
                $.ajax({
                    method: 'POST',
                    url: url,
                    data: $('.selectionOrderIds:checked[name=\"selection[]\"]').serialize(),
                    dataType: 'JSON',
                    success: function (result, textStatus) {
                        if (result.status == 'success') {
                            swal({
                                title: result.status,
                                text: result.message,
                                type: result.status,
                                timer: 2000
                            });
                            $.pjax.reload({container: '#orders-grid-pjax'});
                        } else {
                            swal({
                                title: result.status,
                                text: result.message,
                                type: result.status,
                                timer: 2000
                            });
                        }
                    }
                });
            });
        }

        function modalOrder(url) {
            $('#modal-orders .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');
            $('#modal-orders').modal('show')
                .find('.modal-content')
                .load(url);
        }
    </script>
<?php \richardfan\widget\JSRegister::end(); ?>