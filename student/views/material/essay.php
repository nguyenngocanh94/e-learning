<?php

use student\assets\AppAsset;
use student\models\Question;
use student\models\SingleQuestion;
use student\utilities\ProgressTracking;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\web\View;

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

        <div class="essay-list">

            <?php /** @var Question[] $model */
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
                                <a class="nav-link" href="#" data-toggle="modal" data-target="#success_modal">Hỗ trợ</a>
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
                            <form action="/material/">
                                <textarea rows="4" class="form-control" aria-label="With textarea"></textarea>
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-2 offset-10" style="margin-bottom: 10px;">
                        <a href="#" class="btn btn-primary">Gửi câu trả lời</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="col-md-2 offset-10">
            <button data-id="<?php echo $material->id; ?>" type="button" class="btn btn-primary btn-lg" id="next_stage" disabled>Tiếp tục</button>
        </div>
    </div>
<?php
?>