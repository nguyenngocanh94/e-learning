<?php

use student\assets\AppAsset;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CourseS */
/* @var $dataProvider yii\data\ActiveDataProvider */

/** @var \common\models\Student $student */
/** @var \common\models\Course $course */
$this->title = Yii::t('app', 'Thống kê của ') . $student->name.' trong khoá học '.$course->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Bài học</th>
            <th scope="col">Thời gian hoạt động gần nhất</th>
            <th scope="col">Mức độ hoàn thành</th>
        </tr>
        </thead>
        <tbody>
        <?php /** @var array $models */
        $leng = count($models); ?>
        <?php
        for ($i = 0; $i < $leng; $i++): ?>
            <tr class="student-item">
                <th scope="row"><?php echo $i + 1; ?></th>
                <td><?php echo $models[$i]['name'] ?></td>
                <td><?php echo $models[$i]['update_at'] ?></td>
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
<?php $this->registerJsFile("/js/analysis/index.js", ['depends' => [AppAsset::className()]]); ?>
