<?php
namespace teacher\models;


use common\models\Course;
use common\utilities\Hash;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class CourseForm extends Model
{
    public $main_image;
    public $sub_image1;
    public $sub_image2;
    public $subject_id;
    public $name;
    public $description;
    public $image1;
    public $image2;
    public $image3;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['subject_id', 'integer'],
            ['description', 'string'],
            ['name', 'string', 'max' => 255],
            ['main_image', 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024*1024],
            ['sub_image1', 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024*1024],
            ['sub_image2', 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024*1024],
        ];
    }

    public function create(){
        $this->main_image = UploadedFile::getInstance($this,'main_image');
        $this->sub_image1 = UploadedFile::getInstance($this,'sub_image1');
        $this->sub_image2 = UploadedFile::getInstance($this,'sub_image2');
        $this->image1 = Yii::getAlias("@uploads") .'/'. Hash::hash($this->main_image->baseName) . '.' . $this->main_image->extension;
        $this->image2 = Yii::getAlias("@uploads") .'/'. Hash::hash($this->sub_image1->baseName) . '.' . $this->sub_image1->extension;
        $this->image3 = Yii::getAlias("@uploads") .'/'. Hash::hash($this->sub_image2->baseName) . '.' . $this->sub_image2->extension;

        $this->main_image->saveAs($this->image1, false);
        $this->sub_image1->saveAs($this->image2, false);
        $this->sub_image2->saveAs($this->image3, false);

        if ($this->validate()) {
            $course = new Course();
            $course->name = $this->name;
            $course->teacher_id = Yii::$app->user->getId();
            $course->subject_id = $this->subject_id;
            $course->description = $this->description;
            $course->image1 = $this->image1;
            $course->image2 = $this->image2;
            $course->image3 = $this->image3;
            return $course->save();
        }

        return null;
    }
}