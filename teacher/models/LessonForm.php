<?php
/**
 * Created by PhpStorm.
 * User: VNUSER
 * Date: 4/19/2019
 * Time: 2:46 PM
 */

namespace teacher\models;


use common\models\Lession;
use common\utilities\Hash;
use Yii;
use yii\web\UploadedFile;

class LessonForm extends Lession
{
    public $imageF;

    public function create(){
        $this->imageF = UploadedFile::getInstance($this,'imageF');
        $this->image = Yii::getAlias("@uploads") .'/'. Hash::hash($this->imageF->baseName) . '.' . $this->imageF->extension;

        $this->imageF->saveAs($this->image, false);

        $lesson = new Lession();
        $lesson->course_id = $this->course_id;
        $lesson->rank = $this->rank;
        $lesson->name = $this->name;
        $lesson->length = $this->length;
        $lesson->overview = $this->overview;
        $lesson->image = $this->image;
        $lesson->save();

        return $lesson;
    }
}