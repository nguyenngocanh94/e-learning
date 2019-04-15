<?php

namespace student\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use student\models\Question;

/**
 * QuestionS represents the model behind the search form of `student\models\Question`.
 */
class QuestionS extends Question
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'material_id', 'create_by', 'update_by', 'del_flg'], 'integer'],
            [['name', 'content', 'answer_content', 'create_at', 'update_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Question::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'material_id' => $this->material_id,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
            'create_by' => $this->create_by,
            'update_by' => $this->update_by,
            'del_flg' => $this->del_flg,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'answer_content', $this->answer_content]);

        return $dataProvider;
    }
}
