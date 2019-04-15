<?php

namespace student\models;

use Yii;

/**
 * This is the model class for table "qa".
 *
 * @property int $id
 * @property int $student_id
 * @property int $material_id
 * @property int $is_approved
 * @property string $question
 * @property string $answer
 * @property int $create_by
 * @property int $update_by
 * @property string $create_at
 * @property string $update_at
 * @property int $del_Flg
 */
class Qa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'qa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'material_id', 'create_by', 'update_by', 'del_Flg', 'is_approved'], 'integer'],
            [['question', 'answer'], 'string'],
            [['create_at', 'update_at'], 'safe'],
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
            'is_approved' => Yii::t('app', 'Approved?'),
            'material_id' => Yii::t('app', 'Material ID'),
            'question' => Yii::t('app', 'Question'),
            'answer' => Yii::t('app', 'Answer'),
            'create_by' => Yii::t('app', 'Create By'),
            'update_by' => Yii::t('app', 'Update By'),
            'create_at' => Yii::t('app', 'Create At'),
            'update_at' => Yii::t('app', 'Update At'),
            'del_Flg' => Yii::t('app', 'Del Flg'),
        ];
    }
}
