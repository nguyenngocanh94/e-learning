<?php

namespace student\controllers;

use common\models\Course;
use common\models\Enroll;
use common\models\Lession;
use common\utilities\Query;
use common\models\LessionStatus;
use common\models\Material;
use common\utilities\Time;
use student\models\Qa;
use common\models\Question;
use common\models\QuestionCpn;
use Yii;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

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
                'only' => ['index','next'],
                'rules' => [
                    [
                        'actions' => ['index','next'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ]
        ];
    }

    /**
     * @param $lesson_id
     * @return string|Response
     * @throws HttpException
     */
    public function actionIndex($lesson_id)
    {
        $materials = Material::find()->where(['lesson_id'=>$lesson_id, 'del_flg'=>0])->all();
        /**
         * @var LessionStatus $lessonStatus
         */
        $lessonStatus = LessionStatus::find()->where(['lesson_id'=>$lesson_id,
            'student_id'=>Yii::$app->user->getId()])->orderBy(['id' => SORT_DESC])->limit(1)->one();
        if (!$lessonStatus){
            $lessonStatus = new LessionStatus();
        }
        $currentStatus = $lessonStatus ? $lessonStatus->status : 0;

        if (count($materials) <= $currentStatus){
            $currentStatus = 0;
            $lessonStatus->status = 0;
            $lessonStatus->save();
        }

        $temp  = array_filter($materials,
            function ($v) use ($currentStatus) { return $v->rank == $currentStatus+1; });
        /**
         * @var Material $currentMaterial
         */
        $currentMaterial = count($temp) > 0 ? array_slice(
            $temp, 0)[0] : null;
        $course_id = Lession::findOne($lesson_id)->course_id;
        if ($currentMaterial == null){
            return $this->redirect(array('lession/index', 'course_id'=>$course_id));
        }

        switch ($currentMaterial->type){
            case Material::VIDEO:
                return $this->render('video', [
                    'model' => $currentMaterial,
                    'material' => $currentMaterial,
                    'course_id'=>$course_id,
                    'qa' => Qa::find()->where(['material_id'=>$currentMaterial->id, 'is_approved'=>1])->all()
                ]);
                break;

            case Material::POWERPOINT:
                return $this->render('powerpoint', [
                    'model' => $currentMaterial,
                    'material' => $currentMaterial,
                    'course_id'=>$course_id,
                ]);
                break;

            case Material::QUIZ:
                try {
                    $questionList = QuestionCpn::convert(Query::getInstance()
                        ->query('getQuestionNAnswer.sql', ["material_id" => $currentMaterial->id]));
                    return $this->render('quiz', [
                        'model' => $questionList,
                        'material' => $currentMaterial,
                        'course_id'=>$course_id,
                        'lesson_id' => $lesson_id
                    ]);

                } catch (Exception $e) {
                }
                break;

            case Material::QUIZ_ESSAY:
                try {

                    $questionList = QuestionCpn::convert(Query::getInstance()
                        ->query('getQuestionNAnswer.sql', ["material_id" => $currentMaterial->id]), 'quizE');
                } catch (Exception $e) {
                }
                return $this->render('quizE', [
                    'model' => $questionList,
                    'material' => $currentMaterial,
                    'course_id'=>$course_id,
                    'lesson_id' => $lesson_id
                ]);
                break;


            case Material::DRAG:
                $questionList = QuestionCpn::convertCpn(Question::find()->where(['material_id'=>$currentMaterial->id])->all());
                return $this->render('drag', [
                    'model' => $questionList,
                    'material' => $currentMaterial,
                    'course_id'=>$course_id,
                    'lesson_id' => $lesson_id
                ]);
                break;

            case Material::ESSAY:
                $questionList = Question::find()->where(['material_id'=>$currentMaterial->id])->all();
                return $this->render('essay', [
                    'model' => $questionList,
                    'material' => $currentMaterial,
                    'course_id'=>$course_id,
                    'lesson_id' => $lesson_id
                ]);

                break;

            default: throw new HttpException('404'); break;
        }
    }

    /**
     * @return array|int
     * @throws HttpException
     */
    public function actionNext()
    {
        $model = new LessionStatus();

        if (Yii::$app->request->isAjax){
            $data = Yii::$app->request->post();
            $current_student_id = Yii::$app->user->getId();
            $material_id = $data['material_id'];
            $time = $data['time'];

            /**
             * @var Material $material
             */
            $material = Material::find()->where(['id'=>$material_id, 'del_flg'=>0])->one();
            $course_id = Lession::findOne($material->lesson_id)->course_id;
            $old = LessionStatus::findOne(['student_id'=>$current_student_id, 'lesson_id'=>$material->lesson_id]);
            try{
                if ($material){
                    if ($old !== null){
                        $old->status = intval($material->rank);
                        $old->time = Time::Sum(Time::Time($old->time), Time::Time($time))->toString();
                        $model = $old;
                        $old->save();
                    }else{
                        $model->student_id = $current_student_id;
                        $model->status = intval($material->rank);
                        $model->lesson_id = intval($material->lesson_id);
                        $model->time = Time::Time($time)->toString();
                        $model->save();
                    }
                    $total_lesson = Material::find()->where(['lesson_id'=>$material->lesson_id])->count();
                    if ($model->status >= $total_lesson){
                        /**
                         * @var Enroll $enroll
                         */
                        $enroll = Enroll::find()->
                        where(['student_id'=>$current_student_id, 'course_id'=>$course_id])
                            ->orderBy(['update_at'=>SORT_DESC])->one() ;
                        $lessonTotal = Lession::find()->where(['course_id'=>$course_id])->count();
                        if ($enroll->status < $lessonTotal){
                            $enroll->status = $enroll->status + 1;
                            $enroll->save();
                        }
                        \Yii::$app->response->format = Response::FORMAT_JSON;

                        return [
                            'rep' => "success",
                        ];
                    }
                }
            }catch (\Exception $e){
                throw new HttpException('503', $e);
            }
        }

        return 1;
    }

}
