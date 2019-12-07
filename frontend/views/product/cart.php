<?phpuse appxq\sdii\helpers\SDHtml;use appxq\sdii\helpers\SDNoty;use backend\modules\products\models\Categorys;use yii\helpers\Html;use yii\web\View;/* @var $this yii\web\View *//* @var $model backend\modules\products\models\Categorys */    $this->title = Yii::t('app', 'รถเข็น');    $this->params['breadcrumbs'][] = ['label' => 'รายการสินค้า', 'url' => ['/product/index']];    $this->params['breadcrumbs'][] = $this->title;?><div class="container-fluid">    <div class="row">        <aside class="col-lg-9">            <div class="card">                <div class="table-responsive">                    <table class="table table-borderless table-shopping-cart">                        <thead class="text-muted">                        <tr class="small text-uppercase">                            <th scope="col" width="20">                                <input id="selectAll" type="checkbox"><label for='selectAll'></label>                            </th>                            <th scope="col">รายการ</th>                            <th scope="col" width="120">จำนวน</th>                            <th scope="col" width="120">ราคา</th>                            <th scope="col" class="text-right d-none d-md-block" width="200"></th>                        </tr>                        </thead>                        <tbody>                        <?php if ($output): ?>                            <?php foreach ($output as $k => $v): ?>                                <tr>                                    <td>                                        <input data-price="<?= $v['totalPrice']?>" type="checkbox" class="checkItem" name="checkItem" value="<?= $v['cart_id']?>">                                    </td>                                    <td>                                        <figure class="itemside align-items-center">                                            <div class="aside">                                                <?php                                                $path = $v['pro_img_path'];                                                $image = '';                                                if (!$v['pro_img']) {                                                    $image = "{$path}/uploads/noimage.png";                                                } else {                                                    $image = "{$path}/uploads/{$v['pro_img']}";                                                }                                                ?>                                                <img src="<?= $image; ?>" class="img-sm">                                            </div>                                            <figcaption class="info">                                                <a href="#" class="title text-dark"                                                   data-abc="true"><?= $v['pro_name']; ?></a>                                            </figcaption>                                        </figure>                                    </td>                                    <td><select class="form-control select-qty" data-pro-id="<?= $v['pro_id']; ?>" data-cart-id="<?= $v['cart_id']; ?>">                                            <?php                                            $tiems = 10;                                            ?>                                            <?php for ($i = 1; $i <= $tiems; $i++): ?>                                                <option value="<?= $i; ?>" <?= ($i == $v['qty']) ? "selected" : ''; ?> ><?= $i; ?></option>                                            <?php endfor; ?>                                        </select></td>                                    <td>                                        <div class="price-wrap">                                            <span class="price">฿<?= number_format($v['totalPrice'], 2) ?></span>                                        </div>                                    </td>                                    <td class="text-center d-none d-md-block">                                        <a class="btn-del" data-cart-id="<?= $v['cart_id']?>" href="#"> ลบ</a>                                    </td>                                </tr>                            <?php endforeach; ?>                        <?php endif; ?>                        </tbody>                    </table>                </div>            </div>        </aside>        <aside class="col-lg-3">            <div class="card mb-3">                <div class="card">                    <div class="card-body">                        <dl class="dlist-align">                            <dt style="margin-top:10px;">รวมค่าสินค้า:</dt>                            <dd class="text-right ml-3">                            <span style="    font-size: 20pt;font-weight: bold;color: #FF5722;padding-left:5px;">                                ฿<span id="totalPrice"><?= number_format($sum) ?></span>                            </span>                            </dd>                        </dl>                        <hr>                        <a href="#" class="btn-check-out btn btn-out btn-warning btn-square btn-main mt-2"                           data-abc="true">สั่งสินค้า</a>                    </div>                </div>        </aside>    </div></div><?php \richardfan\widget\JSRegister::begin();?><script>    $( document ).ready(function() {        var checkItem = [];        setTimeout(function(){            $("#selectAll").trigger('click');        },100);        $("#selectAll").click(function () {            $("input:checkbox").attr('disabled', true);            $('input:checkbox').not(this).prop('checked', this.checked);            setTotalPrice();        });        $(".checkItem").on('change',function(){            $(".checkItem").attr('disabled', true);            setTotalPrice();        });        function setTotalPrice(){            checkItem= [];            let totalPrice = 0;            $("#totalPrice").html(totalPrice);            $(".btn-check-out").attr('disabled', true);            $('input[name="checkItem"]:checked').each(function() {                let price = parseFloat($(this).attr('data-price'));                if($(this).attr('data-price') === undefined){                    price = 0;                }                totalPrice += price;                let url = '<?= \yii\helpers\Url::to(['/product/number-format'])?>';                $.get(url,{number:totalPrice}, function(result){                    $("#totalPrice").html(result);                    $(".btn-check-out").attr('disabled', false);                    $("input:checkbox").attr('disabled', false);                });                checkItem.push(this.value);            });            setTimeout(function () {                $("input:checkbox").attr('disabled', false);            },500);        }        //checkItem        $(".btn-check-out").on('click', function () {            checkItem= [];            $('input[name="checkItem"]:checked').each(function() {                // console.log(this.value);                checkItem.push(this.value);            });            return false;        });    });    $(".btn-del").on('click',function () {        let cart_id = $(this).attr('data-cart-id');        let url = '<?= \yii\helpers\Url::to(['/product/del-to-cart'])?>';        bootbox.confirm({            message: "คุณแน่ใจว่าต้องการลบหรือไม่?",            buttons: {                confirm: {                    label: '<i class="fa fa-check"></i> ใช่',                    className: 'btn-success'                },                cancel: {                    label: '<i class="fa fa-times"></i> ไม่',                    className: 'btn-default'                }            },            callback: function (result) {               if(result === true){                   $.post(url,{cart_id:cart_id}).done(function(result) {                       if(result.status == 'success') {                           swal({                               title: result.message,                               text: result.message,                               type: result.status,                               timer: 2000                           });                           setTimeout(function () {                               location.reload();                           },1000);                       } else {                           swal({                               title: result.message,                               text: result.message,                               type: result.status,                               timer: 2000                           });                       }                   }).fail(function() {                       <?= SDNoty::show("'" . SDHtml::getMsgError() . "Server Error'", '"error"')?>                       console.log('server error');                   });               }            }        });    });    $(".select-qty").on('change', function () {        let qty = $(this).val();        let pro_id = $(this).attr('data-pro-id');        let cart_id = $(this).attr('data-cart-id');        let url = '<?= \yii\helpers\Url::to(['/product/add-to-cart'])?>';        $.post(url,{pro_id:pro_id, qty:qty,cart_id:cart_id}, function (result) {            if(result.status == 'success') {                swal({                    title: result.message,                    text: result.message,                    type: result.status,                    timer: 2000                });                url = '<?= \yii\helpers\Url::to(['/product/cart'])?>';                setTimeout(function () {                    location.href = url;                },1000);            } else {                swal({                    title: result.message,                    text: result.message,                    type: result.status,                    timer: 2000                });            }        }).fail(function (error) {            console.log(error);        })        return false;    });</script><?php \richardfan\widget\JSRegister::end();?><?php \appxq\sdii\widgets\CSSRegister::begin(); ?><style>    body {        background-color: #eeeeee;        font-family: 'Open Sans', serif;        font-size: 14px    }    .container-fluid {    }    .card-body {        -ms-flex: 1 1 auto;        flex: 1 1 auto;        padding: 1.40rem    }    .img-sm {        width: 80px;        height: 80px    }    .itemside .info {        padding-left: 15px;        padding-right: 7px    }    .table-shopping-cart .price-wrap {        line-height: 1.2    }    .table-shopping-cart .price {        font-weight: bold;        margin-right: 5px;        display: block    }    .text-muted {        color: #969696 !important    }    a {        text-decoration: none !important    }    .card {        position: relative;        display: -ms-flexbox;        display: flex;        -ms-flex-direction: column;        flex-direction: column;        min-width: 0;        word-wrap: break-word;        background-color: #fff;        background-clip: border-box;        border: 1px solid rgba(0, 0, 0, .125);        border-radius: 0px    }    .itemside {        position: relative;        display: -webkit-box;        display: -ms-flexbox;        display: flex;        width: 100%    }    .dlist-align {        display: -webkit-box;        display: -ms-flexbox;        display: flex    }    [class*="dlist-"] {        margin-bottom: 5px    }    .coupon {        border-radius: 1px    }    .price {        font-weight: 600;        color: #212529    }    .btn.btn-out {        outline: 1px solid #fff;        outline-offset: -5px    }    .btn-main {        border-radius: 2px;        text-transform: capitalize;        font-size: 15px;        padding: 10px 19px;        cursor: pointer;        color: #fff;        width: 100%    }    .btn-warning {        color: #fff;        background-color: #ff5722;        border-color: #FF5722;    }    .btn-light {        color: #ffffff;        background-color: #F44336;        border-color: #f8f9fa;        font-size: 12px    }    .btn-light:hover {        color: #ffffff;        background-color: #F44336;        border-color: #F44336    }    .btn-apply {        font-size: 11px    }</style><?php \appxq\sdii\widgets\CSSRegister::end(); ?>