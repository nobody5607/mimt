<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use appxq\sdii\widgets\GridView;
use appxq\sdii\widgets\ModalForm;
use appxq\sdii\helpers\SDNoty;
use appxq\sdii\helpers\SDHtml;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MembersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'จองอบรม');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="box box-primary">
    <div class="box-header">
         <?= $this->render('_icon')?> <?=  Html::encode($this->title) ?>
         <div class="pull-right">
             <?= Html::button(SDHtml::getBtnAdd()." เพิ่มงานอบรม", ['data-url'=>Url::to(['members/create']), 'class' => 'btn btn-success btn-sm', 'id'=>'modal-addbtn-members']). ' ' .
		      Html::button(SDHtml::getBtnDelete()." ลบงานอบรม", ['data-url'=>Url::to(['members/deletes']), 'class' => 'btn btn-danger btn-sm', 'id'=>'modal-delbtn-members', 'disabled'=>false]) 
             ?>
         </div>
    </div>
<div class="box-body">    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php  Pjax::begin(['id'=>'members-grid-pjax']);?>
    <?= GridView::widget([
	'id' => 'members-grid',
/*	'panelBtn' => Html::button(SDHtml::getBtnAdd(), ['data-url'=>Url::to(['members/create']), 'class' => 'btn btn-success btn-sm', 'id'=>'modal-addbtn-members']). ' ' .
		      Html::button(SDHtml::getBtnDelete(), ['data-url'=>Url::to(['members/deletes']), 'class' => 'btn btn-danger btn-sm', 'id'=>'modal-delbtn-members', 'disabled'=>true]),*/
	'dataProvider' => $dataProvider,
	//'filterModel' => $searchModel,
        'columns' => [
	    [
		'class' => 'yii\grid\CheckboxColumn',
		'checkboxOptions' => [
		    'class' => 'selectionMemberIds'
		],
		'headerOptions' => ['style'=>'text-align: center;'],
		'contentOptions' => ['style'=>'width:40px;text-align: center;'],
	    ],
	    [
		'class' => 'yii\grid\SerialColumn',
		'headerOptions' => ['style'=>'text-align: center;'],
		'contentOptions' => ['style'=>'width:60px;text-align: center;'],
	    ],
            'fname',
            'lname',
            'tel',
            'address',
            // 'email:email',
            [
                'attribute' => 'booking_type',
                'value'=>function($model){
                    if($model->booking_type){
                        $booking = \backend\modules\booking\models\Booking::findOne($model->booking_type);
                        return isset($booking->name)?$booking->name:'';
                    }
                },
                'filter' => \yii\helpers\ArrayHelper::map(\backend\modules\booking\models\Booking::find()
                    ->where('rstat not in(0,3)')->all(),'id','name')
            ],
            [
                'label' => 'วันที่จัด',
                'value'=>function($model){
                    if($model->booking_type){
                        $booking = \backend\modules\booking\models\Booking::findOne($model->booking_type);
                        return isset($booking->date)?$booking->date:'';
                    }
                }
            ],
            [
                'label' => 'เวลา',
                'value'=>function($model){
                    if($model->booking_type){
                        $booking = \backend\modules\booking\models\Booking::findOne($model->booking_type);
                        return isset($booking->time)?$booking->time:'';
                    }
                }
            ],
            // 'rstat',
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
                                    yii\helpers\Url::to(['members/update?id='.$model->id]), [
                                    'title' => Yii::t('app', 'Update'),
                                    'class' => 'btn btn-primary btn-xs',
                                    'data-action'=>'update',
                                    'data-pjax'=>0
                        ]);
                    },
                    'delete' => function ($url, $model) {                         
                        return Html::a('<span class="fa fa-trash"></span> '.Yii::t('app', 'Delete'), 
                                yii\helpers\Url::to(['members/delete?id='.$model->id]), [
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
    'id' => 'modal-members',
    //'size'=>'modal-lg',
]);
?>

<?php  \richardfan\widget\JSRegister::begin([
    //'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_READY
]); ?>
<script>
// JS script
$('#modal-addbtn-members').on('click', function() {
    modalMember($(this).attr('data-url'));
});

$('#modal-delbtn-members').on('click', function() {
    selectionMemberGrid($(this).attr('data-url'));
});

$('#members-grid-pjax').on('click', '.select-on-check-all', function() {
    window.setTimeout(function() {
	var key = $('#members-grid').yiiGridView('getSelectedRows');
	disabledMemberBtn(key.length);
    },100);
});

$('.selectionCoreOptionIds').on('click',function() {
    var key = $('input:checked[class=\"'+$(this).attr('class')+'\"]');
    disabledMemberBtn(key.length);
});

$('#members-grid-pjax').on('dblclick', 'tbody tr', function() {
    var id = $(this).attr('data-key');
    modalMember('<?= Url::to(['members/update', 'id'=>''])?>'+id);
});	

$('#members-grid-pjax').on('click', 'tbody tr td a', function() {
    var url = $(this).attr('href');
    var action = $(this).attr('data-action');

    if(action === 'update' || action === 'view') {
	modalMember(url);
    } else if(action === 'delete') {
	yii.confirm('<?= Yii::t('chanpan', 'Are you sure you want to delete this item?')?>', function() {
	    $.post(
		url
	    ).done(function(result) {
		if(result.status == 'success') {
            swal({
                title: result.status,
                text: result.message,
                type: result.status,
                timer: 2000
            });
		    $.pjax.reload({container:'#members-grid-pjax'});
		} else {
            swal({
                title: result.status,
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

function disabledMemberBtn(num) {
    if(num>0) {
	$('#modal-delbtn-members').attr('disabled', false);
    } else {
	$('#modal-delbtn-members').attr('disabled', true);
    }
}

function selectionMemberGrid(url) {
    yii.confirm('<?= Yii::t('chanpan', 'Are you sure you want to delete these items?')?>', function() {
	$.ajax({
	    method: 'POST',
	    url: url,
	    data: $('.selectionMemberIds:checked[name=\"selection[]\"]').serialize(),
	    dataType: 'JSON',
	    success: function(result, textStatus) {
		if(result.status == 'success') {
            swal({
                title: result.status,
                text: result.message,
                type: result.status,
                timer: 2000
            });
		    $.pjax.reload({container:'#members-grid-pjax'});
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

function modalMember(url) {
    $('#modal-members .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');
    $('#modal-members').modal('show')
    .find('.modal-content')
    .load(url);
}
</script>
<?php  \richardfan\widget\JSRegister::end(); ?>