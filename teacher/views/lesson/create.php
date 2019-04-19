<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Lession */

$this->title = Yii::t('app', 'Create Lession');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lessions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lession-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'course_id' => $course_id,
    ]) ?>

</div>
