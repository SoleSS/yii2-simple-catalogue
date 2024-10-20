Yii2 tag editor widget (fork of tolik505/yii2-tag-editor)
=====================
Widget for tags adding. Based on https://goodies.pixabay.com/jquery/tag-editor/demo.html

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist soless/yii2-tag-editor "*"
```

or add

```
"soless/yii2-tag-editor": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= $form->field($model, 'tags')->widget(TagEditor::className(), [
        'tagEditorOptions' => [
            'autocomplete' => [
                'source' => Url::toRoute(['route/to/get-tags-action'])
            ],
        ]
    ]) ?>```
