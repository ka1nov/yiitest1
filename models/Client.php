<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property integer $id
 * @property string $name
 * @property string $last_name
 * @property integer $second_name
 * @property string $date_birth
 * @property integer $sex
 * @property string $date_create
 * @property string $date_change
 *
 * @property Phone $id0
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'last_name', 'second_name', 'date_birth', 'sex'], 'required'],
            [['sex'], 'integer'],
            [['date_birth', 'date_create', 'date_change'], 'safe'],
            [['name', 'last_name', 'second_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'last_name' => 'Фамилия',
            'second_name' => 'Отчество',
            'date_birth' => 'Дата рождения',
            'sex' => 'Пол',
            'sex_text' => 'Пол',
            'date_create' => 'Дата создания',
            'date_change' => 'Дата изменения',
            'phones' => 'Телефоны',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhone()
    {
        return $this->hasMany(Phone::className(), ['uid' => 'id']);
    }
    
    public function getSex_text() {
        return $this->sex ? 'Мужской' : 'Женский';
    }
    
    public function getPhones()
    {
        $ar = [];
        foreach ($this->phone as $phone) {
            $ar[] = $phone->phone;
        }
        return implode("<br/>\n", $ar);
    }
    
    public function setPhones($phones)
    {
        $this->phones = $phones;
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) { 
            if ($insert) unset($this->id);
            unset($this->date_create);
            unset($this->date_change);
            $date = date('Y-m-d H:i:s');
            if ($insert) $this->date_create = $date;
            $this->date_change = $date;
            return true;
        }
        return false;
    }
    
    public function afterSave($insert, $changedAttributes)
    {
        $uid = $this->id;
        $phones = Yii::$app->request->post('Client')['phone'];
        Phone::deleteAll("uid = $uid");
        foreach ($phones as $phone) {
            $p = new Phone();
            $p->uid = $uid;
            $p->phone = $phone;
            $p->save();
        }
    }

}
