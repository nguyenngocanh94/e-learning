<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\QuestionComponent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-component-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rank')->radio(['label' => 'Yes', 'value' => 999, 'uncheck' => null])->label('Lie answer?') ?>

    <?= $form->field($model, 'missing')->radio(['label' => 'Yes', 'value' => 1, 'uncheck' => null])->label('Missing component?') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        <a href="#" class="btn-primary btn" id="revert">Revert</a>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<?php $this->registerJs('
    $("#revert").click(function(){
        $("#questioncomponent-rank").prop("checked", false);
        $("#questioncomponent-missing").prop("checked", false);
    });
') ?>
