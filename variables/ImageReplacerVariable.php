<?php
namespace Craft;

class ImageReplacerVariable
{
    public function replaceImage($body)
    {
        preg_match_all("/<img src=\"(.*)\"(.*)>/Uis", $body, $images);
        for ($i = 0; $i < count($images[0]); $i++){
            preg_match("/title=\"([a-z0-9A-Z]*)\"/uis", $images[2][$i], $mode);
            if(!empty($mode))
                $mode =  $mode[1];

            preg_match("/alt=\"([^\"]*)\"/uis", $images[2][$i], $alt);
            if(!empty($alt))
                $alt =  $alt[1];
            else
                $alt = "Image";

            $image = $images[1][$i];
            $imageWebP = craft()->imager->transformImage($image, array("mode" => (!empty($mode))?$mode:"letterbox", "webpQuality" => 60, "format" => "webp", "width" => 650, "height" => 150, "position" => "50% 50%"), null, null);
            $imageJpeg = craft()->imager->transformImage($image, array("mode" => (!empty($mode))?$mode:"letterbox", "jpegQuality" => 60, "format" => "jpg", "width" => 650, "height" => 150, "position" => "50% 50%"), null, null);
            $new = "<div class='article_image'><picture><source srcset='" . $imageWebP . "' type='image/webp' /><img src='" . $imageJpeg . "' alt='".$alt."' title='".$alt."'></picture></div>";
            $body = str_replace($images[0][$i], $new, $body);
        }
        return $body;
    }

}