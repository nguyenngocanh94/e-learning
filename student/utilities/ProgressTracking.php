<?php


namespace student\utilities;


use common\models\Enroll;
use common\models\Lession;
use common\models\LessionStatus;
use common\models\Material;
use Yii;

class ProgressTracking
{
    public static function courseProgress($course_id){
        $lessonTotal = Lession::find()->where(['course_id'=>$course_id, 'del_flg'=>0])->count();

        return $lessonTotal > 0 ?round((self::trackingLessonProcess($course_id) / $lessonTotal) * 100) : 100;
    }

    public static function lessonProgress($lesson_id){
        $materialTotal = Material::find()->where(['lesson_id'=>$lesson_id, 'del_flg'=>0])->count();

        return $materialTotal > 0 ? round((self::trackingMaterialProcess($lesson_id) / $materialTotal) * 100): 100;
    }


    /**
     * @param $course_id
     * @return mixed
     */
    public static function trackingLessonProcess($course_id){
        $enroll = Enroll::find()
            ->where(['student_id'=>Yii::$app->user->getId(), 'course_id'=> $course_id])
            ->orderBy(['update_at'=>SORT_DESC])
            ->one();
        if ($enroll){
            $enroll->status;
        }

        return 0;
    }

    /**
     * @param $course_id
     * @return mixed
     */
    public static function trackingMaterialProcess($lesson_id){
        $ls = LessionStatus::find()
            ->where(['student_id'=>Yii::$app->user->getId(), 'lesson_id'=> $lesson_id])
            ->orderBy(['update_at'=>SORT_DESC])
            ->one();
        if ($ls){
            $ls->status;
        }

        return 0;
    }

    public static function getCurrentMaterial($lesson_id){
        $status = self::trackingMaterialProcess($lesson_id);

    }
}