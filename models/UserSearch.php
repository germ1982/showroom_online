<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;
use GuzzleHttp\Psr7\Query;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{

      public function rules()
      {
            return [
                  [['id', 'created_at', 'updated_at'], 'integer'],
                  [['username', 'email', 'password_hash', 'auth_key', 'access_token', 'status', 'telefono', 'rol'], 'safe'],
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
            $query = User::find();
            $query->joinWith(['roles']);
            $dataProvider = new ActiveDataProvider([
                  'query' => $query,
            ]);

            $dataProvider->sort->attributes['rol'] = [
                  'asc' => ['user_rol.descripcion' => SORT_ASC],
                  'desc' => ['user_rol.descripcion' => SORT_DESC],
            ];

            $this->load($params);

            if (!$this->validate()) {
                  // uncomment the following line if you do not want to return any records when validation fails
                  // $query->where('0=1');
                  return $dataProvider;
            }
            $query->andFilterWhere(['like', 'user_rol.nombre', $this->rol]);
            $query->andFilterWhere([
                  'id' => $this->id,
                  'created_at' => $this->created_at,
                  'updated_at' => $this->updated_at,
            ]);

            $query->andFilterWhere(['like', 'username', $this->username])
                  ->andFilterWhere(['like', 'email', $this->email])
                  ->andFilterWhere(['like', 'telefono', $this->telefono])
                  ->andFilterWhere(['like', 'password_hash', $this->password_hash])
                  ->andFilterWhere(['like', 'auth_key', $this->auth_key])
                  ->andFilterWhere(['like', 'access_token', $this->access_token])
                  ->andFilterWhere(['like', 'status', $this->status]);

            return $dataProvider;
      }
}
