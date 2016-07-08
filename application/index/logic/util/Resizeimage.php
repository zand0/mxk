<?
namespace app\index\logic\util;
/*
    ͼƬ�����ࣺ���ԣ��ü���Բ�ǣ���б
*/
class Resizeimage
{
   //ͼƬ����
   var $type;
   //ʵ�ʿ��
   var $width;
   //ʵ�ʸ߶�
   var $height;
   //�ı��Ŀ��
   var $resize_width;
   //�ı��ĸ߶�
   var $resize_height;
   //�Ƿ��ͼ
   var $cut;
   //Դͼ��
   var $srcimg;
   //Ŀ��ͼ���ַ
   var $dstimg;
   //Բ��Դ
   var $corner;
   var $im;

function resizeimage($img, $corner, $wid, $hei,$c, $corner_radius, $angle)
   {
       $this->srcimg = $img;
           $this->corner = $corner;
       $this->resize_width = $wid;
       $this->resize_height = $hei;
       $this->cut = $c;
           $this->corner_radius = $corner_radius;
           $this->angle = $angle;
       //ͼƬ������
       $this->type = substr(strrchr($this->srcimg,"."),1);
       //��ʼ��ͼ��
       $this->initi_img();
       //Ŀ��ͼ���ַ
       $this -> dst_img();
       //--
       $this->width = imagesx($this->im);
       $this->height = imagesy($this->im);
       //����ͼ��
       $this->newimg();
       ImageDestroy ($this->im);
   }
   function newimg()
   {
       //�ı���ͼ��ı���
       $resize_ratio = ($this->resize_width)/($this->resize_height);
       //ʵ��ͼ��ı���
       $ratio = ($this->width)/($this->height);
       if(($this->cut)=="1")
       //��ͼ
       {
           if($ratio>=$resize_ratio)
           //�߶�����
           {
               $newimg = imagecreatetruecolor($this->resize_width,$this->resize_height);
               imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width,$this->resize_height, (($this->height)*$resize_ratio), $this->height);
                           $tmp = $this->rounded_corner($newimg,$this->resize_width);
               imagepng ($tmp,$this->dstimg);
           }
           if($ratio<$resize_ratio)
           //�������
           {
               $newimg = imagecreatetruecolor($this->resize_width,$this->resize_height);
               imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width, $this->resize_height, $this->width, (($this->width)/$resize_ratio));
                           $tmp = $this->rounded_corner($newimg);
               imagepng ($tmp,$this->dstimg);
           }
       }
       else
       //����ͼ
       {
           if($ratio>=$resize_ratio)
           {
               $newimg = imagecreatetruecolor($this->resize_width,($this->resize_width)/$ratio);
               imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $this->resize_width, ($this->resize_width)/$ratio, $this->width, $this->height);
               ImageJpeg ($newimg,$this->dstimg);
           }
           if($ratio<$resize_ratio)
           {
               $newimg = imagecreatetruecolor(($this->resize_height)*$ratio,$this->resize_height);
               imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, ($this->resize_height)*$ratio, $this->resize_height, $this->width, $this->height);
               ImageJpeg ($newimg,$this->dstimg);
           }
       }
   }
   //��ʼ��ͼ��
   function initi_img()
   {
       if($this->type=="jpg")
       {
           $this->im = imagecreatefromjpeg($this->srcimg);
       }
       if($this->type=="gif")
       {
           $this->im = imagecreatefromgif($this->srcimg);
       }
       if($this->type=="png")
       {
           $this->im = imagecreatefrompng($this->srcimg);
       }
   }

   //����Բ��
   function rounded_corner($image,$size)
   {
                $topleft = true;
                $bottomleft = true;
                $bottomright = true;
                $topright = true;
                $corner_source = imagecreatefrompng('rounded_corner.png');
                $corner_width = imagesx($corner_source);  
                $corner_height = imagesy($corner_source);  
                $corner_resized = ImageCreateTrueColor($this->corner_radius, $this->corner_radius);
                ImageCopyResampled($corner_resized, $corner_source, 0, 0, 0, 0, $this->corner_radius, $this->corner_radius, $corner_width, $corner_height);
                $corner_width = imagesx($corner_resized);  
                $corner_height = imagesy($corner_resized);  
                $white = ImageColorAllocate($image,255,255,255);
                $black = ImageColorAllocate($image,0,0,0);

                //������Բ��
                if ($topleft == true) {
                        $dest_x = 0;  
                        $dest_y = 0;  
                        imagecolortransparent($corner_resized, $black); 
                        imagecopymerge($image, $corner_resized, $dest_x, $dest_y, 0, 0, $corner_width, $corner_height, 100);
                } 

                //�²���Բ��
                if ($bottomleft == true) {
                        $dest_x = 0;  
                        $dest_y = $size - $corner_height; 
                        $rotated = imagerotate($corner_resized, 90, 0);
                        imagecolortransparent($rotated, $black); 
                        imagecopymerge($image, $rotated, $dest_x, $dest_y, 0, 0, $corner_width, $corner_height, 100);  
                }

                //�²���Բ��
                if ($bottomright == true) {
                        $dest_x = $size - $corner_width;  
                        $dest_y = $size - $corner_height;  
                        $rotated = imagerotate($corner_resized, 180, 0);
                        imagecolortransparent($rotated, $black); 
                        imagecopymerge($image, $rotated, $dest_x, $dest_y, 0, 0, $corner_width, $corner_height, 100);  
                }

                //������Բ��
                if ($topright == true) {
                        $dest_x = $size - $corner_width;  
                        $dest_y = 0;
                        $rotated = imagerotate($corner_resized, 270, 0);
                        imagecolortransparent($rotated, $black); 
                        imagecopymerge($image, $rotated, $dest_x, $dest_y, 0, 0, $corner_width, $corner_height, 100);  
                }
                $image = imagerotate($image, $this->angle, $white);
                return $image; 
   }

   //ͼ��Ŀ���ַ
   function dst_img()
   {
       $full_length = strlen($this->srcimg);
       $type_length = strlen($this->type);
       $name_length = $full_length-$type_length;
       $name         = substr($this->srcimg,0,$name_length-1);
       $this->dstimg = $name."_small.png";
   }
}
