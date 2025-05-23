<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \mihaildev\elfinder\InputFile;
use \mihaildev\elfinder\ElFinder;
use \mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model soless\catalogue\models\CatalogueCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cms-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
            'preset' => 'basic',
            'inline' => false,
            'height' => '100px',
            'allowedContent' => false,
            'removePlugins' => 'image',
        ]),
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
