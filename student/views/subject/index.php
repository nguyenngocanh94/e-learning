<?php

use common\utilities\HtmlHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel student\models\SubjectS */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách môn học';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row subject-list">
        <?php foreach ($dataProvider->getModels() as $model): ?>
        <div class="col-md-3 subject-item">
            <div class="card" style="width: 17rem;">
                <img src="<?php HtmlHelper::getUploadsImage($model->image); ?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $model->name ?></h5>
                    <?= Html::a('Tham gia', ['course/index', 'subjectId' => $model->id], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

</div>
