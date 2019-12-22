<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use appxq\sdii\widgets\GridView;
use appxq\sdii\widgets\ModalForm;
use appxq\sdii\helpers\SDNoty;
use appxq\sdii\helpers\SDHtml;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\booking\models\BookingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'จัดการการอบรม');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="box box-primary">
    <div class="box-header">
        <?= $this->render('_icon');?> <?=  Html::encode($this->title) ?>
         <div class="pull-right">
             <?= Html::button(SDHtml::getBtnAdd(), ['data-url'=>Url::to(['booking/create']), 'class' => 'btn btn-success btn-sm', 'id'=>'modal-addbtn-booking']). ' ' .
		      Html::button(SDHtml::getBtnDelete(), ['data-url'=>Url::to(['booking/deletes']), 'class' => 'btn btn-danger btn-sm', 'id'=>'modal-delbtn-booking', 'disabled'=>false]) 
             ?>
         </div>
    </div>
<div class="box-body">    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php  Pjax::begin(['id'=>'booking-grid-pjax']);?>
    <?= GridView::widget([
	'id' => 'booking-grid',
/*	'panelBtn' => Html::button(SDHtml::getBtnAdd(), ['data-url'=>Url::to(['booking/create']), 'class' => 'btn btn-success btn-sm', 'id'=>'modal-addbtn-booking']). ' ' .
		      Html::button(SDHtml::getBtnDelete(), ['data-url'=>Url::to(['booking/deletes']), 'class' => 'btn btn-danger btn-sm', 'id'=>'modal-delbtn-booking', 'disabled'=>true]),*/
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
        'columns' => [
	    [
		'class' => 'yii\grid\CheckboxColumn',
		'checkboxOptions' => [
		    'class' => 'selectionBookingIds'
		],
		'headerOptions' => ['style'=>'text-align: center;'],
		'contentOptions' => ['style'=>'width:40px;text-align: center;'],
	    ],
	    [
		'class' => 'yii\grid\SerialColumn',
		'headerOptions' => ['style'=>'text-align: center;'],
		'contentOptions' => ['style'=>'width:60px;text-align: center;'],
	    ],

            'name',
            [
                'attribute' => 'date',
                'value' => function($model){
                    if($model->date){
                        return  \appxq\sdii\utils\SDdate::mysql2phpDateTime($model->date);
                    }
                }
            ],
            'time',
            'end_date',
            'user_name',
            // 'create_by',
            // 'create_date',
            // 'update_by',
            // 'update_date',

	    [
		'class' => 'appxq\sdii\widgets\ActionColumn',
		'contentOptions' => ['style'=>'width:180px;text-align: center;'],
		'template' => '{update} {delete}',
                'buttons'=>[
                    'update'=>function($url, $model){
                        return Html::a('<span class="fa fa-pencil"></span> '.Yii::t('app', 'Update'),
                                    yii\helpers\Url::to(['booking/update?id='.$model->id]), [
                                    'title' => Yii::t('app', 'Update'),
                                    'class' => 'btn btn-primary btn-xs',
                                    'data-action'=>'update',
                                    'data-pjax'=>0
                        ]);
                    },
                    'delete' => function ($url, $model) {                         
                        return Html::a('<span class="fa fa-trash"></span> '.Yii::t('app', 'Delete'), 
                                yii\helpers\Url::to(['booking/delete?id='.$model->id]), [
                                'title' => Yii::t('app', 'Delete'),
                                'class' => 'btn btn-danger btn-xs',
                                'data-confirm' => Yii::t('chanpan', 'Are you sure you want to delete this item?'),
                                'data-method' => 'post',
                                'data-action' => 'delete',
                                'data-pjax'=>0
                        ]);
                            
                        
                    },
                ]
	    ],
        ],
    ]); ?>
    <?php  Pjax::end();?>

</div>
</div>
<?=  ModalForm::widget([
    'id' => 'modal-booking',
    //'size'=>'modal-lg',
]);
?>

<?php  \richardfan\widget\JSRegister::begin([
    //'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_READY
]); ?>
<script>
// JS script
$('#modal-addbtn-booking').on('click', function() {
    modalBooking($(this).attr('data-url'));
});

$('#modal-delbtn-booking').on('click', function() {
    selectionBookingGrid($(this).attr('data-url'));
});

$('#booking-grid-pjax').on('click', '.select-on-check-all', function() {
    window.setTimeout(function() {
	var key = $('#booking-grid').yiiGridView('getSelectedRows');
	disabledBookingBtn(key.length);
    },100);
});

$('.selectionCoreOptionIds').on('click',function() {
    var key = $('input:checked[class=\"'+$(this).attr('class')+'\"]');
    disabledBookingBtn(key.length);
});

$('#booking-grid-pjax').on('dblclick', 'tbody tr', function() {
    var id = $(this).attr('data-key');
    modalBooking('<?= Url::to(['booking/update', 'id'=>''])?>'+id);
});	

$('#booking-grid-pjax').on('click', 'tbody tr td a', function() {
    var url = $(this).attr('href');
    var action = $(this).attr('data-action');

    if(action === 'update' || action === 'view') {
	modalBooking(url);
    } else if(action === 'delete') {
	yii.confirm('<?= Yii::t('chanpan', 'Are you sure you want to delete this item?')?>', function() {
	    $.post(
		url
	    ).done(function(result) {
		if(result.status == 'success') {
            swal({
                title: result.message,
                text: result.message,
                type: result.status,
                timer: 2000
            });
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
	});
    }
    return false;
});

function disabledBookingBtn(num) {
    if(num>0) {
	$('#modal-delbtn-booking').attr('disabled', false);
    } else {
	$('#modal-delbtn-booking').attr('disabled', true);
    }
}

function selectionBookingGrid(url) {
    yii.confirm('<?= Yii::t('chanpan', 'Are you sure you want to delete these items?')?>', function() {
	$.ajax({
	    method: 'POST',
	    url: url,
	    data: $('.selectionBookingIds:checked[name=\"selection[]\"]').serialize(),
	    dataType: 'JSON',
	    success: function(result, textStatus) {
		if(result.status == 'success') {
            swal({
                title: result.status,
                text: result.message,
                type: result.status,
                timer: 2000
            });
		    $.pjax.reload({container:'#booking-grid-pjax'});
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

function modalBooking(url) {
    $('#modal-booking .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');
    $('#modal-booking').modal('show')
    .find('.modal-content')
    .load(url);
}
</script>
<?php  \richardfan\widget\JSRegister::end(); ?>