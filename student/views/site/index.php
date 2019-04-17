<?php

/* @var $this yii\web\View */

use common\utilities\HtmlHelper;
use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <h3>Môn học ưa thích</h3>
    <div class="row subject-list">
        <?php /** @var TYPE_NAME $dataProvider */
        foreach ($dataProvider->getModels() as $model): ?>
            <div class="col-md-3 subject-item">
                <div class="card" style="width: 17rem;">
                    <img src="<?php HtmlHelper::getUploadsImage($model->image); ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $model->name ?></h5>
                        <?= Html::a('Tham gia', ['course/index', 'subjectId' => $model->id], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <h3>Khóa học vừa tham gia</h3>
    <div class="row subject-list">
        <?php
        /** @var array $course */
        foreach ($course as $model): ?>
            <div class="col-md-3 subject-item">
                <div class="card" style="width: 17rem;">
                    <img src="<?php HtmlHelper::getUploadsImage($model['image1']); ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $model['name'] ?></h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Môn học: <?php echo $model['subject_name']?></li>
                        <li class="list-group-item">Giáo viên: <?php echo $model['teacher_name']?></li>
                        <li class="list-group-item">Ngày đăng ký: <?php echo \Yii::$app->formatter->asDatetime($model['update_at'], "php:d-m-Y H:i:s");
                            ?></li>
                    </ul>
                    <div class="card-body">
                        <?= Html::a('Tiếp tục', ['course/index', 'subjectId' => $model['id']], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
