<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel kirnet\shortlinks\models\ShortLinksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Short Links');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="short-links-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'url:url',
            'short_url:url',
            'date_expire',
            [
              'label' => 'Картинка',
                'format' => 'raw',
                'value' => function($data) {
                    $str = '';
                    foreach ($data->shortLinksInfos as $val) {
                        $str .= $val->info . '<br>';
                    }
                    return $str;
                }
            ],

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>