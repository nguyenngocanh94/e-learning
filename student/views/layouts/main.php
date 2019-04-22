<?php

/* @var $this \yii\web\View */

/* @var $content string */

use common\utilities\HtmlHelper;
use common\utilities\Subject;
use yii\helpers\Html;
use student\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

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
    <link rel="shortcut icon" href="<?php HtmlHelper::getFavicon() ?>" type="image/x-icon" />
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="pos-f-t">
        <?php if (!Yii::$app->user->isGuest): ?>
            <div class="collapse" id="navbarToggleExternalContent">
                <div class="bg-pink p-4">
                    <h4 class="text-white">Xin
                        chào, <?= Html::a(Yii::$app->user->getIdentity()->name, ['update'], ['style' => 'color: #FBD6E2']) ?></h4>
                    <p id="date" style="color: #FBD6E2"></p>
                    <?= Html::a('<i class="fas fa-sign-out-alt"></i> Log out', ['site/logout'], ['class' => 'logout']) ?>
                    <input type="hidden" id="threshold_time_global">
                    <input type="hidden" id="threshold_question_global">
                    <input type="hidden" id="done_question_global">
                </div>
            </div>
        <?php endif ?>
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="<?php echo Url::base(true); ?>">
                <img src="<?php HtmlHelper::getImage('chemistry.svg') ?>" width="30" height="30"
                     class="d-inline-block align-top" alt="">
                <?php echo Yii::getAlias('@site') ?>
            </a>
            <div class="user_info">
                <div class="row" style="width: 100%">
                    <div class="col-md-8">
                        <?php if (isset($this->progress)): ?>
                            <div class="progress progress-at-nav" style="float: right; margin-top: 8px">
                                <div class="progress-bar" style="width: <?php echo $this->progress ?>%;"
                                     role="progressbar" aria-valuenow="25" aria-valuemin="0"
                                     aria-valuemax="100"><?php echo $this->progress ?></div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-4">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarToggleExternalSearch" aria-controls="navbarToggleExternalSearch"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-search"></i>
                        </button>
                        <button class="navbar-toggler" type="button" style="float: right" data-toggle="collapse"
                                data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-user-shield"></i>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
        <div class="collapse" id="navbarToggleExternalSearch">
            <div class="bg-transparent p-4">
                <div class="row">
                    <div class="col-md-6 offset-6">
                        <div class="input-group" id="adv-search">
                            <input type="text" class="form-control" id="search-course" placeholder="Nhập tên khóa học" />
                            <div class="input-group-btn">
                                <div class="btn-group" role="group">
                                    <div class="dropdown dropdown-lg">
                                        <button type="button" class="btn btn-default dropdown-toggle condition" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-search-plus"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                                            <form id="adv-info" class="form-horizontal" role="form">
                                                <div class="form-group">
                                                    <label for="filter">Lọc theo</label>
                                                    <select name="type" class="form-control">
                                                        <option value="0" selected>Tất cả</option>
                                                        <option value="1">Top đánh giá</option>
                                                        <option value="2">Nhiều người học nhất</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="filter">Môn học</label>
                                                    <select name="subject_id" class="form-control">
                                                        <?php foreach(Subject::getList() as $subject): ?>
                                                            <option value="0" selected>Tất cả</option>
                                                            <option value="<?php echo $subject->id ?>"><?php echo $subject->name ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div  class="form-group">
                                                    <label for="contain">Giáo viên</label>
                                                    <input name="teacher_name" class="form-control" type="text" />
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
            document.getElementById(\"date\").innerHTML = 'Hôm nay là: ' + d + \"-\" + m + \"-\" + y;
            
            ");
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
