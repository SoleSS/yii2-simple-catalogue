<?php
use yii\db\Migration;

class m241020_111200_create_relation_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('catalogue_item_category', [
            'catalogue_item_id' => $this->integer()->notNull()->comment('id Элемента'),
            'catalogues_category_id' => $this->integer()->notNull()->comment('id Категории'),
            'PRIMARY KEY(catalogues_category_id, catalogue_item_id)',
        ]);

        $this->createIndex('idx-catalogue_item_category-catalogue_item_id', 'catalogue_item_category', 'catalogue_item_id');
        $this->createIndex('idx-catalogue_item_category-catalogues_category_id', 'catalogue_item_category', 'catalogue_category_id');

        $this->createTable('catalogue_item_tag', [
            'catalogue_item_id' => $this->integer()->notNull()->comment('id Элемента'),
            'catalogue_tag_id' => $this->integer()->notNull()->comment('id Тега'),
            'PRIMARY KEY(catalogue_item_id, catalogue_tag_id)',
        ]);

        $this->createIndex('idx-catalogue_item_tag-catalogue_item_id', 'catalogue_item_tag', 'catalogue_item_id');
        $this->createIndex('idx-catalogue_item_tag-catalogue_tag_id', 'catalogue_item_tag', 'catalogue_tag_id');



        $this->addForeignKey('fk-catalogue_item_category-catalogue_item_id', 'catalogue_item_category', 'catalogue_item_id', 'catalogue_item', 'id', 'CASCADE');
        $this->addForeignKey('fk-catalogue_item_category-catalogue_category_id', 'catalogue_item_category', 'catalogue_category_id', 'catalogue_category', 'id', 'CASCADE');

        $this->addForeignKey('fk-catalogue_item_tag-catalogue_item_id', 'catalogue_item_tag', 'catalogue_item_id', 'catalogue_item', 'id', 'CASCADE');
        $this->addForeignKey('fk-catalogue_item_tag-catalogue_tag_id', 'catalogue_item_tag', 'catalogue_tag_id', 'catalogue_tag', 'id', 'CASCADE');

        $this->addForeignKey('fk-catalogue_item-user_id', 'catalogue_item', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-cms_article-user_id', 'cms_article');

        $this->dropForeignKey('fk-cms_article_category-cms_article_id', 'cms_article_category');
        $this->dropForeignKey('fk-cms_article_category-cms_category_id', 'cms_article_category');

        $this->dropForeignKey('fk-cms_article_tag-cms_article_id', 'cms_article_tag');
        $this->dropForeignKey('fk-cms_article_tag-cms_tag_id', 'cms_article_tag');

        $this->dropForeignKey('fk-cms_article_related-cms_article_id', 'cms_article_related');
        $this->dropForeignKey('fk-cms_article_related-cms_tag_id', 'cms_article_related');

        $this->dropTable('cms_article_category');
        $this->dropTable('cms_article_related');
        $this->dropTable('cms_article_tag');
    }
}
