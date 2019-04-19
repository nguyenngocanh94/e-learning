<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \common\models\StudentLoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Đăng nhập';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Điền thông tin vào các ô nhập để tiếp tục:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Tên đăng nhập') ?>

                <?= $form->field($model, 'password')->passwordInput()->label('Mật khẩu') ?>

                <?= $form->field($model, 'rememberMe')->checkbox()->label('Ghi nhớ') ?>

                <div style="color:#999;margin:1em 0">
                    Quên password? <?= Html::a('Click vào đây', ['site/request-password-reset']) ?>.
                    <br>
                    Chưa xác thực email?  <?= Html::a('Click vào đây', ['site/resend-verification-email']) ?>
                    <br>
                    Chưa có tài khoản? <?= Html::a('Click vào đây', ['signup']) ?>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Đăng nhập', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
