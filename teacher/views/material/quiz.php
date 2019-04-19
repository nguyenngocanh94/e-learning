<?php

use common\models\SingleQuestion;
use student\assets\AppAsset;
use student\utilities\ProgressTracking;
use yii\helpers\Html;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $searchModel common\models\LessionS */
/* @var $dataProvider yii\data\ActiveDataProvider */

/** @var \common\models\Material $material */
$this->title = $material->name;
?>

<div class="quiz-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row create-div">
        <div class="col-md-2">
            <?= /** @var int $lesson_id */
            Html::a('Create Question', ['question/create', 'material_id' => $material->id], ['class' => 'btn btn-primary']) ?>

        </div>
        <div class="col-md-2">
            <?= /** @var int $lesson_id */
            Html::a('Material manager', ['material/index/'.$material->lesson_id ], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <div class="row quize-list">
        <?php /** @var SingleQuestion[] $model */foreach ($model as $item): ?>
            <?php echo $item->out(1); ?>
        <?php endforeach; ?>
    </div>
</div>
<?php
?>