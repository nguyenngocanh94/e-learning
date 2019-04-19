<?php

namespace teacher\controllers;

use common\utilities\Grant;
use teacher\models\CourseForm;
use Yii;
use common\models\Course;
use common\models\CourseS;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;
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
                'rules' => [
                    [
                        'actions' => ['view','index', 'create','update','delete'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['view','index', 'create','update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST','GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all Course models.
     * @param $id
     * @return mixed
     */
    public function actionIndex($id)
    {
        if ($id == null){
            return;
        }
        $searchModel = new CourseS();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['subject_id'=>$id]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'subject_id'=>$id
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
     * Creates a new Course model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($subject_id)
    {
        if ($subject_id == null){
            return;
        }

        $model = new CourseForm();
        if ($model->load(Yii::$app->request->post()) && $saved = $model->create()) {

            return $this->redirect(['index', 'id'=>$saved->subject_id ]);
        }

        return $this->render('create', [
            'model' => $model,
            'subject_id'=>$subject_id
        ]);
    }

    /**
     * Updates an existing Course model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $form = new CourseForm();
        $form->id = $model->id;
        $form->name = $model->name;
        $form->description = $model->description;
        $form->teacher_id = $model->teacher_id;
        $form->description = $model->description;
        if ($form->load(Yii::$app->request->post()) && $form->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $form,
            'subject_id'=> $model->subject_id
        ]);
    }

    /**
     * Deletes an existing Course model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (!Grant::checkModel($model)){
            throw new HttpException('403', "Permission");
        }
        $model->delete();
        return $this->redirect(['index','id'=>$model->subject_id]);
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

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
