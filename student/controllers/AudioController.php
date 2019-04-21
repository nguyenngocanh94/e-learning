<?php


namespace student\controllers;


use common\utilities\HtmlHelper;
use yii\web\Controller;

class AudioController extends Controller
{

    public function actionRight(){
        return HtmlHelper::getAudio('right.mp3');
    }

    public function actionWrong(){
        return HtmlHelper::getAudio('wrong.mp3');
    }

}