<?php

namespace frontend\modules\api\models;

use common\models\Comments;
use Yii;
/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string $namePost
 * @property string $content
 * @property string $data
 */
class OutputCommentForm extends Comments
{
    public function actionOutputForm(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $articles= Comments::find()->limit(10)->offset(0)->all();

        if (count($articles)> 0) {
            return array('status'=>true,'data'=> $articles);
        } else {
            return array('status'=>false,'data'=> 'No');
        }
    }
}
