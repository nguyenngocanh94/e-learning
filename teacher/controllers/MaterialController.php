<?php

namespace teacher\controllers;

use common\models\Lession;
use common\models\Question;
use common\models\QuestionCpn;
use common\utilities\Grant;
use common\utilities\Query;
use Yii;
use common\models\Material;
use common\models\MaterialS;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MaterialController implements the CRUD actions for Material model.
 */
class MaterialController extends Controller
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
                        'actions' => ['view','index', 'create','update','delete','edit'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['view','index', 'create','update','delete','edit'],
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
     * Lists all Material models.
     * @param $id
     * @return mixed
     */
    public function actionIndex($id)
    {
        $searchModel = new MaterialS();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['lesson_id'=>$id]);
        $dataProvider->query->orderBy(['rank'=>SORT_ASC]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'lesson'=> Lession::findOne($id)
        ]);
    }

    /**
     * Displays a single Material model.
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
     * Creates a new Material model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param $lesson_id
     * @return mixed
     */
    public function actionCreate($lesson_id)
    {
        if (!Lession::findOne($lesson_id)){
            throw new HttpException('404', 'Lesson not exist');
        }

        $model = new Material();
        $model->lesson_id = $lesson_id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        switch ($model->type){
            case Material::VIDEO:
            case Material::POWERPOINT:
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }

                return $this->render('update', [
                    'model' => $model,
                ]);
                break;
            case Material::ESSAY:
                $questions = Question::find()->where(['material_id'=>$model->id])->all();

                return $this->render('essay',[
                    'models'=> $questions,
                    'material'=>$model
                ]);
                break;
            case Material::QUIZ:
                $questionList = QuestionCpn::convert(Query::getInstance()
                    ->query('getQuestionNAnswer.sql', ["material_id" => $id]));
                return $this->render('quiz', [
                    'model' => $questionList,
                    'material'=>$model
                ]);
                break;
            case Material::DRAG:
                $questionList = QuestionCpn::convertCpn(Question::find()->where(['material_id'=>$id])->all());
                return $this->render('drag', [
                    'models'=>$questionList,
                    'material'=>$model
                ]);
                break;
            case Material::QUIZ_ESSAY:
                $questionList = QuestionCpn::convert(Query::getInstance()
                    ->query('getQuestionNAnswer.sql', ["material_id" => $id]));
                return $this->render('quiz', [
                    'model' => $questionList,
                    'material'=>$model
                ]);
        }

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
        return $this->redirect(['index','id'=>$model->lesson_id]);
    }

    public function actionEdit($id)
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
     * Finds the Material model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Material the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Material::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Finds the Question model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Question the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findQuestion($material_id)
    {
        if (($model = Question::find()->where(['material_id'=>$material_id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
