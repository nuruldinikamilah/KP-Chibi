<?php
function ResizeImage($img, $width, $height, $copy) {
      $inf = pathinfo($img);
      $ext = strtolower($inf["extension"]);

      if(in_array($ext, array("jpg", "jpeg")))
      $gbr = imagecreatefromjpeg($img);
      
      if($ext == "png")
      $gbr = imagecreatefrompng($img);
      
      if($ext == "wbmp")
      $gbr = imagecreatefromwbmp($img);
      
      if($ext == "bmp")
      $gbr = imagecreatefrombmp($img);
      
      if($ext == "gif")
      $gbr = imagecreatefromgif($img);
      
      if(!$gbr) return $img;
      
      $awd = imageSX($gbr);
        $ahg = imageSY($gbr);
        $bwd = $width;
        $bhg = $height;
        
        if($bwd && !$bhg)
        $bhg = (int) ($bwd / $awd * $ahg);
        
        if(!$bwd && $bhg)
        $bwd = (int) ($bhg / $ahg * $awd);
        
        if($bwd >= $awd) {
          imagedestroy($gbr);
          return $img;    
        }
        
        if($bhg >= $ahg) {
          imagedestroy($gbr);
          return $img;    
        }
        
        $cop = imagecreatetruecolor($bwd, $bhg);
        imagecopyresampled($cop, $gbr, 0, 0, 0, 0, $bwd, $bhg, $awd, $ahg);
        if($copy)
        $img = str_replace(".$ext",  "_".$bwd."x".$bhg.".$ext", $img);
      
      if(in_array($ext, array("jpg", "jpeg")))
        imagejpeg($cop, $img);
        
        if($ext == "png")
        imagepng($cop, $img);
        
        if($ext == "gif")
        imagegif($cop, $img);
        
        if($ext == "wbmp")
        imagewbmp($cop, $img);
        
        if($ext == "bmp") {
            $img = str_replace(".bmp", ".jpg", $img);
          imagejpeg($cop, $img);
      }
        
        imagedestroy($gbr);
        imagedestroy($cop);
        
        return $img;
  } 
?>