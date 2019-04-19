<?php

use common\models\Question;
use student\assets\AppAsset;
use student\utilities\ProgressTracking;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\LessionS */
/* @var $dataProvider yii\data\ActiveDataProvider */

/** @var \common\models\Material $material */
$this->title = $material->name;
/** @var int $lesson_id */
$this->progress = ProgressTracking::lessonProgress($lesson_id);
?>
    <div class="quiz-index">
        <input type="hidden" id="course_id" value="<?php /** @var int $course_id */
        echo $course_id ?>">
        <h1><?= Html::encode($this->title) ?></h1>
        <p><?= Html::encode($material->descriptions) ?></p>

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
        <div class="essay-list">

            <?php /** @var Question $model */
            foreach ($model as $item):?>
                <!--    hidden modal-->
                <div class="modal" id="success_modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Hỗ trợ !</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><?php echo $item->hint ?></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--    end hidden modal-->
                <div class="card mb-3">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Câu Hỏi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" >Hỗ trợ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">Câu trả lời cũ</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $item->name ?></h5>
                        <p class="card-text"><?php echo $item->content ?></p>
                    </div>
                    <div class="card-body">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-pen-fancy"></i></span>
                            </div>
                            <form class="question-form">
                                <input type="hidden" name="type" value="essay">
                                <input type="hidden" name="question_id" value="<?php echo $item->id ?>">
                                <textarea rows="4" cols="135" name="essay_content" class="form-control" aria-label="With textarea"></textarea>
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-2 offset-10" style="margin-bottom: 10px;">
                        <button class="btn btn-primary send-essay">Gửi câu trả lời</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="col-md-2 offset-10">
            <button data-id="<?php echo $material->id; ?>" type="button"  class="btn btn-primary btn-lg" id="pop_modal" disabled>Tiếp tục</button>
        </div>
    </div>
<?php
?>

<?php
$this->registerJsFile("/js/essay/index.js", ['depends' => [AppAsset::className()]]);
$this->registerJsFile("/js/common.js", ['depends' => [AppAsset::className()]]);

?>
