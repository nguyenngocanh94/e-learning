<?php
namespace student\module\video;

use student\models\Material;
use student\models\Qa;
use yii\web\Controller;

class Video
{
    private $ctr;
    private $material;

    /**
     * Video constructor.
     * @param Controller $ctr
     * @param Material $material
     */
    public function __construct($ctr, $material)
    {
        $this->ctr = $ctr;
        $this->material = $material;
    }

    public function getQa($materialId){
        return Qa::find()->where(['material_id'=>$materialId, 'is_approved'=>1])->all();
    }

    public function out(){
        $this->ctr->render('video', [
            'model' => $this->material,
            'qa'=> $this->getQa($this->material->id)
        ]);
    }
}