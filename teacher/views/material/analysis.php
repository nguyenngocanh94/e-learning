<?php

use teacher\assets\AppAsset;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CourseS */
/* @var $dataProvider yii\data\ActiveDataProvider */

/** @var \common\models\Student $student */
/** @var \common\models\Lession $lesson */
$this->title = Yii::t('app', 'Thống kê của học sinh ').$student->name.' bài học '.$lesson->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">
    <div class="row create-div">
        <div class="col-md-2">
            <a href="/lesson/analysis-all?lesson_id=<?php echo $lesson->id ?>" class="btn btn-primary">Thống kê bài học</a>
        </div>
    </div>
    <h1><?= Html::encode($this->title) ?></h1>
    <h3>Kết quả tự luận</h3>
    <table class="table" style="table-layout: fixed; width: 100%">
        <thead>
        <tr>
            <th scope="col" style="width: 5%">STT</th>
            <th scope="col" style="width: 10%">Hoạt động</th>
            <th scope="col" style="width: 25%">Câu hỏi </th>
            <th scope="col">Kết quả</th>
            <th scope="col" style="width: 10%">Thời gian trả lời</th>
        </tr>
        </thead>
        <tbody>
        <?php /** @var array $essays */
        $leng = count($essays); ?>
        <?php
        for ($i = 0; $i < $leng; $i++): ?>
            <tr class="student-item">
                <th scope="row"><?php echo $i+1; ?></th>
                <td><?php echo $essays[$i]['material'] ?></td>
                <td>
                    <?php echo $essays[$i]['name'] ?>
                </td>
                <td class="wrap-text">
                    <?php echo $essays[$i]['content'] ?>
                </td>
                <td><?php echo $essays[$i]['create_at'] ?></td>
            </tr>
        <?php endfor; ?>
        </tbody>
    </table>
    <h3>Thống kê trắc nghiệm</h3>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Hoạt động</th>
            <th scope="col" style="width: 50%">Câu hỏi </th>
            <th scope="col">Kết quả</th>
            <th scope="col">Thời gian trả lời</th>
        </tr>
        </thead>
        <tbody>
        <?php /** @var array $models */
        $leng = count($models); ?>
        <?php
        for ($i = 0; $i < $leng; $i++): ?>
            <tr class="student-item" <?php if($models[$i]['status'] == 0): ?>  <?php echo 'style="color:red;"' ?>  <?php endif ?>>
                <th scope="row"><?php echo $i+1; ?></th>
                <td><?php echo $models[$i]['material'] ?></td>
                <td>
                    <?php if($models[$i]['status'] == 100): ?>
                        Câu hỏi kéo thả
                    <?php else: ?>
                    <?php echo $models[$i]['name'] ?>
                    <?php endif ?>
                </td>
                <td>
                    <?php if($models[$i]['status'] == 1): ?>
                        Đúng
                    <?php else: ?>
                        Sai
                    <?php endif ?>
                </td>
                <td><?php echo $models[$i]['create_at'] ?></td>
            </tr>
        <?php endfor; ?>
        </tbody>
    </table>
</div>
