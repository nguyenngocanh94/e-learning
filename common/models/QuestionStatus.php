<?php

namespace common\models;

use common\utilities\Time;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "question_status".
 *
 * @property int $id
 * @property int $student_id
 * @property int $question_id
 * @property int $type
 * @property int $status
 * @property int $create_by
 * @property string $create_at
 * @property int $del_flg
 */
class QuestionStatus extends ActiveRecord
{

    const RIGHT = 1;
    const WRONG = 0;

    const QUIZ = 1;
    const DRAG = 2;
    const TEXT = 3;

    const DONE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'question_id', 'type', 'status', 'create_by', 'del_flg'], 'integer'],
            [['create_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'student_id' => Yii::t('app', 'Student ID'),
            'question_id' => Yii::t('app', 'Question ID'),
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
            'create_by' => Yii::t('app', 'Create By'),
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
            $this->create_at = Time::Now();
        }
        return parent::beforeSave($insert);
    }
}
