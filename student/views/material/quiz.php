<?php

use student\assets\AppAsset;
use student\models\SingleQuestion;
use student\utilities\ProgressTracking;
use yii\helpers\Html;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LessionS */
/* @var $dataProvider yii\data\ActiveDataProvider */

/** @var \student\models\Material $material */
$this->title = $material->name;
/** @var int $lesson_id */
$this->progress = ProgressTracking::lessonProgress($lesson_id);
?>
<div class="quiz-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row question-list">
        <?php /** @var SingleQuestion[] $model */foreach ($model as $item): ?>
            <?php echo $item->out(); ?>
        <?php endforeach; ?>
    </div>
</div>
<?php
$this->registerJsFile("/js/quiz/index.js", ['depends' => [AppAsset::className()]]);
?>