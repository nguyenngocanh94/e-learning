<?php

use common\models\ComponentQuestion;
use student\assets\AppAsset;
use student\utilities\ProgressTracking;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

/** @var \common\models\Material $material */
$this->title = $material->name;
/** @var int $lesson_id */
$this->progress = ProgressTracking::lessonProgress($lesson_id);
?>
    <div class="progress-bar progress-bar-striped progress-bar-animated" id="progress_bar"
         role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%; height: 0.5rem; display: none;"></div>
    <div class="drag-index">
        <h1><?= Html::encode($this->title) ?></h1>
        <input type="hidden" id="material_id" value="<?php echo $material->id ?>">
        <input type="hidden" id="lesson_id" value="<?php echo $lesson_id ?>">
        <div class="question-list">
            <?php /** @var ComponentQuestion[] $model */foreach ($model as $item): ?>
                <?php echo $item->out(); ?>
            <?php endforeach; ?>
        </div>
        <div class="col-md-2 offset-10">
            <button data-id="<?php echo $material->id; ?>" type="button" class="btn btn-primary btn-lg" id="next_stage" disabled>Tiếp tục</button>
        </div>
        <input type="hidden" id="question_threshold" value="<?php echo $material->question_threshold; ?>">
    </div>
<?php
$this->registerJsFile("/js/drag/index.js", ['depends' => [AppAsset::className()]]);
?>