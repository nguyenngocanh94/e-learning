<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\utilities\HtmlHelper;
use yii\helpers\Html;
use student\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
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
    <div class="pos-f-t">
        <div class="collapse" id="navbarToggleExternalContent">
            <div class="bg-dark p-4">
                <h4 class="text-white">Xin chào, <?= Html::a('Eric', ['update']) ?>
                </h4>

                <span class="text-muted" id="date"></span>
            </div>
        </div>
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="<?php HtmlHelper::getImage('chemistry.svg') ?>" width="30" height="30" class="d-inline-block align-top" alt="">
                <?php echo Yii::getAlias('@site')?>
            </a>
            <div class="user_info">
                <?php if (isset($this->progress)): ?>
                    <div class="progress progress-at-nav">
                        <div class="progress-bar" style="width: <?php echo $this->progress ?>%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $this->progress ?></div>
                    </div>
                <?php endif; ?>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-user-shield"></i>
                </button>
            </div>
        </nav>

        <div class="container">
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
</div>
<?php
    $this->registerJs(
        "n =  new Date();
            y = n.getFullYear();
            m = n.getMonth() + 1;
            d = n.getDate();
            document.getElementById(\"date\").innerHTML = 'Hôm nay là: ' + d + \"-\" + m + \"-\" + y;");
    ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
