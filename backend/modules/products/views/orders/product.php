<div class="card">    <div class="card-header">รายการสินค้า</div>    <div class="card-body">        <div class="table-responsive">            <table class="table table-borderless table-shopping-cart">                <thead class="text-muted">                <tr class="small text-uppercase">                    <th scope="col" width="120">รายการ</th>                    <th scope="col" width="80">ราคาต่อหน่วย</th>                    <th scope="col" width="80">จำนวน</th>                    <th scope="col" width="80">ราคา</th>                </tr>                </thead>                <tbody>                <?php if ($detail): ?>                    <?php foreach ($detail as $k => $v): ?>                        <?php                        $product = \backend\modules\products\models\Products::findOne($v->pro_id);                        ?>                        <tr>                            <td>                                <figure class="itemside align-items-center">                                    <div class="aside">                                        <?php                                        $path = \appxq\sdii\utils\SDUtility::getStoragePath();                                        $image = '';                                        if (!$product['image']) {                                            $image = "{$path}/uploads/noimage.png";                                        } else {                                            $image = "{$path}/uploads/{$product['image']}";                                        }                                        ?>                                        <img src="<?= $image; ?>" class="img-sm">                                    </div>                                    <figcaption class="info">                                        <a href="#" class="title text-dark"                                           data-abc="true"><?= $product['name']; ?></a>                                    </figcaption>                                </figure>                            </td>                            <td>฿<?= number_format($v['price']) ?></td>                            <td><?= $v['qty'] ?></td>                            <td>                                <div class="price-wrap">                                    <span>฿<?= number_format($v['totalPrice']) ?></span>                                </div>                            </td>                        </tr>                    <?php endforeach; ?>                <?php endif; ?>                </tbody>            </table>        </div>    </div>    <div class="card-footer">        <div class="text-right">            <label>ยอดคำสั่งซื้อทั้งหมด: <span style="font-size: 20pt;font-weight: 100;color: #FF5722;padding-left:5px;">฿<?= isset($order['total'])?number_format($order['total']):''?></span></label>        </div>    </div></div>