<?php

namespace soless\catalogue\models\base;

use Yii;

/**
 * This is the model class for table "catalogue_item_tag".
 *
 * @property int $catalogue_item_id id Элемента
 * @property int $catalogue_tag_id id Тега
 *
 * @property CatalogueItem $catalogueItem
 * @property CatalogueTag $catalogueTag
 */
class CatalogueItemTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogue_item_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['catalogue_item_id', 'catalogue_tag_id'], 'required'],
            [['catalogue_item_id', 'catalogue_tag_id'], 'default', 'value' => null],
            [['catalogue_item_id', 'catalogue_tag_id'], 'integer'],
            [['catalogue_item_id', 'catalogue_tag_id'], 'unique', 'targetAttribute' => ['catalogue_item_id', 'catalogue_tag_id']],
            [['catalogue_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogueItem::class, 'targetAttribute' => ['catalogue_item_id' => 'id']],
            [['catalogue_tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogueTag::class, 'targetAttribute' => ['catalogue_tag_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'catalogue_item_id' => 'id Элемента',
            'catalogue_tag_id' => 'id Тега',
        ];
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

    /**
     * Gets query for [[CatalogueTag]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogueTag()
    {
        return $this->hasOne(CatalogueTag::class, ['id' => 'catalogue_tag_id']);
    }
}
