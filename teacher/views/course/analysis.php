<?php

use common\models\Course;
use common\models\CourseS;use common\utilities\HtmlHelper;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CourseS */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Courses in ');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <?php /** @var array $models */
        /** @var Course $model */
        foreach ($models as $model): ?>
            <ul class="list-group">
                <li class="list-group-item disabled">
                    <div class="user_info">
                        <div class="row">
                            <div class="col-md-6">
                                <h5><?php echo $model['name'] ?></h5>
                                <h5><?php echo $model['create_at'] ?></h5>
                                <h5><?php echo $model['update_at'] ?></h5>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        <?php endforeach; ?>
    </div>

</div>
