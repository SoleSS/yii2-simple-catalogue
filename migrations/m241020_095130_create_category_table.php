<?php
namespace soless\catalogue\migrations;
use yii\db\Migration;

/**
 * Handles the creation of table `catalogue_category`.
 */
class m241020_095130_create_category_table extends Migration
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

        $this->createTable('catalogue_category', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull()->comment('Название категории'),
            'description' => $this->text()->comment('Описание категории'),
            'created_at' => $this->datetime()->notNull()->comment('Дата создания'),
            'updated_at' => $this->datetime()->notNull()->comment('Дата обновления'),
        ], $options);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('catalogue_category');
    }
}
