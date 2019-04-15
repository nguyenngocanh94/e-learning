<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@student', dirname(dirname(__DIR__)) . '/student');
Yii::setAlias('@teacher', dirname(dirname(__DIR__)) . '/teacher');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@module', dirname(dirname(__DIR__)) . '/module');
Yii::setAlias('@uploads', dirname(dirname(__DIR__)).'/uploads');
Yii::setAlias('@sql', dirname(dirname(__DIR__)).'/sql');

// config for usage

Yii::setAlias('@site', 'Hóa học trực tuyến');
