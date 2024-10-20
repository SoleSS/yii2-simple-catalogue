<?php

namespace soless\catalogue\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "cms_article".
 *
 * @property int $id
 * @property string $title Наименование
 * @property string|null $title_lng1 Наименование (язык #1)
 * @property string|null $title_lng2 Наименование (язык #2)
 * @property int $type_id Тип
 * @property string|null $subtitle Подзаголовок
 * @property string|null $subtitle_lng1 Подзаголовок (язык #1)
 * @property string|null $subtitle_lng2 Подзаголовок (язык #2)
 * @property string|null $image_params Параметры лид-изображения
 * @property bool $show_image Отображать изображение?
 * @property string $intro Краткое описание
 * @property string|null $intro_lng1 Краткое описание (язык #1)
 * @property string|null $intro_lng2 Краткое описание (язык #2)
 * @property string $full Полное описание
 * @property string|null $full_lng1 Полное описание (язык #1)
 * @property string|null $full_lng2 Полное описание (язык #2)
 * @property string|null $amp_full Полное описание (AMP версия)
 * @property string|null $amp_full_lng1 Полное описание (AMP версия) (язык #1)
 * @property string|null $amp_full_lng2 Полное описание (AMP версия) (язык #2)
 * @property int|null $base_price_value Базовая цена x100
 * @property string|null $price_params Параметры цены
 * @property int|null $status Статус записи
 * @property string $publish_up Дата начала публикации
 * @property string $publish_down Дата окончания публикации
 * @property int|null $user_id id Автора
 * @property string|null $user_alias Алиас автора
 * @property string|null $meta_keywords Meta keywords
 * @property string|null $meta_description Meta description
 * @property int $hits Кол-во просмотров
 * @property string|null $medias Медиа контент
 * @property string|null $gallery Галерея
 * @property string $created_at Дата создания
 * @property string $updated_at Дата обновления
 * @property string|null $params Дополнительные параметры
 * @property int $priority Приоритет
 * @property string|null $promo_image_params Параметры промо-изображения
 * @property string|null $carousel_params Параметры карусели
 * @property string|null $carousel_slides Слайды карусели
 * @property string|null $custom_params Специальные параметры
 */
class CatalogueItemSearch extends CatalogueItem
{
    public $category_id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'intro', 'full', 'publish_up', 'publish_down', 'created_at', 'updated_at'], 'required'],
            [['type_id', 'base_price_value', 'status', 'user_id', 'hits', 'priority'], 'default', 'value' => null],
            [['type_id', 'base_price_value', 'status', 'user_id', 'hits', 'priority', 'category_id'], 'integer'],
            [['image_params', 'price_params', 'publish_up', 'publish_down', 'medias', 'gallery', 'created_at', 'updated_at', 'params', 'promo_image_params', 'carousel_params', 'carousel_slides', 'custom_params'], 'safe'],
            [['show_image'], 'boolean'],
            [['full', 'full_lng1', 'full_lng2', 'amp_full', 'amp_full_lng1', 'amp_full_lng2'], 'string'],
            [['title', 'title_lng1', 'title_lng2', 'subtitle', 'subtitle_lng1', 'subtitle_lng2', 'user_alias'], 'string', 'max' => 255],
            [['intro', 'intro_lng1', 'intro_lng2', 'meta_keywords'], 'string', 'max' => 1024],
            [['meta_description'], 'string', 'max' => 2048],
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

    public function beforeValidate()
    {
        return true;
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
        $query = CatalogueItem::find()
            ->joinWith(['categories']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'defaultOrder' => ['created_at' => SORT_DESC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            CatalogueItem::tableName() . '.id' => $this->id,
            CatalogueItem::tableName() . '.type_id' => $this->type_id,
            CatalogueItem::tableName() . '.status' => $this->status,
            CatalogueItem::tableName() . '.hits' => $this->hits,
            CatalogueItem::tableName() . '.user_id' => $this->user_id,
            CatalogueItem::tableName() . '.priority' => $this->priority,
            CatalogueItem::tableName() . '.show_image' => $this->show_image,
        ]);

        $query->andFilterWhere(['like', CatalogueItem::tableName() . '.title', $this->title])
            ->andFilterWhere(['like', CatalogueItem::tableName() . '.title_lng1', $this->title_lng1])
            ->andFilterWhere(['like', CatalogueItem::tableName() . '.title_lng2', $this->title_lng1])
            ->andFilterWhere(['like', CatalogueItem::tableName() . '.full', $this->full])
            ->andFilterWhere(['like', CatalogueItem::tableName() . '.full_lng1', $this->full_lng1])
            ->andFilterWhere(['like', CatalogueItem::tableName() . '.full_lng2', $this->full_lng2])
            ->andFilterWhere(['like', CatalogueItem::tableName() . '.amp_full', $this->amp_full])
            ->andFilterWhere(['like', CatalogueItem::tableName() . '.amp_full_lng1', $this->amp_full_lng1])
            ->andFilterWhere(['like', CatalogueItem::tableName() . '.amp_full_lng2', $this->amp_full_lng2]);

        if (!empty($this->created_at)) $query->andFilterWhere(['>=', CatalogueItem::tableName() . '.created_at', date('Y-m-d', strtotime($this->created_at))]);
        if (!empty($this->updated_at)) $query->andFilterWhere(['>=', CatalogueItem::tableName() . '.updated_at', date('Y-m-d', strtotime($this->updated_at))]);
        if (!empty($this->publish_up)) $query->andFilterWhere(['>=', CatalogueItem::tableName() . '.publish_up', date('Y-m-d', strtotime($this->publish_up))]);
        if (!empty($this->publish_down)) $query->andFilterWhere(['>=', CatalogueItem::tableName() . '.publish_down', date('Y-m-d', strtotime($this->publish_down))]);
        if (!empty($this->category_id)) $query->andFilterWhere([CatalogueItem::tableName().'.id' => $this->category_id]);

        return $dataProvider;
    }
}
