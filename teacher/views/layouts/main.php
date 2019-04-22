<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\utilities\HtmlHelper;
use teacher\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<?php $this->title = "Hóa học trực tuyến - phía giáo viên" ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="collapse" id="navbarToggleExternalContent">
        <div class="p-4" style="background-color: gray">
            <h4 class="text-white">Xin
                chào, <?= Html::a(Yii::$app->user->getIdentity()->name, ['update'], ['style' => 'color: #FBD6E2']) ?></h4>
            <p id="date" style="color: #FBD6E2"></p>
            <?= Html::a('<i class="fas fa-sign-out-alt"></i> Log out', ['site/logout'], ['class' => 'logout']) ?>
        </div>
    </div>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="<?php echo Url::base(true); ?>">
            <img src="<?php HtmlHelper::getImage('chemistry.svg') ?>" width="30" height="30"
                 class="d-inline-block align-top" alt="">
            <?php echo Yii::getAlias('@site') ?>
        </a>
        <div class="user_info">
            <div class="row" style="width: 100%">
                <div class="col-md-4">
                    <button class="navbar-toggler" type="button" style="float: right" data-toggle="collapse"
                            data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-user-shield"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<?php $this->endBody();
$this->registerJs(
    "n =  new Date();
            y = n.getFullYear();
            m = n.getMonth() + 1;
            d = n.getDate();
            document.getElementById(\"date\").innerHTML = 'Hôm nay là: ' + d + \"-\" + m + \"-\" + y;
            
            ");
?>
?>

</body>
</html>
<?php $this->endPage() ?>
