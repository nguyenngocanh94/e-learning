<?php

namespace common\models;

use common\utilities\Time;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "essay_answer".
 *
 * @property int $id
 * @property int $material_id
 * @property int $question_id
 * @property int $student_id
 * @property string $content
 * @property int $create_by
 * @property string $create_at
 * @property int $del_flg
 */
class EssayAnswer extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'essay_answer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'material_id', 'question_id', 'student_id', 'create_by', 'del_flg'], 'integer'],
            [['content'], 'string'],
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
            'material_id' => Yii::t('app', 'Material ID'),
            'question_id' => Yii::t('app', 'Question ID'),
            'student_id' => Yii::t('app', 'Student ID'),
            'content' => Yii::t('app', 'Content'),
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
            $this->create_by = Yii::$app->user->getId();
        }
        return parent::beforeSave($insert);
    }

}
