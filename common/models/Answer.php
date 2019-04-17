<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "answer".
 *
 * @property int $id
 * @property string $answer_content
 * @property int $question_id
 * @property int $rank
 * @property string $create_at
 * @property string $update_at
 * @property int $create_by
 * @property int $update_by
 * @property int $del_flg
 */
class Answer extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'answer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_id', 'create_by', 'update_by', 'del_flg','rank'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
            [['answer_content'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'answer_content' => Yii::t('app', 'Answer Content'),
            'question_id' => Yii::t('app', 'Question ID'),
            'rank' => Yii::t('app', 'Rank'),
            'create_at' => Yii::t('app', 'Create At'),
            'update_at' => Yii::t('app', 'Update At'),
            'create_by' => Yii::t('app', 'Create By'),
            'update_by' => Yii::t('app', 'Update By'),
            'del_flg' => Yii::t('app', 'Del Flg'),
        ];
    }
}
