<?php

namespace soless\catalogue\models;

/**
 * This is the model class for table "catalogue_category".
 *
 * @property int $id
 * @property string $title Название категории
 * @property string|null $description Описание категории
 * @property string $created_at Дата создания
 * @property string $updated_at Дата обновления
 */
class CatalogueCategory extends base\CatalogueCategory
{
    public static function asArray() {
        return \yii\helpers\ArrayHelper::map(static::find()->select(['id', 'title'])->asArray()->all(), 'id', 'title');
    }
}
