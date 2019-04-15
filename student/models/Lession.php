<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "lession".
 *
 * @property int $id
 * @property int $course_id
 * @property int $rank
 * @property string $name
 * @property string $overview
 * @property int $length
 * @property string $image
 * @property string $create_at
 * @property string $update_at
 * @property int $create_by
 * @property int $update_by
 * @property int $del_flg
 */
class Lession extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lession';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_id', 'length', 'create_by', 'update_by', 'del_flg','rank'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
            [['name', 'image','overview'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'rank' => 'Rank',
            'length' => 'Length',
            'image' => 'Image',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'create_by' => 'Create By',
            'update_by' => 'Update By',
            'del_flg' => 'Del Flg',
        ];
    }
}
