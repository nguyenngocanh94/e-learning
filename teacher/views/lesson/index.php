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
        <div class="col-md-2">
            <?= /** @var int $subject_id */
            /** @var int $course_id */
            Html::a('Create Course', ['lesson/create', 'course_id' => $course_id], ['class' => 'btn btn-primary']) ?>
        </div>
        <div class="col-md-2">
            <?= Html::a('Trang chủ', ['/'], ['class' => 'btn btn-primary']) ?>
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
                        <?= Html::a('<i class="fas fa-plus"></i>', ['material/index/'.$model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('<i class="fas fa-edit"></i>', ['lesson/update', 'id' => $model->id], ['class' => 'btn btn-secondary']) ?>
                        <?= Html::a('<i class="far fa-chart-bar"></i>', ['lesson/analysis', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
                        <?= Html::a('<i class="far fa-trash-alt"></i>', ['lesson/delete/'.$model->id], ['class' => 'btn btn-danger']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>
