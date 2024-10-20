<?php

namespace soless\catalogue\models;

/**
 * This is the model class for table "catalogue_item".
 *
 * @property int $id
 * @property string $title Наименование
 * @property string|null $title_lng1 Наименование (язык #1)
 * @property string|null $title_lng2 Наименование (язык #2)
 * @property int $type_id Тип
 * @property string|null $subtitle Подзаголовок
 * @property string|null $subtitle_lng1 Подзаголовок (язык #1)
 * @property string|null $subtitle_lng2 Подзаголовок (язык #2)
 * @property string|null $image_params Параметры лид-изображения
 * @property bool $show_image Отображать изображение?
 * @property string $intro Краткое описание
 * @property string|null $intro_lng1 Краткое описание (язык #1)
 * @property string|null $intro_lng2 Краткое описание (язык #2)
 * @property string $full Полное описание
 * @property string|null $full_lng1 Полное описание (язык #1)
 * @property string|null $full_lng2 Полное описание (язык #2)
 * @property string|null $amp_full Полное описание (AMP версия)
 * @property string|null $amp_full_lng1 Полное описание (AMP версия) (язык #1)
 * @property string|null $amp_full_lng2 Полное описание (AMP версия) (язык #2)
 * @property int|null $base_price_value Базовая цена x100
 * @property string|null $price_params Параметры цены
 * @property int|null $status Статус записи
 * @property string $publish_up Дата начала публикации
 * @property string $publish_down Дата окончания публикации
 * @property int|null $user_id id Автора
 * @property string|null $user_alias Алиас автора
 * @property string|null $meta_keywords Meta keywords
 * @property string|null $meta_description Meta description
 * @property int $hits Кол-во просмотров
 * @property string|null $medias Медиа контент
 * @property string|null $gallery Галерея
 * @property string $created_at Дата создания
 * @property string $updated_at Дата обновления
 * @property string|null $params Дополнительные параметры
 * @property int $priority Приоритет
 * @property string|null $promo_image_params Параметры промо-изображения
 * @property string|null $carousel_params Параметры карусели
 * @property string|null $carousel_slides Слайды карусели
 * @property string|null $custom_params Специальные параметры
 */
class CatalogueItem extends base\CatalogueItem
{

}
