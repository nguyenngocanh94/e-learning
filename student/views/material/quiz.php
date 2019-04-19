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
/** @var int $lesson_id */
$this->progress = ProgressTracking::lessonProgress($lesson_id);
?>
<div class="quiz-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Html::encode($material->descriptions) ?></p>
    <input type="hidden" id="course_id" value="<?php /** @var int $course_id */
    echo $course_id ?>">
    <!--    hidden modal-->

    <div class="modal" id="success_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thông Báo!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><?php echo $material->end?></p>
                </div>
                <div class="modal-footer">
                    <button data-id="<?php echo $material->id; ?>" id="next_stage" type="button" class="btn btn-primary">Tiếp</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <!--    end hidden modal-->
    <div class="row quize-list">
        <?php /** @var SingleQuestion[] $model */foreach ($model as $item): ?>
            <?php echo $item->out(); ?>
        <?php endforeach; ?>
    </div>
    <div class="col-md-2 offset-10">
        <button data-id="<?php echo $material->id; ?>"  type="button" class="btn btn-primary btn-lg" id="pop_modal" disabled>Tiếp tục</button>
    </div>
    <input type="hidden" id="question_threshold" value="<?php echo $material->question_threshold; ?>">
</div>
<?php
$this->registerJsFile("/js/quiz/index.js", ['depends' => [AppAsset::className()]]);
$this->registerJsFile("/js/common.js", ['depends' => [AppAsset::className()]]);
?>