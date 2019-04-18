<?php

namespace common\models;

use common\utilities\Time;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "question".
 *
 * @property int $id
 * @property int $material_id
 * @property int $rank
 * @property string $name
 * @property string $content
 * @property string $assay_content
 * @property string $hint
 * @property string $answer_content
 * @property string $create_at
 * @property string $update_at
 * @property int $create_by
 * @property int $update_by
 * @property int $del_flg
 */
class Question extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['material_id', 'create_by', 'update_by', 'del_flg', 'rank'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
            [['name', 'content', 'answer_content','hint','assay_content'], 'string', 'max' => 255],
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
            'name' => Yii::t('app', 'Name'),
            'content' => Yii::t('app', 'Content'),
            'rank' => Yii::t('app', 'Rank'),
            'hint' => Yii::t('app', 'Hint'),
            'answer_content' => Yii::t('app', 'Answer Content'),
            'assay_content' => Yii::t('app', 'Assay Content'),
            'create_at' => Yii::t('app', 'Create At'),
            'update_at' => Yii::t('app', 'Update At'),
            'create_by' => Yii::t('app', 'Create By'),
            'update_by' => Yii::t('app', 'Update By'),
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
