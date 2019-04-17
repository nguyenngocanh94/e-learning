<?php

namespace common\models;

use common\utilities\Time;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "enroll".
 *
 * @property int $id
 * @property int $course_id
 * @property int $student_id
 * @property int $status
 * @property string $create_at
 * @property string $update_at
 * @property int $create_by
 * @property int $update_by
 * @property int $del_flg
 */
class Enroll extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'enroll';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_id', 'student_id', 'create_by', 'update_by', 'status'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'course_id' => 'Course ID',
            'student_id' => 'Student ID',
            'status' => 'Status',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'create_by' => 'Create By',
            'update_by' => 'Update By',
            'del_flg' => 'Del Flg',
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($insert){
            $this->update_at = Time::Now();
            $this->create_at = Time::Now();
            $this->update_by = Yii::$app->user->getId();
            $this->create_by = Yii::$app->user->getId();
        }else{
            $this->update_at = Time::Now();
            $this->update_by = Yii::$app->user->getId();
        }
        return parent::beforeSave($insert);
    }
}
