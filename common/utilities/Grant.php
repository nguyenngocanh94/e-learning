<?php
/**
 * Created by PhpStorm.
 * User: VNUSER
 * Date: 4/18/2019
 * Time: 5:42 PM
 */

namespace common\utilities;


class Grant
{
    public static function check($className, $id){
        $res = call_user_func($className .'::findOne('.$id.')->');
        if ((\Yii::$app->user->getId() == $res->create_id)
            or (\Yii::$app->user->getId() == $res->update_id)){
            return true;
        }

        return false;
    }

    public static function checkModel($model){
        $user_id = \Yii::$app->user->getId();
        if (($model->create_by ==$user_id) || ($model->update_by ==$user_id)){
            return true;
        }

        return false;
    }

}