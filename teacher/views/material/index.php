<?php

use common\models\Material;
use common\utilities\HtmlHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MaterialS */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Materials');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row create-div">
        <div class="col-md-2">
            <?= /** @var \common\models\Lession $lesson */
            Html::a('Create Material', ['material/create', 'lesson_id' => $lesson->id], ['class' => 'btn btn-primary']) ?>
        </div>
        <div class="col-md-2">
            <?= /** @var int $lesson_id */
            Html::a('Lesson manager', ['lesson/index/'.$lesson->course_id ], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <div class="row subject-list">
        <?php /** @var common\models\Material $model */
        foreach ($dataProvider->getModels() as $model): ?>
            <div class="col-md-3" style="margin-bottom: 5%">
             <?php if ($model->type == Material::VIDEO): ?>
                <div class="card bog-danger material-item" style="width: 17rem;">
             <?php elseif ($model->type == Material::POWERPOINT): ?>
                 <div class="card bog-light material-item" style="width: 17rem;">
             <?php elseif ($model->type == Material::QUIZ): ?>
                  <div class="card bog-success material-item" style="width: 17rem;">
             <?php elseif ($model->type == Material::QUIZ_ESSAY): ?>
                  <div class="card bog-secondary material-item" style="width: 17rem;">
             <?php elseif($model->type == Material::DRAG): ?>
                  <div class="card bog-warning material-item" style="width: 17rem;">
             <?php else: ?>
                  <div class="card bog-primary material-item" style="width: 17rem;">
             <?php endif ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $model->name ?></h5>
                        <p class="card-text text-truncate"><?php echo $model->descriptions ?></p>
                        <?= Html::a('Xem', ['material/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?php if (($model->type != Material::VIDEO)||($model->type != Material::POWERPOINT)): ?>
                            <?= Html::a('Sửa', ['material/edit', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?php endif ?>
                        <?= Html::a('Xóa', ['material/delete', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>
