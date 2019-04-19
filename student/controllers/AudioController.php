<?php


namespace student\controllers;


use common\utilities\HtmlHelper;
use yii\filters\AccessControl;
use yii\web\Controller;

class AudioController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['wrong', 'right'],
                'rules' => [
                    [
                        'actions' => ['right', 'wrong'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ]
        ];
    }

    public function actionRight(){
        return HtmlHelper::getAudio('right.mp3');
    }

    public function actionWrong(){
        return HtmlHelper::getAudio('right.mp3');
    }

}