<?php

namespace frontend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "student".
 *
 * @property int $student
 * @property int $userId
 * @property string $fullName
 * @property int $idNumber
 * @property string $regNo
 *
 * @property Borrowedbook[] $borrowedbooks
 * @property User $user
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'fullName', 'idNumber', 'regNo'], 'required'],
            [['userId', 'idNumber'], 'integer'],
            [['fullName', 'regNo'], 'string', 'max' => 255],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'student' => 'Student',
            'userId' => 'User ID',
            'fullName' => 'Full Name',
            'idNumber' => 'Id Number',
            'regNo' => 'Reg No',
        ];
    }

    /**
     * Gets query for [[Borrowedbooks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBorrowedbooks()
    {
        return $this->hasMany(Borrowedbook::className(), ['studentId' => 'student']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
}
