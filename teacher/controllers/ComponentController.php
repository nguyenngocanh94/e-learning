<?php
/**
 * Created by PhpStorm.
 * User: VNUSER
 * Date: 4/19/2019
 * Time: 10:42 AM
 */

namespace teacher\controllers;
use common\models\Material;
use common\models\Question;
use common\utilities\Grant;
use Yii;
use common\models\QuestionComponent;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ComponentController extends Controller
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
                        'actions' => ['view', 'create','update','delete','order'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['view', 'create','update','delete','order'],
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
     * @param $id
     * @return string
     * @throws HttpException
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if (($material = Question::findOne($model->question_id))===null){
            throw new HttpException('404');
        };
        return $this->render('view', [
            'model' => $model,
            'material'=>$material
        ]);
    }

    /**
     * Creates a new QuestionComponent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param $question_id
     * @return mixed
     * @throws HttpException
     */
    public function actionCreate($question_id)
    {
        if (($question = Question::findOne($question_id))===null){
            throw new HttpException('404', 'Question not found');
        }
        $data = Yii::$app->request->post();
        $model = new QuestionComponent();
        if (Yii::$app->request->isPost){
            $model->load($data);
            $model->question_id = $question_id;
            if ($model->rank == 999){
                $model->missing = 1;
            }else{
                $maxRank =  QuestionComponent::find()->where(['question_id'=>$question_id])->andWhere(['<>','rank', 999])->count() + 1;
                $model->rank = $maxRank;
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }


        return $this->render('create', [
            'model' => $model,
            'material_id' => $question->material_id
        ]);
    }

    /**
     * Updates an existing QuestionComponent model.
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

        return 1;
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
        $material = Question::findOne($model->question_id);
        $model->delete();
        return $this->redirect(['material/update/'.$material->material_id]);
    }

    /**
     * Finds the QuestionComponent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QuestionComponent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QuestionComponent::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}