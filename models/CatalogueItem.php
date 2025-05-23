<?php

namespace soless\catalogue\models;

use yii\helpers\ArrayHelper;

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
 *
 * @property-read string $statusText
 * @property-read User $user
 * @property-read CatalogueCategory[] $categories
 * @property-read array $categoriesList
 * @property-read CatalogueTag[] $tags
 */
class CatalogueItem extends base\CatalogueItem
{
    public $selectedCategories = [];
    public $selectedTags = '';
    public $batchGallery = '';

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['selectedCategories', 'each', 'rule' => ['integer']];
        $rules[] = [['selectedTags', 'batchGallery', ], 'string'];

        return $rules;
    }

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['selectedCategories'] = 'Категории';
        $labels['selectedTags'] = 'Теги';
        $labels['batchGallery'] = 'Массовое добавление фото';

        return $labels;
    }

    public function afterSave($insert, $changedAttributes){
        parent::afterSave($insert, $changedAttributes);

        $this->setCategories();
        $this->setTags();
    }
    public function afterFind()
    {
        $this->selectedCategories = \yii\helpers\ArrayHelper::getColumn($this->categories, 'id');
        $this->selectedTags = implode(',', \yii\helpers\ArrayHelper::getColumn($this->tags, 'title'));

        parent::afterFind();
    }


    public function getCategoriesList () {
        return \yii\helpers\ArrayHelper::map($this->categories, 'id', 'title');
    }
    private function setCategories() {
        $this->unlinkAll('categories', true);
        if (!empty($this->selectedCategories)) foreach ($this->selectedCategories as $id) {
            $category = CatalogueCategory::findOne($id);
            $this->link('categories', $category);
        }

        return true;
    }

    private function setTags() {
        $this->unlinkAll('tags', true);
        $tags = $this->selectedTags;
        if (!is_array($this->selectedTags)) {
            $tags = explode(',', $this->selectedTags);
        }

        if (!empty($tags)) foreach ($tags as $title) {
            if (!empty($title)) {
                if ( CatalogueTag::find()->where( [ 'title' => $title ] )->exists() )
                    $tag = CatalogueTag::find()->where(['title' => $title])->limit(1)->one();
                else {
                    $tag = new CatalogueTag();
                    $tag->title = $title;
                    $tag->description = '';
                    $tag->priority = 10;
                    $tag->save();
                }

                $this->link('tags', $tag);
            }
        }

        return true;
    }

    private function getImageParams($filePath) {
        $imageSize = [];
        if (file_exists((\Yii::$app->params['frontendFilesRoot'] ?? '') . $filePath)) {
            $imageSize = getimagesize((\Yii::$app->params['frontendFilesRoot'] ?? '') . $filePath);
        }

        return $imageSize;
    }
    public function beforeValidate()
    {
        if ($this->isNewRecord) {
            $this->user_id = \Yii::$app->user->id;
            $this->hits = 0;
            $this->created_at = $this->created_at ?? date('Y-m-d H:i:s');
        }
        $this->updated_at = date('Y-m-d H:i:s');

        $leadImageParams = $this->image_params;
        $leadImageUrl = ArrayHelper::getValue($leadImageParams, 'path');
        if ($leadImageUrl) {
            try {
                list($width, $height, $type, $attr) = $this->getImageParams($leadImageUrl);
                $leadImageParams['width'] = $width;
                $leadImageParams['height'] = $height;
            } catch (\Exception $exception) {}

            $this->image_params = $leadImageParams;
        }

        return parent::beforeValidate();
    }

    const UNPUBLISHED_STATE = 0;
    const PUBLISHED_STATE = 1;
    const STATUSES = [
        self::UNPUBLISHED_STATE => 'Неактивен',
        self::PUBLISHED_STATE => 'Доступен',
    ];


    const GOODS = 1;
    const TYPES = [
        self::GOODS => 'Товары',
    ];
    public function getStatusText() {
        return isset(static::STATUSES[$this->status]) ? static::STATUSES[$this->status] : '-';
    }
    public function getUser() {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
    public function getCategories()
    {
        return $this->hasMany(CatalogueCategory::class, ['id' => 'catalogue_category_id'])->viaTable('catalogue_item_category', ['catalogue_item_id' => 'id']);
    }
    public function getTags()
    {
        return $this->hasMany(CatalogueTag::class, ['id' => 'catalogue_tag_id'])->viaTable('catalogue_item_tag', ['catalogue_item_id' => 'id']);
    }
}
