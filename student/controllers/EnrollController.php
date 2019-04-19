<?php

namespace student\controllers;

use Yii;
use common\models\Enroll;
use common\models\EnrollS;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EnrollController implements the CRUD actions for Enroll model.
 */
class EnrollController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create'],
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ]
        ];
    }

    /**
     * @return int
     * @throws HttpException
     */
    public function actionCreate()
    {
        $model = new Enroll();

        if (Yii::$app->request->isAjax){
            $data = Yii::$app->request->post();
            $current_student_id = Yii::$app->user->getId();
            $enroll_course_id = $data['course_id'];
            //$enroll = Enroll::find()->where(['student_id'=>$current_student_id, 'course_id'=>$enroll_course_id])->one();
            try{
                $model->student_id = $current_student_id;
                $model->course_id = intval($enroll_course_id);
                $model->save();
            }catch (\Exception $e){
                throw new HttpException('500',"actionCreate Enroll");
            }
        }

        return 1;
    }

}
