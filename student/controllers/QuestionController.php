<?php

namespace student\controllers;

use common\models\Answer;
use common\models\EssayAnswer;
use common\models\QuestionComponent;
use common\models\QuestionStatus;
use Yii;
use common\models\Question;
use common\models\QuestionS;
use yii\filters\AccessControl;
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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['answer','update'],
                'rules' => [
                    [
                        'actions' => ['answer','update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ]
        ];
    }



    /**
     * Answer a question multi choice.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionAnswer()
    {
        if (Yii::$app->request->isAjax){
            $data = Yii::$app->request->post();
            $current_student_id = Yii::$app->user->getId();
            \Yii::$app->response->format = Response::FORMAT_JSON;
            switch ($data['type']){
                case 'multi-choice':
                    $questionId = $data['question_id'];
                    $answerId = $data['answer_id'];

                    $question = Question::find()->cache('9000')->where(['id'=>$questionId])->one();
                    $answer = Answer::find()->where(['id'=>$answerId])->one();
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

                    break;

                case 'drag':
                    $rank = $data['rank'];
                    $component_id = $data['id'];



                    if (QuestionComponent::find()->where(['id'=>$component_id, 'rank'=>$rank])->count() > 0){
                        return [
                            'rep' => "RIGHT",
                        ];
                    }else{
                        return [
                            'rep' => "FALSE",
                        ];
                    }
                    break;

                case 'essay':
                    $questionId = $data['question_id'];
                    $essay = $data['essay_content'];
                    if (!Question::findOne($questionId)){
                        return ['rep'=>"FALSE"];
                    }

                    $essayAnw = new EssayAnswer();
                    $essayAnw->content = $essay;
                    $essayAnw->question_id = $questionId;
                    $essayAnw->student_id = Yii::$app->user->getId();

                    $essayAnw->save();

                    return ['rep'=>'RIGHT'];
                    break;

                default:
                    \Yii::$app->response->statusCode = Response::$httpStatuses[421];
                    break;
            }

        }

    }



    /**
     * update status for question
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

}
