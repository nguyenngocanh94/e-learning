<?php

namespace student\models;

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
            [['lesson_id', 'type', 'rank', 'create_by', 'update_by', 'del_flg', 'limit_time'], 'integer'],
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
            'content_url' => 'Content Url',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'create_by' => 'Create By',
            'update_by' => 'Update By',
            'del_flg' => 'Del Flg',
        ];
    }
}
