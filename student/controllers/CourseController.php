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
                'only' => ['index', 'view','search'],
                'rules' => [
                    [
                        'actions' => ['index', 'view','search'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'search' => ['get'],
                ],
            ],
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

    public function actionSearch()
    {
        $this->layout = null;
        if (Yii::$app->request->isAjax){
            $data = Yii::$app->request->get();
            $course_name = $data['course_name'];
            $course_info = [];
            parse_str($data['adv_data'], $course_info);
            $adv_type = $course_info['type'];
            $adv_subject_id = $course_info['subject_id'];
            $adv_teacher_name = $course_info['teacher_name'];
            $student_id = Yii::$app->user->getId();
            $result = Query::getInstance()->query('searchCourse.sql',
                [':student_id'=> $student_id,':name'=>$course_name, ':teacher_name'=>$adv_teacher_name,':subject_id'=>$adv_subject_id, ':type'=>$adv_type]);

            return $this->renderPartial('search',
                ['models'=>$result]);

        }

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
