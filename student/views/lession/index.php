<?php

use common\utilities\HtmlHelper;
use student\utilities\ProgressTracking;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel app\models\LessionS */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách bài học';
$this->params['breadcrumbs'][] = $this->title;
/** @var TYPE_NAME $course_id */
$this->progress = ProgressTracking::courseProgress($course_id);
?>
<div class="lession-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row subject-list">
        <?php /** @var \app\models\Lession[] $models */
        for ($i = 0; $i < count($models); $i++): ?>
            <div class="col-md-3 subject-item">
                <div class="card" style="width: 17rem;">
                    <img src="<?php HtmlHelper::getUploadsImage($models[$i]->image); ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $models[$i]->name ?></h5>
                        <p class="card-text"><?php echo $models[$i]->overview ?></p>
                        <?php /** @var int $course_status */
                        if ($i <  $course_status): ?>
                            <button class="btn btn-primary register_course" data-id="<?php echo $models[$i]->id ?>">Đã hoàn thành</button>
                        <?php else: ?>
                            <button class="btn btn-primary" data-id="<?php echo $models[$i]->id ?>">Học</button>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>
</div>
