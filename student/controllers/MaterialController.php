<?php

namespace student\controllers;

use common\utilities\Query;
use student\models\LessionStatus;
use student\models\Material;
use student\models\Qa;
use student\models\Question;
use student\models\QuestionCpn;
use Yii;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\web\Controller;
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Material models.
     * @param $lesson_id
     * @return mixed
     */
    public function actionIndex($lesson_id)
    {
        $materials = Material::find()->where(['lesson_id'=>$lesson_id, 'del_flg'=>0])->all();
        /**
         * @var LessionStatus $lessonStatus
         */
        $lessonStatus = LessionStatus::find()->where(['lesson_id'=>$lesson_id,
            'student_id'=>Yii::$app->user->getId()])->orderBy(['id' => SORT_DESC])->limit(1)->one();
        $currentStatus = $lessonStatus ? $lessonStatus->status : 1;

        /**
         * @var Material $currentMaterial
         */
        $currentMaterial = array_slice(
            array_filter($materials,
                function ($v) use ($currentStatus) { return $v->rank == $currentStatus+1; }), 0)[0];

        if ($currentMaterial->type == Material::VIDEO){
            if ($currentMaterial->type == Material::VIDEO){
                return $this->render('video', [
                    'model' => $currentMaterial,
                    'qa' => Qa::find()->where(['material_id'=>$currentMaterial->id, 'is_approved'=>1])->all()
                ]);
            }
        }elseif ($currentMaterial->type == Material::QUIZ){
            try {
                $questionList = QuestionCpn::convert(Query::getInstance()
                    ->query('getQuestionNAnswer.sql', ["material_id" => $currentMaterial->id]));
                return $this->render('quiz', [
                    'model' => $questionList,
                    'material' => $currentMaterial,
                    'lesson_id' => $lesson_id
                ]);

            } catch (Exception $e) {
            }

        }elseif ($currentMaterial->type == Material::DRAG){
            $questionList = QuestionCpn::convertCpn(Question::find()->where(['material_id'=>$currentMaterial->id])->all());
            return $this->render('drag', [
                'model' => $questionList,
                'material' => $currentMaterial,
                'lesson_id' => $lesson_id
            ]);
        }

        return 1;
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
     * Next stage
     * @return int
     */
    public function actionNext()
    {
        $model = new LessionStatus();

        if (Yii::$app->request->isAjax){
            $data = Yii::$app->request->post();
            $current_student_id = Yii::$app->user->getId();
            $material_id = $data['material_id'];
            /**
             * @var Material $material
             */
            $material = Material::find()->where(['id'=>$material_id, 'del_flg'=>0])->one();

            $old = LessionStatus::find()->where(['student_id'=>$current_student_id, 'lesson_id'=>$model->lesson_id])->one();
            try {
                $old->delete();
            } catch (StaleObjectException $e) {
            } catch (\Throwable $e) {
            }

            try{
                if ($material){
                    $model->student_id = $current_student_id;
                    $model->status = intval($material->rank);
                    $model->lesson_id = intval($material->lesson_id);
                    $model->save();
                }
            }catch (\Exception $e){

            }
        }

        return 1;
    }


    /**
     * Creates a new Material model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Material();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Material model.
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
     * Deletes an existing Material model.
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

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
