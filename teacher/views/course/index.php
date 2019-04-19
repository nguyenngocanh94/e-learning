<?php

use common\models\Course;
use common\utilities\HtmlHelper;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CourseS */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Courses in ');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row create-div">
        <div class="col-md-2">
            <?= /** @var int $subject_id */
            Html::a('Create Course', ['course/create', 'subject_id' => $subject_id], ['class' => 'btn btn-primary']) ?>
        </div>
        <div class="col-md-2">
            <?= /** @var int $subject_id */
            Html::a('Subject list', ['/'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <div class="row">
        <?php /** @var ActiveDataProvider $dataProvider */
        /** @var Course $model */
        foreach ($dataProvider->getModels() as $model): ?>
            <div class="col-md-3 subject-item">
                <div class="card" style="width: 17rem;">
                    <img src="<?php HtmlHelper::getUploadsImage($model->image1); ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $model->name ?></h5>
                        <p class="card-text"><?php echo $model->description ?></p>
                        <?= Html::a('<i class="fas fa-plus"></i>', ['lesson/index/'.$model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('<i class="fas fa-chart-bar"></i>', ['lesson/analysis', 'subject_id' => $model->id], ['class' => 'btn btn-secondary']) ?>
                        <?= Html::a('<i class="far fa-edit"></i>', ['lesson/update/'.$model->id], ['class' => 'btn btn-info']) ?>
                        <?= Html::a('<i class="far fa-trash-alt"></i>', ['lesson/delete/'.$model->id], ['class' => 'btn btn-danger']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>
