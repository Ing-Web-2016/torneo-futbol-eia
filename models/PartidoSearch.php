<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Partido;

/**
 * PartidoSearch represents the model behind the search form about `app\models\Partido`.
 */
class PartidoSearch extends Partido
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'arbitro_id', 'equipo_local_id', 'equipo_visitante_id'], 'integer'],
            [['fecha', 'lugar', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Partido::find();

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
            'fecha' => $this->fecha,
            'arbitro_id' => $this->arbitro_id,
            'equipo_local_id' => $this->equipo_local_id,
            'equipo_visitante_id' => $this->equipo_visitante_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'lugar', $this->lugar]);

        return $dataProvider;
    }
}
