<?php

use common\utilities\HtmlHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\LessionS */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Lessions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lession-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row create-div">
        <div class="col-md-3">
            <?= /** @var int $subject_id */
            /** @var int $course_id */
            Html::a('Create Course', ['lesson/create', 'course_id' => $course_id], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <div class="row lesson-list">
        <?php /** @var common\models\Lession[] $models */
        foreach ($dataProvider->getModels() as $model): ?>
            <div class="col-md-3 subject-item">
                <div class="card" style="width: 17rem;">
                    <img src="<?php HtmlHelper::getUploadsImage($model->image); ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $model->name ?></h5>
                        <p class="card-text"><?php echo $model->overview ?></p>
                        <?= Html::a('Tạo tài liệu', ['material/index', 'lesson_id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Sửa', ['lesson/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('<i class="fas fa-chart-bar"></i>', ['lesson/analysis', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>
