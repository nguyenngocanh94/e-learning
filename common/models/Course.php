<?php

namespace common\models;

use common\utilities\Time;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "course".
 *
 * @property int $id
 * @property int $subject_id
 * @property int $teacher_id
 * @property string $name
 * @property string $image1
 * @property string $image2
 * @property string $image3
 * @property string $description
 * @property string $create_at
 * @property string $update_at
 * @property int $create_by
 * @property int $update_by
 * @property int $del_flg
 */
class Course extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'course';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subject_id', 'teacher_id', 'create_by', 'update_by', 'del_flg'], 'integer'],
            [['description', 'name'], 'string'],
            [['create_at', 'update_at'], 'safe'],
            [['image1', 'image2', 'image3'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject_id' => 'Subject ID',
            'teacher_id' => 'Teacher ID',
            'image1' => 'Image1',
            'image2' => 'Image2',
            'image3' => 'Image3',
            'name' => 'Name',
            'description' => 'Description',
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
