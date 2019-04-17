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
                            <?= Html::a('Đã hoàn thành', ['material/index', 'lesson_id' => $models[$i]->id], ['class' => 'btn btn-primary']) ?>
                        <?php else: ?>
                            <?= Html::a('Học', ['material/index', 'lesson_id' => $models[$i]->id], ['class' => 'btn btn-primary']) ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>
</div>
