<?php

namespace kirnet\shortlinks\models;

use Yii;

/**
 * This is the model class for table "short_links_info".
 *
 * @property int $id
 * @property string $info
 * @property int $link_id
 *
 * @property ShortLinks $link
 */
class ShortLinksInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'short_links_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['info', 'link_id'], 'required'],
            [['info'], 'string'],
            [['link_id'], 'integer'],
            [
                ['link_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => ShortLinks::className(),
                'targetAttribute' => ['link_id' => 'id']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'info' => Yii::t('app', 'Info'),
            'link_id' => Yii::t('app', 'Link ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLink()
    {
        return $this->hasOne(ShortLinks::className(), ['id' => 'link_id']);
    }
}