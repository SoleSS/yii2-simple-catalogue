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
    public function beforeValidate()
    {
        if ($this->isNewRecord) {
            $this->user_id = \Yii::$app->user->id;
            $this->created_at = $this->created_at ?? date('Y-m-d H:i:s');
        }
        $this->updated_at = date('Y-m-d H:i:s');

        return parent::beforeValidate();
    }
    public static function asArray() {
        return \yii\helpers\ArrayHelper::map(static::find()->select(['id', 'title'])->asArray()->all(), 'id', 'title');
    }
}
