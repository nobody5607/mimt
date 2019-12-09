<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use appxq\sdii\widgets\GridView;
use appxq\sdii\widgets\ModalForm;
use appxq\sdii\helpers\SDNoty;
use appxq\sdii\helpers\SDHtml;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\products\models\BanksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'จัดการธนาคาร');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="box box-primary">
    <div class="box-header">
        <img src="data:image/png;base64,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">
          <?=  Html::encode($this->title) ?>
         <div class="pull-right">
             <?= Html::button(SDHtml::getBtnAdd(), ['data-url'=>Url::to(['banks/create']), 'class' => 'btn btn-success btn-sm', 'id'=>'modal-addbtn-banks']). ' ' .
		      Html::button(SDHtml::getBtnDelete(), ['data-url'=>Url::to(['banks/deletes']), 'class' => 'btn btn-danger btn-sm', 'id'=>'modal-delbtn-banks', 'disabled'=>false]) 
             ?>
         </div>
    </div>
<div class="box-body">    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php  Pjax::begin(['id'=>'banks-grid-pjax']);?>
    <?= GridView::widget([
	'id' => 'banks-grid',
/*	'panelBtn' => Html::button(SDHtml::getBtnAdd(), ['data-url'=>Url::to(['banks/create']), 'class' => 'btn btn-success btn-sm', 'id'=>'modal-addbtn-banks']). ' ' .
		      Html::button(SDHtml::getBtnDelete(), ['data-url'=>Url::to(['banks/deletes']), 'class' => 'btn btn-danger btn-sm', 'id'=>'modal-delbtn-banks', 'disabled'=>true]),*/
	'dataProvider' => $dataProvider,
        'columns' => [
	    [
		'class' => 'yii\grid\CheckboxColumn',
		'checkboxOptions' => [
		    'class' => 'selectionBankIds'
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
            'detail',
            [
                'attribute' => 'order',
                'value' => function($model){
                    if(isset($model->order) && $model->order == 1){
                        return 'กำลังใช้งาน';
                    }
                    return 'ไม่ได้ใช้งาน';
                }
            ],
            [
                'attribute' => 'create_by',
                'value' => function($model){
                    if($model->create_by){
                        return \common\modules\user\classes\CNUserFunc::getFullNameByUserId($model->create_by);
                    }
                }
            ],
            [
                'attribute' => 'create_date',
                'value' => function($model){
                    if($model->create_date){
                        return  \appxq\sdii\utils\SDdate::mysql2phpDateTime($model->create_date);
                    }
                }
            ],
            // 'create_date',
            // 'update_by',
            // 'update_date',
            // 'order',

	    [
		'class' => 'appxq\sdii\widgets\ActionColumn',
		'contentOptions' => ['style'=>'width:180px;text-align: center;'],
		'template' => '{update} {delete}',
                'buttons'=>[
                    'update'=>function($url, $model){
                        return Html::a('<span class="fa fa-pencil"></span> '.Yii::t('app', 'Update'),
                                    yii\helpers\Url::to(['banks/update?id='.$model->id]), [
                                    'title' => Yii::t('app', 'Update'),
                                    'class' => 'btn btn-primary btn-xs',
                                    'data-action'=>'update',
                                    'data-pjax'=>0
                        ]);
                    },
                    'delete' => function ($url, $model) {                         
                        return Html::a('<span class="fa fa-trash"></span> '.Yii::t('app', 'Delete'), 
                                yii\helpers\Url::to(['banks/delete?id='.$model->id]), [
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
    'id' => 'modal-banks',
    //'size'=>'modal-lg',
]);
?>

<?php  \richardfan\widget\JSRegister::begin([
    //'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_READY
]); ?>
<script>
// JS script
$('#modal-addbtn-banks').on('click', function() {
    modalBank($(this).attr('data-url'));
});

$('#modal-delbtn-banks').on('click', function() {
    selectionBankGrid($(this).attr('data-url'));
});

$('#banks-grid-pjax').on('click', '.select-on-check-all', function() {
    window.setTimeout(function() {
	var key = $('#banks-grid').yiiGridView('getSelectedRows');
	disabledBankBtn(key.length);
    },100);
});

$('.selectionCoreOptionIds').on('click',function() {
    var key = $('input:checked[class=\"'+$(this).attr('class')+'\"]');
    disabledBankBtn(key.length);
});

$('#banks-grid-pjax').on('dblclick', 'tbody tr', function() {
    var id = $(this).attr('data-key');
    modalBank('<?= Url::to(['banks/update', 'id'=>''])?>'+id);
});	

$('#banks-grid-pjax').on('click', 'tbody tr td a', function() {
    var url = $(this).attr('href');
    var action = $(this).attr('data-action');

    if(action === 'update' || action === 'view') {
	modalBank(url);
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
		    $.pjax.reload({container:'#banks-grid-pjax'});
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

function disabledBankBtn(num) {
    if(num>0) {
	$('#modal-delbtn-banks').attr('disabled', false);
    } else {
	$('#modal-delbtn-banks').attr('disabled', true);
    }
}

function selectionBankGrid(url) {
    yii.confirm('<?= Yii::t('chanpan', 'Are you sure you want to delete these items?')?>', function() {
	$.ajax({
	    method: 'POST',
	    url: url,
	    data: $('.selectionBankIds:checked[name=\"selection[]\"]').serialize(),
	    dataType: 'JSON',
	    success: function(result, textStatus) {
		if(result.status == 'success') {
            swal({
                title: result.status,
                text: result.message,
                type: result.status,
                timer: 2000
            });
		    $.pjax.reload({container:'#banks-grid-pjax'});
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

function modalBank(url) {
    $('#modal-banks .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');
    $('#modal-banks').modal('show')
    .find('.modal-content')
    .load(url);
}
</script>
<?php  \richardfan\widget\JSRegister::end(); ?>