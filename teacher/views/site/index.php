<?php

/* @var $this yii\web\View */

use common\utilities\HtmlHelper;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <h3>Chọn môn học</h3>
    <div class="row subject-list">
        <?php /** @var ActiveDataProvider $dataProvider */
        foreach ($dataProvider->getModels() as $model): ?>
            <div class="col-md-3 subject-item">
                <div class="card" style="width: 17rem;">
                    <img src="<?php HtmlHelper::getUploadsImage($model->image); ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $model->name ?></h5>
                        <?= Html::a('Bắt đầu', ['course/create', 'subject_id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>
