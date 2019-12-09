<?phpuse appxq\sdii\helpers\SDHtml;use appxq\sdii\helpers\SDNoty;use backend\modules\products\models\Categorys;use yii\helpers\Html;use yii\web\View;/* @var $this yii\web\View *//* @var $model backend\modules\products\models\Categorys */$this->title = Yii::t('app', 'ทำการสั่งซื้อ');$this->params['breadcrumbs'][] = ['label' => 'รายการสินค้า', 'url' => ['/product/index']];$this->params['breadcrumbs'][] = $this->title;?><div class="container-fluid">    <div class="row">        <aside class="col-md-12 col-sm-12 col-xs-12">            <div class="card">                <div class="card-header">                    <?= $this->render('_address'); ?> ที่อยู่ในการจัดส่ง                </div>                <div class="card-body">                    <div id="shipping"></div>                    <?php \richardfan\widget\JSRegister::begin(); ?>                    <script>                        function initShipping() {                            let url = '<?= \yii\helpers\Url::to(['/product/shipping'])?>';                            $.get(url, function (result) {                                $("#shipping").html(result);                            });                        }                        initShipping();                    </script>                    <?php \richardfan\widget\JSRegister::end(); ?>                </div>            </div>        </aside>        <aside class="col-md-12 col-sm-12 col-xs-12" style="margin-top:15px;">            <div class="card">                <div class="table-responsive">                    <table class="table table-borderless table-shopping-cart">                        <thead class="text-muted">                        <tr class="small text-uppercase">                            <th scope="col">รายการ</th>                            <th scope="col" width="120">ราคาต่อหน่วย</th>                            <th scope="col" width="120">จำนวน</th>                            <th scope="col" width="120">ราคา</th>                        </tr>                        </thead>                        <tbody>                        <?php if ($output): ?>                            <?php foreach ($output as $k => $v): ?>                                <tr>                                    <td>                                        <figure class="itemside align-items-center">                                            <div class="aside">                                                <?php                                                $path = $v['pro_img_path'];                                                $image = '';                                                if (!$v['pro_img']) {                                                    $image = "{$path}/uploads/noimage.png";                                                } else {                                                    $image = "{$path}/uploads/{$v['pro_img']}";                                                }                                                ?>                                                <img src="<?= $image; ?>" class="img-sm">                                            </div>                                            <figcaption class="info">                                                <a href="#" class="title text-dark"                                                   data-abc="true"><?= $v['pro_name']; ?></a>                                            </figcaption>                                        </figure>                                    </td>                                    <td>฿<?= number_format($v['pro_price']) ?></td>                                    <td><?= $v['qty'] ?></td>                                    <td>                                        <div class="price-wrap">                                            <span>฿<?= number_format($v['totalPrice']) ?></span>                                        </div>                                    </td>                                </tr>                            <?php endforeach; ?>                        <?php endif; ?>                        </tbody>                    </table>                </div>            </div>        </aside>        <aside class="col-md-12 col-sm-12 col-xs-12" style="margin-top:15px;">            <div class="row">                <div class="col-md-12">                    <div class="card mb-3">                        <div class="card">                            <div class="card-body">                                <div class="row">                                    <div class="col-md-3 col-xs-3 col-sm-3 col-lg-3">                                        <h4>เลือกวิธีการชำระเงิน</h4>                                    </div>                                    <div class="col-md-9 col-xs-9 col-sm-9 col-lg-9"><!--                                            <button class="btn btn-default">ชำระเงินผ่าน Paypal</button>-->                                            <button class="btn btn-default active">โอน/ชำระผ่านบัญชีธนาคาร</button><!--                                            <button class="btn btn-default">ชำระเงินปลายทาง</button>-->                                    </div>                                </div>                                <hr>                                <div class="row">                                    <div class="col-md-8">                                    </div>                                    <div class="col-md-4">                                        <dl class="dlist-align">                                            <dt style="margin-top:10px;">การชำระเงินทั้งหมด:</dt>                                            <dd class="text-right ml-3">                                    <span style="    font-size: 20pt;font-weight: bold;color: #FF5722;padding-left:5px;">                                        ฿<span id="totalPrice"><?= number_format($sum) ?></span>                                    </span>                                            </dd>                                        </dl>                                        <hr>                                        <a href="#"                                           class="btn-check-out btn btn-out btn-warning btn-square btn-main mt-2"                                           data-abc="true">สั่งสินค้า</a>                                    </div>                                </div>                            </div>                        </div>                    </div>                </div>        </aside>    </div></div><?php \richardfan\widget\JSRegister::begin(); ?><script>    $(".btn-check-out").on('click', function () {        $(this).attr('disabled', true);        let url = '<?= \yii\helpers\Url::to(['/product/set-order'])?>';        $.get(url, function (result) {            if (result.status == 'success') {                swal({                    title: result.message,                    text: result.message,                    type: result.status,                    timer: 2000                });                url = '<?= \yii\helpers\Url::to(['/order'])?>';                setTimeout(function () {                    location.href = url;                    $(this).attr('disabled', false);                }, 1000);            } else {                swal({                    title: result.message,                    text: result.message,                    type: result.status,                    timer: 2000                });                $(this).attr('disabled', false);            }        }).fail(function (error) {            console.log(error);            $(this).attr('disabled', false);        })        return false;    });</script><?php \richardfan\widget\JSRegister::end(); ?><?php \appxq\sdii\widgets\CSSRegister::begin(); ?><style>    body {        background-color: #eeeeee;        font-family: 'Open Sans', serif;        font-size: 14px    }    .container-fluid {    }    .card-body {        -ms-flex: 1 1 auto;        flex: 1 1 auto;        padding: 1.40rem    }    .card-header {        -ms-flex: 1 1 auto;        flex: 1 1 auto;        padding: 1.40rem    }    .img-sm {        width: 80px;        height: 80px    }    .itemside .info {        padding-left: 15px;        padding-right: 7px    }    .table-shopping-cart .price-wrap {        line-height: 1.2    }    .table-shopping-cart .price {        font-weight: bold;        margin-right: 5px;        display: block    }    .text-muted {        color: #969696 !important    }    a {        text-decoration: none !important    }    .card {        position: relative;        display: -ms-flexbox;        display: flex;        -ms-flex-direction: column;        flex-direction: column;        min-width: 0;        word-wrap: break-word;        background-color: #fff;        background-clip: border-box;        border: 1px solid rgba(0, 0, 0, .125);        border-radius: 0px    }    .itemside {        position: relative;        display: -webkit-box;        display: -ms-flexbox;        display: flex;        width: 100%    }    .dlist-align {        display: -webkit-box;        display: -ms-flexbox;        display: flex    }    [class*="dlist-"] {        margin-bottom: 5px    }    .coupon {        border-radius: 1px    }    .price {        font-weight: 600;        color: #212529    }    .btn.btn-out {        outline: 1px solid #fff;        outline-offset: -5px    }    .btn-main {        border-radius: 2px;        text-transform: capitalize;        font-size: 15px;        padding: 10px 19px;        cursor: pointer;        color: #fff;        width: 100%    }    .btn-warning {        color: #fff;        background-color: #ff5722;        border-color: #FF5722;    }    .btn-light {        color: #ffffff;        background-color: #F44336;        border-color: #f8f9fa;        font-size: 12px    }    .btn-light:hover {        color: #ffffff;        background-color: #F44336;        border-color: #F44336    }    .btn-apply {        font-size: 11px    }</style><?php \appxq\sdii\widgets\CSSRegister::end(); ?>