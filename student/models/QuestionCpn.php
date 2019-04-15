<?php


namespace student\models;


use yii\helpers\Html;

class QuestionCpn
{
    /**
     * @param $input
     * @return null
     */
    public static function convert($input){
        /**
         * @var SingleQuestion[] $questionArr
         */
        $questionArr = array();
        $arrLength = count($input);
        if ($arrLength == 0){
            return $questionArr;
        }

        $first = new SingleQuestion();
        $first->load(reset($input));

        array_push($questionArr, $first);

        for ($i = 1; $i < $arrLength; $i++){
            // load more question
            if ($input[$i]['id'] != end($questionArr)->question->id){
                $temp = new SingleQuestion();
                $temp->load($input[$i]);

                array_push($questionArr, $temp);
            }else{
                $temp = end($questionArr);
                $temp->load($input[$i]);
            }
        }

        return $questionArr;
    }

    /**
     * @param Question[] $questionList
     * @return ComponentQuestion[]
     */
    public static function convertCpn($questionList){

        /**
         * @var ComponentQuestion[] $questionArr
         */
        $questionArr = array();
        if (count($questionList) == 0){
            return $questionArr;
        }
        foreach ($questionList as $question){
            $temp = new ComponentQuestion($question);
            $temp->load();
            array_push($questionArr, $temp);
        }

        return $questionArr;
    }
}

class SingleQuestion{
    /**
     * @var Question $question
     */
    public $question;
    /**
     * @var Answer[] $answers
     */
    public $answers = array();

    public function __construct()
    {
        $this->question = new Question();
    }

    public function load($array){
        if ($this->question->id == null){
            $this->question->id = $array['id'];
            $this->question->material_id = $array['material_id'];
            $this->question->name = $array['name'];
            $this->question->content = $array['content'];
            $this->question->hint = $array['hint'];
            $this->question->answer_content = $array['answer_content'];

        }
        $answer = new Answer();
        $answer->id = $array['answer_id'];
        $answer->answer_content = $array['answer'];
        array_push($this->answers, $answer);
    }

    public function out(){
        $hint = '<p class="the-hint" style="display: none;">'.Html::encode($this->question->hint).'</p>';
        $question1 =  '<div class="col-md-3 question-item">
                <div class="card" style="width: 18rem;">
                    <div class="card-body card-body-title">
                        <h5 class="card-title">'.Html::encode($this->question->name).'</h5>
                        <p class="card-text">'.Html::encode($this->question->content).'</p>'.$hint.'
                    </div>
                    <ul class="list-group list-group-flush">';
        $question2 = '                     
                    </ul>
                    <div class="card-body">
                        <a href="#" class="card-link hint-pop">Hỗ trợ</a>
                        <a href="#" class="card-link re-select">Chọn lại</a>
                    </div>
                </div>
            </div>';
        $answerString = '';
       foreach ($this->answers as $answer){
           $answerString .= '<li class="list-group-item" data-question="'.$this->question->id.'">
                                <a data-answer="'.$answer->id.'" class="btn btn-block btn-secondary answer-item">'. Html::encode($answer->answer_content).
                                '</a>
                            </li>';
       }

       return $question1.$answerString.$question2;
    }
}


class ComponentQuestion{
    /**
     * @var Question $question
     */
    public $question;
    /**
     * @var QuestionComponent[] $answers
     */
    public $component = array();

    public function __construct($question)
    {
        $this->question = $question;
    }


    public function load(){
        $this->component = QuestionComponent::find()->where(['question_id'=>$this->question->id, 'del_flg'=>0])->all();
    }

    public function out(){
        $chemistryElement = '<div data-id="'.$this->question->id.'" class="col-md-12 mother-all" style="text-align: center"> <div  class="chemistry-element-parent" style="display: inline-flex;">';
        $missingCpn = '<div class="col-md-12" style="margin-top: 10px; text-align: center">
                    <div class="answer-pool" style="display: inline-block;">';
        foreach ($this->component as $component){
            if ($component->missing == 0){
                if ($component->name =='+'){
                    $chemistryElement .=
                        '<div class="chemistry-element" style="width: 60px">
                         <i class="fas fa-plus"></i>
                    </div>';
                }elseif ($component->name == "->"){
                    $chemistryElement .=
                        '<div class="chemistry-element">
                         <i class="fas fa-arrow-right"></i>
                    </div>';
                }else{
                    $chemistryElement .=
                        '<div class="chemistry-element">'.Html::encode($component->name)
                        .'</div>';;
                }
            }else{
                $missingCpn .=
                    '<div data-id="'.Html::encode($component->id).'" class="draggable answer-inside">
                            <h3>'.Html::encode($component->name).'</h3>
                        </div>';
                $chemistryElement .= '<div data-rank="'.Html::encode($component->rank).'" class="question-placehold droppable chemistry-element">
                    </div>';
            }
        }
        $endOfChemistry = '</div> </div>';
        $endOfMissing = ' </div>
                </div>';

        return ' <div class="row">'.$chemistryElement.$endOfChemistry.$missingCpn.$endOfMissing.'</div>';
    }
}