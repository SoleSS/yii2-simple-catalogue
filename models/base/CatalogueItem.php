<?php

namespace soless\catalogue\models\base;

use Yii;

/**
 * This is the model class for table "catalogue_item".
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
class CatalogueItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogue_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'intro', 'full', 'publish_up', 'publish_down', 'created_at', 'updated_at'], 'required'],
            [['type_id', 'base_price_value', 'status', 'user_id', 'hits', 'priority'], 'default', 'value' => null],
            [['type_id', 'base_price_value', 'status', 'user_id', 'hits', 'priority'], 'integer'],
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Наименование',
            'title_lng1' => 'Наименование (язык #1)',
            'title_lng2' => 'Наименование (язык #2)',
            'type_id' => 'Тип',
            'subtitle' => 'Подзаголовок',
            'subtitle_lng1' => 'Подзаголовок (язык #1)',
            'subtitle_lng2' => 'Подзаголовок (язык #2)',
            'image_params' => 'Параметры лид-изображения',
            'show_image' => 'Отображать изображение?',
            'intro' => 'Краткое описание',
            'intro_lng1' => 'Краткое описание (язык #1)',
            'intro_lng2' => 'Краткое описание (язык #2)',
            'full' => 'Полное описание',
            'full_lng1' => 'Полное описание (язык #1)',
            'full_lng2' => 'Полное описание (язык #2)',
            'amp_full' => 'Полное описание (AMP версия)',
            'amp_full_lng1' => 'Полное описание (AMP версия) (язык #1)',
            'amp_full_lng2' => 'Полное описание (AMP версия) (язык #2)',
            'base_price_value' => 'Базовая цена x100',
            'price_params' => 'Параметры цены',
            'status' => 'Статус записи',
            'publish_up' => 'Дата начала публикации',
            'publish_down' => 'Дата окончания публикации',
            'user_id' => 'id Автора',
            'user_alias' => 'Алиас автора',
            'meta_keywords' => 'Meta keywords',
            'meta_description' => 'Meta description',
            'hits' => 'Кол-во просмотров',
            'medias' => 'Медиа контент',
            'gallery' => 'Галерея',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
            'params' => 'Дополнительные параметры',
            'priority' => 'Приоритет',
            'promo_image_params' => 'Параметры промо-изображения',
            'carousel_params' => 'Параметры карусели',
            'carousel_slides' => 'Слайды карусели',
            'custom_params' => 'Специальные параметры',
        ];
    }
}
