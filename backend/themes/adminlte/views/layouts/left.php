<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <div class="slimScrollDiv" >
        <section class="sidebar" >
            <!-- Sidebar user panel -->
            <?php if(!Yii::$app->user->isGuest):?>
            <?php
                $firstname = isset(Yii::$app->user->identity->profile->firstname) ? Yii::$app->user->identity->profile->firstname : '';
                $lastname = isset(Yii::$app->user->identity->profile->lastname) ? Yii::$app->user->identity->profile->lastname : "";
                $fullName = "{$firstname} {$lastname}";
                $storageUrl = isset(\Yii::$app->params['storageUrl']) ? \Yii::$app->params['storageUrl'] : '';
                $img = isset(Yii::$app->user->identity->profile->avatar_path) ? Yii::$app->user->identity->profile->avatar_path : '';
                $noimage = yii\helpers\Url::to("@web/img/noimage.png");
                if($img == ''){
                    $img = $noimage;
                }else{
                    $img = "{$storageUrl}/source/{$img}";
                }
            ?>
                <div class="user-panel">
                    <div class="pull-left image">
                      <img src="<?= "{$img}";?>" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                      <p><?= $fullName; ?></p>
                      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
            <?php endif;

            use yii\helpers\Url; ?>
            
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            
            <?= dmstr\widgets\Menu::widget(\backend\components\AppComponent::navbarLeft()) ?>
            
        </section>
        <div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 90.1955px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
    <!-- /.sidebar -->
</aside>