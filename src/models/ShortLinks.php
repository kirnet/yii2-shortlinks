<?php

namespace kirnet\shortlinks\models;

use Yii;

/**
 * This is the model class for table "short_links".
 *
 * @property int $id
 * @property string $url
 * @property string $short_url
 * @property int $date_expire
  */
class ShortLinks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'short_links';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'short_url'], 'required'],
            [['date_expire'], 'string'],
            [['url'], 'url'],
            [['short_url'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Url'),
            'short_url' => Yii::t('app', 'Short Url'),
            'date_expire' => Yii::t('app', 'Date Expire'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShortLinksInfos()
    {
        return $this->hasMany(ShortLinksInfo::className(), ['link_id' => 'id']);
    }
}