<?php


namespace common\models;


use yii\helpers\Html;

class QuestionCpn
{
    /**
     * @param $input
     * @return null
     */
    public static function convert($input, $type = 'single'){
        /**
         * @var SingleQuestion[] $questionArr
         */
        $questionArr = array();
        $arrLength = count($input);
        if ($arrLength == 0){
            return $questionArr;
        }

        $first = $type=='single' ? new SingleQuestion(): new QuizAssayQuestion();
        $first->load(reset($input));

        array_push($questionArr, $first);

        for ($i = 1; $i < $arrLength; $i++){
            // load more question
            if ($input[$i]['id'] != end($questionArr)->question->id){
                $temp = $type=='single' ? new SingleQuestion(): new QuizAssayQuestion();
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
        if ($array['answer_id']){
            $answer->id = $array['answer_id'];
            $answer->answer_content = $array['answer'];
            array_push($this->answers, $answer);
        }

    }

    public function out($flag = null){
        $hint = '<p class="the-hint" style="display: none;">'.$this->question->hint.'</p>';
        $question1 =  '<div class="col-md-3 question-item">
                <div class="card" style="width: 18rem;">
                    <div class="card-body card-body-title">
                        <h5 class="card-title">'.Html::encode($this->question->name).'</h5>
                        <p class="card-text">'.$this->question->content.'</p>'.$hint.'
                    </div>
                    <ul class="list-group list-group-flush">';

        $buttonSelect = '                     
                    </ul>
                    <div class="card-body">
                        <button class="card-link hint-pop btn">Hỗ trợ</button>
                        <button class="card-link re-select btn">Chọn lại</a>
                    </div>
                </div>
            </div>';

        if ($flag){
            $buttonSelect = '                     
                    </ul>
                    <div class="card-body">
                        '.Html::a('<i class="fas fa-edit"></i>', ['question/update/'.$this->question->id],['class'=>'card-link hint-pop']).'
                        '.Html::a('<i class="fas fa-trash"></i>', ['question/delete/'.$this->question->id],['class'=>'card-link hint-pop', 'data-method'=>'post']).'
                        '.Html::a('<i class="fas fa-plus"></i>', ['answer/create?question_id='.$this->question->id],['class'=>'card-link hint-pop']).'
                    </div>
                </div>
            </div>';
        }

        $answerString = '';
       foreach ($this->answers as $answer){
           if ($flag){
               if ($this->question->answer_content == $answer->answer_content){
                   $answerString .= '<li class="list-group-item choice" data-question="'.$this->question->id.'">
                                <a data-answer="'.$answer->id.'" class="btn btn-success">'. Html::encode($answer->answer_content).
                       '</a>'.
                       Html::a('<i class="fas fa-trash-alt"></i>', ['answer/delete/'.$answer->id],['class'=>'btn','style'=>'float: right']).
                       Html::a('<i class="fas fa-edit"></i>', ['answer/update/'.$answer->id],['class'=>'btn', 'style'=>'float: right']).'
                            </li>';
               }else{
                   $answerString .= '<li class="list-group-item choice" data-question="'.$this->question->id.'">
                                <a data-answer="'.$answer->id.'" class="btn btn-danger">'. Html::encode($answer->answer_content).
                       '</a>'.
                       '<a data-method="post" href="/answer/delete/'.$answer->id.'" class="btn" style="float: right"><i class="fas fa-trash-alt"></i></a>'.
                       Html::a('<i class="fas fa-edit"></i>', ['answer/update/'.$answer->id],['class'=>'btn', 'style'=>'float: right']).'
                            </li>';
               }
           }else{
               $answerString .= '<li class="list-group-item choice" data-question="'.$this->question->id.'">
                                <a data-answer="'.$answer->id.'" class="btn btn-block btn-secondary answer-item">'. Html::encode($answer->answer_content).
                   '</a>
                            </li>';
           }


       }

       return $question1.$answerString.$buttonSelect;
    }
}

class QuizAssayQuestion{
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

        }
        $answer = new Answer();
        $answer->id = $array['answer_id'];
        $answer->answer_content = $array['answer'];
        array_push($this->answers, $answer);
    }

