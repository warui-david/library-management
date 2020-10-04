<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "bookauthor".
 *
 * @property int $baId
 * @property int $authorId
 * @property int $bookId
 *
 * @property Book $book
 * @property Author $author
 */
class Bookauthor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bookauthor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['authorId', 'bookId'], 'required'],
            [['authorId', 'bookId'], 'integer'],
            [['bookId'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['bookId' => 'bookId']],
            [['authorId'], 'exist', 'skipOnError' => true, 'targetClass' => Author::className(), 'targetAttribute' => ['authorId' => 'authorId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'baId' => 'Ba ID',
            'authorId' => 'Author ID',
            'bookId' => 'Book ID',
        ];
    }

    /**
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['bookId' => 'bookId']);
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['authorId' => 'authorId']);
    }
}
