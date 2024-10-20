<?php

namespace soless\catalogue\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `catalogue_tag`.
 */
class m241020_095930_create_catalogue_tag_table extends Migration
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

        $this->createTable('catalogue_tag', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull()->comment('Наименование'),
            'description' => $this->text()->comment('Описание'),
            'priority' => $this->integer(2)->notNull()->defaultValue(10)->comment('Приоритет'),
            'created_at' => $this->datetime()->notNull()->comment('Дата создания'),
            'updated_at' => $this->datetime()->notNull()->comment('Дата обновления'),
        ], $options);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('catalogue_tag');
    }
}
