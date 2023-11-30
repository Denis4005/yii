<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string $namePost
 * @property string $content
 * @property string $data
 *
 * @property Comments[] $comments
 */
class BasePosts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['namePost', 'content', 'data'], 'required'],
            [['data'], 'safe'],
            [['namePost', 'content'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'namePost' => 'Name Post',
            'content' => 'Content',
            'data' => 'Data',
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::class, ['postId' => 'id']);
    }
}
