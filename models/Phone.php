<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "phone".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $phone
 *
 * @property Client $client
 */
class Phone extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phone';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'phone'], 'required'],
            [['uid'], 'integer'],
            [['phone'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Пользователь',
            'phone' => 'Телефон',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'uid']);
    }
}
