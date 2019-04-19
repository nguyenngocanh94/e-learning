<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Lession */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lession-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'rank')->textInput() ?>
    <?= /** @var int $course_id */
    $form->field($model, 'course_id')->hiddenInput(['value'=>$course_id])->label(false) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imageF')->fileInput() ?>

    <?= $form->field($model, 'length')->textInput() ?>

    <?= $form->field($model, 'overview')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
