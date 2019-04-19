<?php

namespace teacher\controllers;


use Yii;
use common\models\QuestionComponent;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;

/**
 * ComponentQuestionController implements the CRUD actions for QuestionComponent model.
 */
class ComponentQuestionController extends Controller
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
                    'delete' => ['POST','GET'],
                ],
            ],
        ];
    }

    /**
     * @return int
     * @throws HttpException
     */
    public function actionOrder()
    {

        if (Yii::$app->request->isAjax){
            $data = Yii::$app->request->post();
            $id = $data['id'];
            $question_id = $data['question_id'];
            $nRank = $data['rank'];
            $swap = QuestionComponent::find()->where(['rank'=>$nRank, 'question_id'=>$question_id])->one();
            if (!$swap){
                throw new HttpException('404', "Not found Question Component");
            }

            if (($model = QuestionComponent::findOne($id)) === null){
                throw new HttpException('404', "Not found Question Component");
            }


            try{
                $swap->rank = $model->rank;
                $model->rank = $nRank;
                $model->save() && $swap->save();
            }catch (\Exception $e){
                throw new HttpException('500', "Server error, at actionOrder");
            }
        }

        return "success";
    }



}
