<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin( [
    'id'     => 'short_link',
    'action' => '/shortlinks/edit'
    //'layout' => 'horizontal',
] ); ?>

<?= $form->field( $shortLinks, 'url' )->textInput( [ 'autofocus' => true ] ) ?>
<?= $form->field( $shortLinks, 'short_url' )->textInput( [ 'readonly' => true ] ) ?>
<?= yii\jui\DatePicker::widget( [
    'name' => 'ShortLinks[date_expire]',
    'dateFormat' => 'yyyy-MM-dd',
    'options' => ['class' => 'form-control']
] ) ?>

    <div class="form-group">
        <?= Html::button(
            Yii::t( 'app', 'Generate' ),
            [ 'name' => 'generate', 'id' => 'generate_button' ]
        ) ?>
        <?= Html::submitButton(
            Yii::t( 'app', 'Save' ),
            [ 'class' => 'btn btn-primary', 'name' => 'save' ] )
        ?>

    </div>

<?php ActiveForm::end(); ?>