<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Course */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="course-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= /** @var int $subject_id */
    $form->field($model, 'subject_id')->hiddenInput(['value'=> $subject_id])->label(false) ?>

    <?= $form->field($model, 'main_image')->fileInput(['class'=>''])->label("Main image") ?>

    <?= $form->field($model, 'sub_image1')->fileInput()->label("Sub image 1") ?>

    <?= $form->field($model, 'sub_image2')->fileInput()->label("Sub image 2") ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
