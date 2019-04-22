<?php

namespace teacher\controllers;

use common\models\Course;
use common\models\Student;
use common\utilities\Grant;
use common\utilities\Query;
use student\utilities\ProgressTracking;
use teacher\models\LessonForm;
use Yii;
use common\models\Lession;
use common\models\LessionS;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LessonController implements the CRUD actions for Lession model.
 */
class LessonController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['view','index', 'create','update','delete','analysis','analysis-all'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['view','index', 'create','update','delete','analysis','analysis-all'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all Lession models.
     * @param $id
     * @return mixed
     */
    public function actionIndex($id)
    {
        $searchModel = new LessionS();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['course_id'=>$id]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'course_id' => $id
        ]);
    }

    /**
     * Displays a single Lession model.
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
     * Creates a new Lession model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($course_id)
    {
        $model = new LessonForm();

        if ($model->load(Yii::$app->request->post()) && $lesson = $model->create()) {
            return $this->redirect(['view', 'id' => $lesson->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'course_id'=>$course_id
        ]);
    }

    /**
     * Updates an existing Lession model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws HttpException
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (!Grant::checkModel($model)){
            throw new HttpException('403', "Permission");
        }
        $model->delete();
        return $this->redirect(['index', 'id'=>$model->course_id]);
    }

    /**
     * Finds the Lession model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Lession the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lession::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionAnalysis($student_id, $course_id){
        $student = Student::findOne($student_id);
        $course = Course::findOne($course_id);
        if (!$student || !$course){
            throw new HttpException(404);
        }
        $result = Query::getInstance()->query('getStudentAnalysisInCourse.sql', [':student_id'=>$student_id,':course_id'=>$course_id]);
        return $this->render('analysis', [
            'models' => $result,
            'student' => $student,
            'course'=>$course

        ]);
    }

    public function actionAnalysisAll($lesson_id){
        $lesson = Lession::findOne($lesson_id);
        if (!$lesson){
            throw new HttpException(404);
        }
        $result = Query::getInstance()->query('getStudentAnalysisAll.sql', [':lesson_id'=>$lesson_id]);
        return $this->render('analysis-all', [
            'models' => $result,
            'lesson'=>$lesson
        ]);
    }
}
