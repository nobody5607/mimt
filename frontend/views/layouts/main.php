<?php

/* @var $this \yii\web\View */
/* @var $content string */

use appxq\sdii\utils\VarDumper;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
\cpn\chanpan\assets\bootbox\BootBoxAsset::register($this);
\cpn\chanpan\assets\notify\NotifyAsset::register($this);
\cpn\chanpan\assets\SweetAlertAsset::register($this);
$name = isset(Yii::$app->params['name_app'])?Yii::$app->params['name_app']:'';
Yii::$app->name = $name;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?php Yii::$app->meta->displaySeo() ?>
    <meta property="og:title" content="<?= $this->title ?>" />
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <?php $baseUrl = $this->theme->baseUrl;?>
    <link rel="stylesheet" href="<?= $baseUrl;?>/css/custom.css"/>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        //['label' => 'Home', 'url' => ['/site/index']],
//        ['label' => 'Category', 'url' => ['/products/stock-category']],
        ['label' => 'รายการสินค้า', 'url' => ['/product/index']],
        ['label' => 'จองอบรม', 'url' => ['/members/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/user/registration/register']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/user/security/login']];
    } else {
        $firstname = isset(Yii::$app->user->identity->profile->firstname) ? Yii::$app->user->identity->profile->firstname : '';
        $lastname = isset(Yii::$app->user->identity->profile->lastname) ? Yii::$app->user->identity->profile->lastname : "";
        $fullName = "{$firstname} {$lastname}";
        $storageUrl = isset(\Yii::$app->params['storageUrl']) ? \Yii::$app->params['storageUrl'] : '';
        $img = isset(Yii::$app->user->identity->profile->avatar_path) ? Yii::$app->user->identity->profile->avatar_path : '';
        $noimage = "{$storageUrl}/uploads/noimage.png";//Url::to("@web/uploads/noimage.png");
//        VarDumper::dump($storageUrl);
        if($img == ''){
            $img = $noimage;
        }else{
            $img = "{$storageUrl}/source/{$img}";
        }
        $menuItems[] = [

                'label' => "<img src='{$img}' class='user-image' style='width:25px;'> " . $fullName,
                'visible' => !Yii::$app->user->isGuest,
                'items' => [
                    ['label' => '<i class="fa fa-user"></i> ' . Yii::t('appmenu', 'User Profile'), 'url' => ['/user/settings/profile']],
                    ['label' => 'การซื้อของฉัน', 'url' => ['/order/index']],
                    '<li class="divider"></li>',
                    ['label' => '<i class="fa fa-sign-out"></i> ' . Yii::t('appmenu', 'Logout'), 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']],
                ],

        ];

//        $menuItems[] = '<li>'
//            . Html::beginForm(['/site/logout'], 'post')
//            . Html::submitButton(
//                'Logout (' . Yii::$app->user->identity->username . ')',
//                ['class' => 'btn btn-link logout']
//            )
//            . Html::endForm()
//            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
        'encodeLabels' => false
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
