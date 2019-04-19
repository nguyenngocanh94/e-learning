<?php

use teacher\assets\AppAsset;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CourseS */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Create material content ');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row create-div">
        <div class="col-md-3">
            <?= /** @var \common\models\Material $material */
            Html::a('Create Question', ['question/create', 'material_id' => $material->id], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <div class="row drag-list">
        <?php /** @var \common\models\ComponentQuestion[] $models */foreach ($models as $item): ?>
            <?php echo $item->out(1); ?>
        <?php endforeach; ?>
    </div>

</div>
<?php $this->registerJsFile("/js/drag/index.js", ['depends' => [AppAsset::className()]]);
?>