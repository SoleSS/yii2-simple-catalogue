<?php

namespace soless\catalogue\models\base;

use Yii;

/**
 * This is the model class for table "catalogue_category".
 *
 * @property int $id
 * @property string $title Название категории
 * @property string|null $description Описание категории
 * @property string $created_at Дата создания
 * @property string $updated_at Дата обновления
 */
class CatalogueCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogue_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'created_at', 'updated_at'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название категории',
            'description' => 'Описание категории',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }
}
