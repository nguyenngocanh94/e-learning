<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\QuestionComponent */

$this->title = Yii::t('app', 'Create Question Component');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Question Components'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-component-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
