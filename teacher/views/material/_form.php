<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Material */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="material-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')
        ->dropDownList(
            ['1'=>'Video','2'=>'Powerpoint','3'=>'Trắc nghiệm', '5'=> 'Trắc nghiệm có tự luận', '4'=>'Kéo thả', '6'=>'Tự luận']
        ); ?>

    <?= $form->field($model, 'rank')->textInput(['type' => 'number'])->label('Thứ tự hoạt động') ?>

    <?= $form->field($model, 'limit_time')->textInput(['type' => 'number'])->label('Số phút học sinh phải học') ?>

    <?= $form->field($model, 'content_url')->textInput(['maxlength' => true])
        ->label('Nếu chọn Video, Powerpoint thì dán link vào,
        ví dụ video: https://www.youtube.com/watch?v=egK0y4b-YhE') ?>

    <?= $form->field($model, 'descriptions')->textarea(['rows' => 6])->label('Mô tả') ?>

    <?= $form->field($model, 'question_threshold')->textInput(['type' => 'number'])->label('Số câu hỏi học sinh phải trả lời đúng') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
