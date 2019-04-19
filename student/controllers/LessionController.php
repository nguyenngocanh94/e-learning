<?php

namespace student\controllers;

use student\utilities\Authorization;
use student\utilities\ProgressTracking;
use Yii;
use common\models\Lession;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LessionController implements the CRUD actions for Lession model.
 */
class LessionController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ]
        ];
    }

    /**
     * @param $course_id
     * @return string
     * @throws HttpException
     */
    public function actionIndex($course_id)
    {
        if ($course_id != null){
            if (Authorization::isEnrolled($course_id)){
                $result = Lession::find()->where(['course_id' => intval($course_id)])->orderBy('rank')->all();
                $course_status = ProgressTracking::trackingLessonProcess($course_id);
                return $this->render('index', [
                    'models' => $result,
                    'course_id' => $course_id,
                    'course_status' => $course_status
                ]);
            }
        }

        throw new HttpException('500', "index lesson");
    }

}
