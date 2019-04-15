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
    <style>
        #div1 {
            float: left;
            width: 140px;
            height: 40px;
            padding: 10px;
            border: 1px solid black;
        }
    </style>
    <div class="drag-index">

        <h1><?= Html::encode($this->title) ?></h1>

        <div class="question-list">
            <?php /** @var \student\models\ComponentQuestion[] $model */foreach ($model as $item): ?>
                <?php echo $item->out(); ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php
$this->registerJsFile("/js/drag/index.js", ['depends' => [AppAsset::className()]]);
?>