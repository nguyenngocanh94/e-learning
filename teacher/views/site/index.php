<?php

/* @var $this yii\web\View */

use common\utilities\HtmlHelper;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <h3>Chọn môn học để bắt đầu</h3>
    <div class="row subject-list">
        <?php /** @var ActiveDataProvider $dataProvider */
        foreach ($dataProvider->getModels() as $model): ?>
            <div class="col-md-3 subject-item">
                <div class="card" style="width: 17rem;">
                    <img src="<?php HtmlHelper::getUploadsImage($model->image); ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $model->name ?></h5>
                        <?= Html::a('Tạo khóa học', ['course/index/'.$model->id], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <h3>Trạng thái khóa học của bạn</h3>
    <div class="row course-list">
        <?php /** @var \common\models\Course[] $course */
        foreach ($course as $model): ?>
            <div class="col-md-3 subject-item">
                <div class="card" style="width: 17rem;">
                    <img src="<?php HtmlHelper::getUploadsImage($model->image1); ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $model->name ?></h5>
                        <?= Html::a('Xem', ['course/analysis/'.$model->id], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
