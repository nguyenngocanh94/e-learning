<?php

use teacher\assets\AppAsset;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

/** @var \common\models\Student $student */
/** @var \common\models\Lession $lesson */
$this->title = Yii::t('app', 'Thống kê của bài học ').$lesson->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">
    <div class="row create-div">
        <div class="col-md-2">
            <a href="/course/analysis/<?php echo $lesson->course_id ?>" class="btn btn-primary">Thống kê khóa học</a>
        </div>
    </div>
    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Học sinh</th>
            <th scope="col">Bài học</th>
            <th scope="col">Thời gian hoạt động gần nhất</th>
            <th scope="col">Thời gian hoàn thành</th>
            <th scope="col">Mức độ hoàn thành</th>
        </tr>
        </thead>
        <tbody>
        <?php /** @var array $models */
        $leng = count($models); ?>
        <?php
        for ($i = 0; $i < $leng; $i++): ?>
            <tr>
                <th scope="row"><?php echo $i + 1; ?></th>
                <td>
                    <a class="student-item" href="<?php echo '/material/analysis?student_id='.$models[$i]['student_id'].'&lesson_id='.$lesson->id ?>">
                        <?php echo $models[$i]['name'] ?>
                    </a>
                </td>
                <td><?php echo $models[$i]['lesson'] ?></td>
                <td><?php echo $models[$i]['update_at'] ?></td>
                <td><?php echo $models[$i]['time'] ?></td>
                <td>
                    <?php /** @var int $total */
                    $percent = round(($models[$i]['status'] / $models[$i]['total'])*100) ?>
                    <div class="progress progress-at-nav" style="margin-top: 8px; width: 100%">
                        <div class="progress-bar" style="width: <?php echo $percent ?>%;"
                             role="progressbar" aria-valuenow="25" aria-valuemin="0"
                             aria-valuemax="100"><?php echo $percent ?></div>
                    </div>
                </td>
            </tr>
        <?php endfor; ?>
        </tbody>
    </table>
</div>
<?php $this->registerJsFile("/js/analysis/analysis-all.js", ['depends' => [AppAsset::className()]]); ?>
