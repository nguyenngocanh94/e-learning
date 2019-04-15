<?php

use common\utilities\Youtube;
use yii\helpers\Html;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $model \student\models\Material */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->name;
?>
<div class="material-index">

    <h1><?= Html::encode($model->name) ?></h1>
    <p><?= Html::encode($model->descriptions) ?></p>
    <div class="row">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="<?php echo 'https://www.youtube.com/embed/'.Youtube::getId($model->content_url) ?>" allowfullscreen></iframe>
        </div>
    </div>
    <div class="row next-btn">
        <div class="col-md-2 offset-10">
            <button data-id="<?php echo $model->id; ?>" type="button" class="btn btn-primary btn-lg" id="next_stage" disabled>Tiếp tục</button>
        </div>
    </div>
</div>
<p id="hidden_timeout" hidden><?php echo (60000)*($model->limit_time) ?></p>
<?php
$this->registerJsFile("/js/material/index.js", ['depends' => [yii\web\JqueryAsset::className()]]);
?>