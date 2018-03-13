<?php 
    


    //文字图片 合成
    public function strToimg()
    {
        header("Content-type:text/html;charset=utf-8");
        $bigImgPath = "图片的路径";
        
        $img = imagecreatefromstring(file_get_contents($bigImgPath));
     
        $font = './Public/fonts/SIMHEI.TTF';//字体


        $black = imagecolorallocate($img,205 ,38, 38);//字体颜色 RGB
            $fontSize = 35;   //字体大小
            $left = 250;      //左边距
            $top = 110;       //顶边距
        
    
        
        imagefttext($img, $fontSize, $circleSize, $left, $top, $black, $font, $str);
       
     
        list($bgWidth, $bgHight, $bgType) = getimagesize($bigImgPath);

        
        switch ($bgType) {
            case 1: //gif
                header('Content-Type:image/gif');
                return imagegif($img,$img_name);
                break;
            case 2: //jpg
                header('Content-Type:image/jpg');
                return imagejpeg($img,$img_name);
                break;
            case 3: //jpg
                header('Content-Type:image/png');
                return imagepng($img,$img_name);
                break;
            default:
                break;
        }
        imagedestroy($img);
        
    }
?>

