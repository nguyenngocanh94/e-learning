<?php

namespace common\models;;

use common\utilities\Time;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "material".
 *
 * @property int $id
 * @property string $name
 * @property int $lesson_id
 * @property int $type
 * @property int $rank
 * @property int $limit_time
 * @property int $question_threshold
 * @property string $descriptions
 * @property string $content_url
 * @property string $create_at
 * @property string $update_at
 * @property int $create_by
 * @property int $update_by
 * @property int $del_flg
 */
class Material extends ActiveRecord
{

    const VIDEO = 1;
    const POWERPOINT = 2;
    const QUIZ = 3;
    const DRAG = 4;
    const QUIZ_ESSAY = 5;
    const ESSAY = 6;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'material';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lesson_id', 'type', 'rank', 'create_by', 'update_by', 'del_flg', 'limit_time', 'question_threshold'], 'integer'],
            [['descriptions'], 'string'],
            [['create_at', 'update_at'], 'safe'],
            [['name', 'content_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'lesson_id' => 'Lesson ID',
            'type' => 'Type',
            'rank' => 'Rank',
            'descriptions' => 'Descriptions',
            'limit_time' => 'Limit time',
            'question_threshold' => 'Question Threshold',
            'content_url' => 'Content Url',
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
