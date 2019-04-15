<?php

use common\utilities\HtmlHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CourseS */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách khóa học';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">

    <h1><?= Html::encode($this->title) ?></h1>

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
                    <p>Ghi danh thành công</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Bắt đầu học</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <!--    end hidden modal-->

    <div class="row subject-list">
        <?php /** @var array $models */
        foreach ($models as $model): ?>
            <div class="col-md-3 subject-item">
                <div class="card" style="width: 17rem;">
                    <img src="<?php HtmlHelper::getUploadsImage($model['image1']); ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $model['name'] ?></h5>
                        <p class="card-text"><?php echo $model['description'] ?></p>
                        <?php if ($model['is_enroll']=='enrolled'): ?>
                            <button class="btn btn-primary" data-id="<?php echo $model['id'] ?>">Tiếp tục học</button>
                        <?php else: ?>
                            <button class="btn btn-primary register_course" data-id="<?php echo $model['id'] ?>">Ghi danh</button>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php
$this->registerJsFile("/js/course/index.js", ['depends' => [yii\web\JqueryAsset::className()]]);
?>