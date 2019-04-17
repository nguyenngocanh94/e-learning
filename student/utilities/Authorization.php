<?php
namespace student\utilities;

use common\models\Enroll;

class Authorization
{
    /**
     * @param $course_id
     * @return bool
     */
    public static function isEnrolled($course_id){
        return Enroll::find()->where(['course_id' => $course_id, 'student_id'=>\Yii::$app->user->getId()])->count() > 0;
    }
}