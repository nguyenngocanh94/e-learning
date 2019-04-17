<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "subject".
 *
 * @property int $id
 * @property int $rank
 * @property string $name
 * @property string $image
 * @property string $create_at
 * @property string $update_at
 */
class Subject extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subject';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id','rank'], 'integer'],
            [['image'], 'string'],
            [['create_at', 'update_at'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['id'], 'unique'],
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
            'rank' => 'Rank',
            'image' => 'Image',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }
}
