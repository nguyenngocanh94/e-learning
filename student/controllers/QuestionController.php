<?php

namespace student\controllers;

use student\models\Answer;
use student\models\QuestionComponent;
use student\models\QuestionStatus;
use Yii;
use student\models\Question;
use student\models\QuestionS;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * QuestionController implements the CRUD actions for Question model.
 */
class QuestionController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Question models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestionS();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Question model.
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
     * Answer a question.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionAnswer()
    {
        if (Yii::$app->request->isAjax){
            $data = Yii::$app->request->post();
            $current_student_id = Yii::$app->user->getId();
            $questionId = $data['question_id'];
            $answerId = $data['answer_id'];

            $question = Question::find()->where(['id'=>$questionId])->one();
            $answer = Answer::find()->where(['id'=>$answerId])->one();
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $qs = new QuestionStatus();
            $qs->student_id = $current_student_id;
            $qs->question_id = $questionId;

            if ($question->answer_content == $answer->answer_content){
                $qs->status = QuestionStatus::RIGHT;
                $qs->save();
                return [
                    'rep' => "RIGHT",
                ];
            }else{
                $qs->status = QuestionStatus::WRONG;
                $qs->save();
                return [
                    'rep' => "FALSE",
                ];
            }
        }

    }

    /**
     * handle drag drop
     * @return array
     */
    public function actionDrag(){
        if (Yii::$app->request->isAjax){
            $data = Yii::$app->request->post();
            $rank = $data['rank'];
            $component_id = $data['id'];

            \Yii::$app->response->format = Response::FORMAT_JSON;

            if (QuestionComponent::find()->where(['id'=>$component_id, 'rank'=>$rank])->count() > 0){
                return [
                    'rep' => "RIGHT",

                ];
            }else{
                return [
                    'rep' => "FALSE",
                ];
            }
        }
    }

    /**
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionUpdate(){
        if (Yii::$app->request->isAjax){
            $data = Yii::$app->request->post();
            $question_id = $data['question_id'];
            $questionStatus = new QuestionStatus();
            $questionStatus->question_id = $question_id;
            $questionStatus->student_id = Yii::$app->user->getId();
            $questionStatus->type = QuestionStatus::DRAG;
            $questionStatus->status = QuestionStatus::DONE;
            $questionStatus->save();
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'rep' => "RIGHT",

            ];
        }
    }

    /**
     * Creates a new Question model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Question();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Question model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Question model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Question the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Question::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}