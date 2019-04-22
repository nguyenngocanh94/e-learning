<?php

namespace common\models;;

use common\utilities\Time;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "lession_status".
 *
 * @property int $id
 * @property int $status
 * @property int $lesson_id
 * @property int $student_id
 * @property string $time
 * @property int $update_by
 * @property int $create_by
 * @property string $update_at
 * @property string $create_at
 * @property int $del_flg
 */
class LessionStatus extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lession_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'student_id', 'update_by', 'create_by', 'del_flg','lesson_id'], 'integer'],
            [['update_at', 'create_at','time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status' => Yii::t('app', 'Status'),
            'student_id' => Yii::t('app', 'Student ID'),
            'lesson_id' => Yii::t('app', 'Lesson ID'),
            'time' => Yii::t('app', 'Time'),
            'update_by' => Yii::t('app', 'Update By'),
            'create_by' => Yii::t('app', 'Create By'),
            'update_at' => Yii::t('app', 'Update At'),
            'create_at' => Yii::t('app', 'Create At'),
            'del_flg' => Yii::t('app', 'Del Flg'),
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