    public function out(){
        $hint = '<p class="the-hint" style="display: none;">'.$this->question->hint.'</p>';
        $submit = ' <div class="card-body">
                    <button class="btn btn-block btn-primary submit-essay">submit</button>
                </div>';

        $question1 =  '<div class="col-md-3 question-item">
                <div class="card" style="width: 18rem;" data-question="'.$this->question->id.'">
                    <div class="card-body card-body-title">
                        <h5 class="card-title">'.Html::encode($this->question->name).'</h5>
                        <p class="card-text">'.$this->question->content.'</p>'.$hint.'
                    </div>
                    <ul class="list-group list-group-flush">';
        $question2 = '                     
                    </ul>
                    <div class="card-body">
                        <button class="card-link hint-pop btn">Hỗ trợ</button>
                        <button class="card-link re-select btn">Chọn lại</button>
                    </div>
                    '.$submit.'
                </div>
            </div>';
        $answerString = '';
        foreach ($this->answers as $answer){
            $answerString .= '<li class="list-group-item choice" data-question="'.$this->question->id.'">
                                <a data-answer="'.$answer->id.'" class="btn btn-block btn-secondary answer-item">'. Html::encode($answer->answer_content).
                '</a>
                            </li>';
        }

        $input = ' <li class="list-group-item essay">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fas fa-atom"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control essay-answer" placeholder="Câu trả lời" aria-label="answer" aria-describedby="basic-addon1">
                        </div>
                    </li>';

        return $question1.$answerString.$input.$question2;
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
        $this->component = QuestionComponent::find()->where(['question_id'=>$this->question->id, 'del_flg'=>0])->orderBy(['rank'=>SORT_ASC])->all();
    }

    /**
     * @param null $flg
     * @return string
     */
    public function out($flg = null){
        if ($flg){
            $head = '<div class="card" style="width: 18rem; margin-right: 4%">
            <div class="card-body">';
            $title = '<h5 class="card-title">'.$this->question->name.'</h5>';
            $text = '<p class="card-text">'.$this->question->content.'</p>';
            $middle = '</div>
            <ul class="list-group list-group-flush component-pool">';
            $end = '</ul>
            <div class="card-body">
                '.Html::a('<i class="fas fa-edit"></i>', ['question/update/'.$this->question->id],['class'=>'card-link hint-pop', 'data-toggle'=>'tooltip','title'=>'edit']).'
                '.Html::a('<i class="fas fa-trash"></i>', ['question/delete/'.$this->question->id],['class'=>'card-link hint-pop', 'data-method'=>'post']).'
                '.Html::a('<i class="fas fa-plus"></i>', ['component/create?question_id='.$this->question->id],['class'=>'card-link hint-pop']).'
            </div>
        </div>';
            $li = '';
            foreach ($this->component as $component){
                if($component->rank == 999){
                    $li .= '<li class="list-group-item lie-answer" data-id="'.$component->id.'"  data-qid="'.$this->question->id.'"  data-rank="'.$component->rank.'">'
                        .$component->name
                        .
                        '<a data-method="post" href="/component/update/'.$component->id.'" class="btn" style="float: right"><i class="fas fa-edit"></i></a>'.
                        '<a data-method="post" href="/component/delete/'.$component->id.'" class="btn" style="float: right"><i class="fas fa-trash-alt"></i></a>'.
                        '</li>';
                }else{
                    if ($component->missing == 1){
                        $li .= '<li class="list-group-item real-answer" data-id="'.$component->id.'"  data-qid="'.$this->question->id.'"  data-rank="'.$component->rank.'">'.$component->name
                            .
                        '<a data-method="post" href="/component/update/'.$component->id.'" class="btn" style="float: right"><i class="fas fa-edit"></i></a>'.
                            '<a data-method="post" href="/component/delete/'.$component->id.'" class="btn" style="float: right"><i class="fas fa-trash-alt"></i></a>'.'</li>';
                    }else{
                        $li .= '<li class="list-group-item normal" data-id="'.$component->id.'"  data-qid="'.$this->question->id.'"  data-rank="'.$component->rank.'">'.$component->name.
                            '<a data-method="post" href="/component/update/'.$component->id.'" class="btn" style="float: right"><i class="fas fa-edit"></i></a>'.
                            '<a data-method="post" href="/component/delete/'.$component->id.'" class="btn" style="float: right"><i class="fas fa-trash-alt"></i></a>'.'</li>';
                    }
                }

            }

            return $head.$title.$text.$middle.$li.$end;
        }

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
                if ($component->rank != 999){
                    $missingCpn .=
                        '<div data-id="'.Html::encode($component->id).'" class="draggable answer-inside" style="display: none">
                            <h3>'.Html::encode($component->name).'</h3>
                        </div>';

                    if (is_numeric($component->name)){
                        $chemistryElement .= '<div data-rank="'.Html::encode($component->rank).'" class="question-placehold droppable chemistry-element">
                    </div>';
                    }else{
                        $chemistryElement .= '<div data-rank="'.Html::encode($component->rank).'" class="question-placehold droppable chemistry-element">
                    </div>';
                    }
                }else{
                    $missingCpn .=
                        '<div data-id="'.Html::encode($component->id).'" class="draggable answer-inside" style="display: none">
                            <h3>'.Html::encode($component->name).'</h3>
                        </div>';
                }

            }
        }
        $endOfChemistry = '</div> </div>';
        $endOfMissing = ' </div>
                </div>';

        return ' <div class="row" style="margin-bottom: 5%">'.$chemistryElement.$endOfChemistry.$missingCpn.$endOfMissing.'</div>';
    }
}

