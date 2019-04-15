<?php


namespace student\utilities;


use app\models\Enroll;
use app\models\Lession;
use student\models\LessionStatus;
use student\models\Material;
use Yii;

class ProgressTracking
{
    public static function courseProgress($course_id){
        $lessonTotal = Lession::find()->where(['course_id'=>$course_id, 'del_flg'=>0])->count();

        return round((self::trackingLessonProcess($course_id) / $lessonTotal) * 100);
    }

    public static function lessonProgress($lesson_id){
        $materialTotal = Material::find()->where(['lesson_id'=>$lesson_id, 'del_flg'=>0])->count();

        return round((self::trackingMaterialProcess($lesson_id) / $materialTotal) * 100);
    }


    /**
     * @param $course_id
     * @return mixed
     */
    public static function trackingLessonProcess($course_id){
        return Enroll::find()->where(['student_id'=>Yii::$app->user->getId(), 'course_id'=> $course_id])->one()->status;
    }

    /**
     * @param $course_id
     * @return mixed
     */
    public static function trackingMaterialProcess($lesson_id){
        return LessionStatus::find()->where(['student_id'=>Yii::$app->user->getId(), 'lesson_id'=> $lesson_id])->one()->status;
    }
}