<?php

use common\utilities\Youtube;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\Material */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->name;
?>
<div class="material-index">

    <h1><?= Html::encode($model->name) ?></h1>
    <p><?= Html::encode($model->descriptions) ?></p>
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
                    <p><?php echo $model->end?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Tiếp</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <!--    end hidden modal-->
    <div class="row">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="<?php echo 'https://www.youtube.com/embed/'.Youtube::getId($model->content_url) ?>" allowfullscreen></iframe>
        </div>
    </div>
    <div class="row next-btn">
        <div class="col-md-2 offset-10">
            <button data-id="<?php echo $model->id; ?>" type="button" data-toggle="modal" data-target="#success_modal" class="btn btn-primary btn-lg" id="next_stage" disabled>Tiếp tục</button>
        </div>
    </div>
</div>
<p id="hidden_timeout" hidden><?php echo (1000)*($model->limit_time) ?></p>
<?php
$this->registerJsFile("/js/material/index.js", ['depends' => [yii\web\JqueryAsset::className()]]);
?>