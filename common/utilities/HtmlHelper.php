<?php
namespace common\utilities;

use yii\bootstrap4\BaseHtml;

class HtmlHelper extends BaseHtml
{
    /**
     * @param $imageName
     * @param string $type
     */
    public static function getImage($imageName, $type = "common")
    {
       if ($type == "common"){
           // mean the image is svg
           if (strpos($imageName, 'svg') !== false) {
               $imagePath = \Yii::getAlias('@common').'/assets/svg' . '/' . $imageName;
           }else{
               $imagePath = \Yii::getAlias('@common').'/assets/img' . '/' . $imageName;
           }
       }else{
           if (strpos($imageName, 'svg') !== false) {
               $imagePath = \Yii::getAlias($type).'/assets/svg' . '/' . $imageName;
           }else{
               $imagePath = \Yii::getAlias($type).'/assets/img' . '/' . $imageName;
           }
       }

        $imageData = base64_encode(file_get_contents($imagePath));

        $src = 'data: '.mime_content_type($imagePath).';base64,'.$imageData;

        echo $src;
    }

    public static function getUploadsImage($imagePath){
        $imageData = base64_encode(file_get_contents($imagePath));

        $src = 'data: '.mime_content_type($imagePath).';base64,'.$imageData;

        echo $src;
    }
    public static function getAudio($file)
    {
        $imagePath = \Yii::getAlias('@student').'/audio' . '/' . $file;

        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $contentType = finfo_file($fileInfo, $imagePath);
        finfo_close($fileInfo);

        $fp = fopen($imagePath, 'r');

        header("Content-Type: " . $contentType);
        header("Content-Length: " . filesize($imagePath));

        ob_end_clean();
        fpassthru($fp);
    }

}