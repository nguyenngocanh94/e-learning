<?php

use student\assets\AppAsset;
use student\models\SingleQuestion;
use student\utilities\ProgressTracking;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

/** @var \student\models\Material $material */
$this->title = $material->name;
/** @var int $lesson_id */
$this->progress = ProgressTracking::lessonProgress($lesson_id);
?>
    <div class="drag-index">

        <h1><?= Html::encode($this->title) ?></h1>
        <input type="hidden" id="material_id" value="<?php echo $material->id ?>">
        <input type="hidden" id="lesson_id" value="<?php echo $lesson_id ?>">
        <div class="question-list">
            <?php /** @var \student\models\ComponentQuestion[] $model */foreach ($model as $item): ?>
                <?php echo $item->out(); ?>
            <?php endforeach; ?>
        </div>
        <div class="col-md-2 offset-10">
            <button data-id="<?php echo $material->id; ?>" type="button" class="btn btn-primary btn-lg" id="next_stage_quiz" disabled>Tiếp tục</button>
        </div>
    </div>
<?php
$this->registerJsFile("/js/drag/index.js", ['depends' => [AppAsset::className()]]);
?>