<?php

namespace student\controllers;

use common\utilities\Query;
use Yii;
use common\models\Course;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CourseController implements the CRUD actions for Course model.
 */
class CourseController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view'],
                'rules' => [
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ]
        ];
    }

    /**
     * Lists all Course in Subject.
     * @param $subjectId
     * @return mixed
     * @throws \yii\db\Exception
     */
    public function actionIndex($subjectId = null)
    {
        $queryClz = Query::getInstance();
        if ($subjectId != null){
            $models = $queryClz->query('getAvailableCourse.sql', [':student_id' => Yii::$app->user->getId(), ':subject_id'=>$subjectId]);
        }else{
            $models = $queryClz->query('getAvailableCourse.sql', [':student_id' => Yii::$app->user->getId(), ':subject_id'=>0]);
        }


        return $this->render('index', [
            'models'=>$models,
        ]);
    }

    /**
     * Displays a single Course model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Course model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Course::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
