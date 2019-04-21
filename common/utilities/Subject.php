<?php


namespace common\utilities;


class Subject
{
    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function  getList(){
        return \common\models\Subject::find()->cache(9000)->orderBy(['rank'=>SORT_ASC])->all();
    }
}