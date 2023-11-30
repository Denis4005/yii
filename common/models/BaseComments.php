<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property string $authorName
 * @property int $postId
 * @property string $content
 *
 * @property User $authorName0
 * @property Posts $post
 */
class BaseComments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['authorName', 'postId', 'content'], 'required'],
            [['postId'], 'integer'],
            [['authorName', 'content'], 'string', 'max' => 255],
            [['authorName'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['authorName' => 'username']],
            [['postId'], 'exist', 'skipOnError' => true, 'targetClass' => Posts::class, 'targetAttribute' => ['postId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'authorName' => 'Author Name',
            'postId' => 'Post ID',
            'content' => 'Content',
        ];
    }

    /**
     * Gets query for [[AuthorName0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorName0()
    {
        return $this->hasOne(User::class, ['username' => 'authorName']);
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Posts::class, ['id' => 'postId']);
    }
}
