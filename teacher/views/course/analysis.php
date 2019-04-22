<?php

use common\models\Course;
use common\models\CourseS;
use common\utilities\HtmlHelper;
use teacher\assets\AppAsset;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CourseS */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Courses in ');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">
    <div class="row create-div">
        <div class="col-md-2">
            <a href="/lesson/index/<?php /** @var Course $course */
            echo $course->id ?>" class="btn btn-primary">Thống kê bài học</a>
        </div>
    </div>
    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên học sinh</th>
            <th scope="col">Thời gian đăng ký học</th>
            <th scope="col">Thời gian hoạt động gần nhất </th>
            <th scope="col">Mức độ hoàn thành</th>
        </tr>
        </thead>
        <tbody>
        <?php /** @var array $models */
        $leng = count($models); ?>
        <?php
        for ($i = 0; $i < $leng; $i++): ?>
            <tr class="student-item">
                <th scope="row"><?php echo $i+1; ?></th>
                <td><?php echo $models[$i]['name'] ?></td>
                <td><?php echo $models[$i]['create_at'] ?></td>
                <td><?php echo $models[$i]['update_at'] ?></td>
                <td>
                    <?php /** @var int $total */
                    $percent = round(($models[$i]['status']/$total)*100) ?>
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
