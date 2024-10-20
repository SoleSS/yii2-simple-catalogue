<?php
use yii\db\Migration;

class m241020_100030_create_catalogue_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $options = null;
        if ($this->db->driverName === 'mysql') {
            $options = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('catalogue_item', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull()->comment('Наименование'),
            'title_lng1' => $this->string(255)->comment('Наименование (язык #1)'),
            'title_lng2' => $this->string(255)->comment('Наименование (язык #2)'),
            'type_id' => $this->integer(2)->notNull()->defaultValue(1)->comment('Тип'),
            'subtitle' => $this->string(255)->comment('Подзаголовок'),
            'subtitle_lng1' => $this->string(255)->comment('Подзаголовок (язык #1)'),
            'subtitle_lng2' => $this->string(255)->comment('Подзаголовок (язык #2)'),
            'image_params' => $this->json()->comment('Параметры лид-изображения'),
            'show_image' => $this->boolean()->notNull()->defaultValue(false)->comment('Отображать изображение?'),
            'intro' => $this->string(1024)->notNull()->comment('Краткое описание'),
            'intro_lng1' => $this->string(1024)->comment('Краткое описание (язык #1)'),
            'intro_lng2' => $this->string(1024)->comment('Краткое описание (язык #2)'),
            'full' => $this->text()->notNull()->comment('Полное описание'),
            'full_lng1' => $this->text()->comment('Полное описание (язык #1)'),
            'full_lng2' => $this->text()->comment('Полное описание (язык #2)'),
            'amp_full' => $this->text()->comment('Полное описание (AMP версия)'),
            'amp_full_lng1' => $this->text()->comment('Полное описание (AMP версия) (язык #1)'),
            'amp_full_lng2' => $this->text()->comment('Полное описание (AMP версия) (язык #2)'),
            'base_price_value' => $this->integer()->defaultValue(0)->comment('Базовая цена x100'),
            'price_params' => $this->json()->comment('Параметры цены'),
            'status' => $this->integer()->defaultValue(0)->comment('Статус записи'),
            'publish_up' => $this->datetime()->notNull()->comment('Дата начала публикации'),
            'publish_down' => $this->datetime()->notNull()->comment('Дата окончания публикации'),
            'user_id' => $this->integer()->comment('id Автора'),
            'user_alias' => $this->string(255)->comment('Алиас автора'),
            'meta_keywords' => $this->string(1024)->comment('Meta keywords'),
            'meta_description' => $this->string(2048)->comment('Meta description'),
            'hits' => $this->integer()->notNull()->defaultValue(0)->comment('Кол-во просмотров'),
            'medias' => $this->json()->comment('Медиа контент'),
            'gallery' => $this->json()->comment('Галерея'),
            'created_at' => $this->datetime()->notNull()->comment('Дата создания'),
            'updated_at' => $this->datetime()->notNull()->comment('Дата обновления'),
            'params' => $this->json()->comment('Дополнительные параметры'),
            'priority' => $this->integer(3)->defaultValue(500)->notNull()->comment('Приоритет'),
            'promo_image_params' => $this->json()->comment('Параметры промо-изображения'),
            'carousel_params' => $this->json()->comment('Параметры карусели'),
            'carousel_slides' => $this->json()->comment('Слайды карусели'),
            'custom_params' => $this->json()->comment('Специальные параметры'),
        ], $options);

        $this->createIndex('idx-catalogue_item-type_id', 'catalogue_item', 'type_id');
        $this->createIndex('idx-catalogue_item-base_price_value', 'catalogue_item', 'base_price_value');
        $this->createIndex('idx-catalogue_item-status', 'catalogue_item', 'status');
        $this->createIndex('idx-catalogue_item-publish_up', 'catalogue_item', 'publish_up');
        $this->createIndex('idx-catalogue_item-publish_down', 'catalogue_item', 'publish_down');
        $this->createIndex('idx-catalogue_item-user_id', 'catalogue_item', 'user_id');
        $this->createIndex('idx-catalogue_item-user_alias', 'catalogue_item', 'user_alias');
        $this->createIndex('idx-catalogue_item-hits', 'catalogue_item', 'hits');
        $this->createIndex('idx-catalogue_item-created_at', 'catalogue_item', 'created_at');
        $this->createIndex('idx-catalogue_item-updated_at', 'catalogue_item', 'updated_at');
        $this->createIndex('idx-catalogue_item-priority', 'catalogue_item', 'priority');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('catalogue_item');
    }
}
