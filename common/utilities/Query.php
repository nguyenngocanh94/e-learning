<?php


namespace common\utilities;


class Query
{
    private function __construct()
    {
    }

    /**
     * @var Query
     */
    private static $instance = null;

    public static function getInstance(){
        if (self::$instance == null)
        {
            self::$instance = new Query();
        }

        return self::$instance;
    }

    /**
     * @param $queryFile
     * @param $arrayParam
     * @return array
     * @throws \yii\db\Exception
     */
    public function query($queryFile, $arrayParam){
        $connection = \Yii::$app->getDb();
        $command = $connection->createCommand(self::getContent($queryFile), $arrayParam);

        return $command->queryAll();
    }

    /**
     * @param $sqlFileName
     * @return false|string
     */
    public static function getContent($sqlFileName){
        $prefix = \Yii::getAlias("@sql");
        $fileContent = file_get_contents($prefix.'/'.$sqlFileName);

        return $fileContent;
    }
}