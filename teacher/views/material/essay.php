<?php

use common\utilities\HtmlHelper;
use student\assets\AppAsset;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CourseS */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách Câu hỏi';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="course-index">

        <h1><?= Html::encode($this->title) ?></h1>
        <div class="row create-div">
            <div class="col-md-2">
                <?= /** @var \common\models\Material $material */
                Html::a('Create Question', ['question/create', 'material_id' => $material->id], ['class' => 'btn btn-primary']) ?>
            </div>
            <div class="col-md-2">
                <?= Html::a('Quản lý tài liệu', ['material/index/'.$material->lesson_id], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <div class="row subject-list">
            <?php /** @var \common\models\Question[] $models */
            foreach ($models as $model): ?>
                <div class="col-md-3 subject-item">
                    <div class="card" style="width: 17rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $model->name ?></h5>
                            <p class="card-text"><?php echo $model->content ?></p>
                            <?= Html::a('Sửa', ['question/update/'.$model->id], ['class' => 'btn btn-secondary']) ?>
                            <?= Html::a('Xóa', ['question/delete/'.$model->id], ['class' => 'btn btn-danger']) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php
$this->registerJsFile("/js/course/index.js", ['depends' => [AppAsset::className()]]);
?>