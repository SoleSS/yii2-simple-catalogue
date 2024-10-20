<?php

namespace soless\catalogue\models\base;

use Yii;

/**
 * This is the model class for table "catalogue_tag".
 *
 * @property int $id
 * @property string $title Наименование
 * @property string|null $description Описание
 * @property int $priority Приоритет
 * @property string $created_at Дата создания
 * @property string $updated_at Дата обновления
 */
class CatalogueTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogue_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'created_at', 'updated_at'], 'required'],
            [['description'], 'string'],
            [['priority'], 'default', 'value' => null],
            [['priority'], 'integer'],
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
            'title' => 'Наименование',
            'description' => 'Описание',
            'priority' => 'Приоритет',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }
}
