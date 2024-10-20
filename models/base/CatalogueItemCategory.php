<?php

namespace soless\catalogue\models\base;

use Yii;

/**
 * This is the model class for table "catalogue_item_category".
 *
 * @property int $catalogue_item_id id Элемента
 * @property int $catalogue_category_id id Категории
 *
 * @property CatalogueCategory $catalogueCategory
 * @property CatalogueItem $catalogueItem
 */
class CatalogueItemCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogue_item_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['catalogue_item_id', 'catalogue_category_id'], 'required'],
            [['catalogue_item_id', 'catalogue_category_id'], 'default', 'value' => null],
            [['catalogue_item_id', 'catalogue_category_id'], 'integer'],
            [['catalogue_item_id', 'catalogue_category_id'], 'unique', 'targetAttribute' => ['catalogue_item_id', 'catalogue_category_id']],
            [['catalogue_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogueCategory::class, 'targetAttribute' => ['catalogue_category_id' => 'id']],
            [['catalogue_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogueItem::class, 'targetAttribute' => ['catalogue_item_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'catalogue_item_id' => 'id Элемента',
            'catalogue_category_id' => 'id Категории',
        ];
    }

    /**
     * Gets query for [[CatalogueCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogueCategory()
    {
        return $this->hasOne(CatalogueCategory::class, ['id' => 'catalogue_category_id']);
    }

    /**
     * Gets query for [[CatalogueItem]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogueItem()
    {
        return $this->hasOne(CatalogueItem::class, ['id' => 'catalogue_item_id']);
    }
}
