<?php

function echodebug($data, $exit = false)
{
    echo '<div style="background:#FFF">';
    echo '<pre>';
    if (is_bool($data)) {
        var_dump($data);
    } else {
        print_r($data);
    }
    echo '</pre>';
    echo '</div>';
    if ($exit)
        exit;
}

function seourl($text)
{
    $text = str_replace(
            array('“', '”', ' - ', '.', ' ', '|', '"', '%', "/", "\\", '"', '?', '<', '>', "#", "^", "`", "'", "=", "!", ":", ",,", "..", "*", "&", "__", "▄", ',', '(', ')'), array('-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', "-", "", "", '-', '-', '-'), $text);

    $chars = array("a", "A", "e", "E", "o", "O", "u", "U", "i", "I", "d", "D", "y", "Y");
    $uni[0] = array("á", "à", "ạ", "ả", "ã", "â", "ấ", "ầ", "ậ", "ẩ", "ẫ", "ă", "ắ", "ằ", "ặ", "ẳ", "ẵ", "� �");
    $uni[1] = array("Á", "À", "Ạ", "Ả", "Ã", "Â", "Ấ", "Ầ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ắ", "Ằ", "Ặ", "Ẳ", "� �");
    $uni[2] = array("é", "è", "ẹ", "ẻ", "ẽ", "ê", "ế", "ề", "ệ", "ể", "ễ");
    $uni[3] = array("É", "È", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ế", "Ề", "Ệ", "Ể", "Ễ");
    $uni[4] = array("ó", "ò", "ọ", "ỏ", "õ", "ô", "ố", "ồ", "ộ", "ổ", "ỗ", "ơ", "ớ", "ờ", "ợ", "ở", "ỡ", "� �");
    $uni[5] = array("Ó", "Ò", "Ọ", "Ỏ", "Õ", "Ô", "Ố", "Ồ", "Ộ", "Ổ", "Ỗ", "Ơ", "Ớ", "Ờ", "Ợ", "Ở", "� �");
    $uni[6] = array("ú", "ù", "ụ", "ủ", "ũ", "ư", "ứ", "ừ", "ự", "ử", "ữ");
    $uni[7] = array("Ú", "Ù", "Ụ", "Ủ", "Ũ", "Ư", "Ứ", "Ừ", "Ự", "Ử", "Ữ");
    $uni[8] = array("í", "ì", "ị", "ỉ", "ĩ");
    $uni[9] = array("Í", "Ì", "Ị", "Ỉ", "Ĩ");
    $uni[10] = array("đ");
    $uni[11] = array("Đ");
    $uni[12] = array("ý", "ỳ", "ỵ", "ỷ", "ỹ");
    $uni[13] = array("Ý", "Ỳ", "Ỵ", "Ỷ", "Ỹ");
    for ($i = 0; $i <= 13; $i++) {
        $text = str_replace($uni[$i], $chars[$i], $text);
    }
    $text = strtolower($text);
    $text = preg_replace('/[^a-z\-0-9]/i', '-', $text);
    $text = preg_replace('/\-+/i', '-', trim($text, '- '));
    return $text;
}
function stripUnicode($str)
{
    if (!$str)
        return false;
    $unicode = array(
        'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
        'd' => 'đ',
        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'i' => 'í|ì|ỉ|ĩ|ị',
        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
    );
    foreach ($unicode as $nonUnicode => $uni)
        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
    return $str;
}


function rmkdir($dir = "", $chmod = 0777, $path_folder = "uploads")
{

    $dir = str_replace('public/' . $path_folder, '', $dir);

    $chmod = ($chmod == 'auto') ? 0777 : $chmod;
    $arr_allow = array("uploads", "thumbs", "thumbs_size");

    $path_folder = (in_array($path_folder, $arr_allow)) ? $path_folder : 'uploads';
    $path = SITE_PATH . 'public/' . $path_folder;
    $path = rtrim(preg_replace(array("/\\\\/", "/\/{2,}/"), "/", $path), "/");

    if (is_dir($path . '/' . $dir) && file_exists($path . '/' . $dir)) {
        return true;
    }

    $path_thumbs = $path . '/' . $dir;
    $path_thumbs = rtrim(preg_replace(array("/\\\\/", "/\/{2,}/"), "/", $path_thumbs), "/");

    $oldumask = umask(0);
    if ($path && !file_exists($path)) {
        mkdir($path, $chmod, true); // or even 01777 so you get the sticky bit set 
    }
    if ($path_thumbs && !file_exists($path_thumbs)) {
        mkdir($path_thumbs, $chmod, true);
        //mkdir($path_thumbs, $chmod, true) or die("$path_thumbs cannot be found"); // or even 01777 so you get the sticky bit set 
    }
    umask($oldumask);

    return true;
}

/**
 * thumbs
 *
 * @params  string  
 * @params  string   
 *
 * @return
 */
function thumbs($imgfile = "", $path, $maxWidth, $maxHeight = "", $crop = 0, $arrMore = array())
{

    if ($maxHeight == "") {
        $maxHeight = $maxWidth;
    }

    $info = @getimagesize($imgfile);
    $mime = $info[2];
    $fext = ($mime == 1 ? 'image/gif' : ($mime == 2 ? 'image/jpeg' : ($mime == 3 ? 'image/png' : NULL)));
    switch ($fext) {
        case 'image/jpeg':
            if (!function_exists('imagecreatefromjpeg')) {
                die('No create from JPEG support');
            } else {
                $img['src'] = @imagecreatefromjpeg($imgfile);
            }
            break;
        case 'image/png':
            if (!function_exists('imagecreatefrompng')) {
                die("No create from PNG support");
            } else {
                $img['src'] = @imagecreatefrompng($imgfile);
            }
            break;
        case 'image/gif':
            if (!function_exists('imagecreatefromgif')) {
                die("No create from GIF support");
            } else {
                $img['src'] = @imagecreatefromgif($imgfile);
            }
            break;
    }
    $img['old_w'] = @imagesx($img['src']);
    $img['old_h'] = @imagesy($img['src']);

    if ($crop != 0) {
        // Ratio cropping
        $offsetX = 0;
        $offsetY = 0;


        $cropRatio = explode(':', $crop);
        if (count($cropRatio) == 2) {
            $ratioComputed = $img['old_w'] / $img['old_h'];
            $cropRatioComputed = (float) $cropRatio[0] / (float) $cropRatio[1];

            if ($ratioComputed < $cropRatioComputed) { // Image is too tall so we will crop the top and bottom
                $origHeight = $img['old_h'];
                $height = $img['old_w'] / $cropRatioComputed;
                $offsetY = ($origHeight - $img['old_h']) / 2;
            } else if ($ratioComputed > $cropRatioComputed) { // Image is too wide so we will crop off the left and right sides
                $origWidth = $img['old_w'];
                $width = $img['old_h'] * $cropRatioComputed;
                $offsetX = ($origWidth - $img['old_w']) / 2;
            }
        }

        // Setting up the ratios needed for resizing. We will compare these below to determine how to
        // resize the image (based on height or based on width)
        $xRatio = $maxWidth / $img['old_w'];
        $yRatio = $maxHeight / $img['old_h'];

        if ($xRatio * $img['old_h'] < $maxHeight) { // Resize the image based on width
            $new_h = ceil($xRatio * $img['old_h']);
            $new_w = $maxWidth;
        } else { // Resize the image based on height
            $new_w = ceil($yRatio * $img['old_w']);
            $new_h = $maxHeight;
        }
    } else {
        $new_h = $img['old_h'];
        $new_w = $img['old_w'];
        $offsetX = 0;
        $offsetY = 0;
        $tl_old = $img['old_w'] / $img['old_h'];
        $tl_new = 1;
        if ($maxHeight != 'auto') {
            $tl_new = $maxWidth / $maxHeight;
        }

        if (isset($arrMore["fixWidth"])) {
            $new_w = $maxWidth;
            $new_h = ($maxWidth / $img['old_w']) * $img['old_h'];
        } elseif (isset($arrMore["fixMin"])) {
            if ($img['old_w'] > $img['old_h']) {
                $new_h = $maxHeight;
                $new_w = ($maxHeight / $img['old_h']) * $img['old_w'];

                if ($new_w < $maxWidth) {
                    $new_w = $maxWidth;
                    $new_h = ($maxWidth / $img['old_w']) * $img['old_h'];
                }
            } else {
                $new_w = $maxWidth;
                $new_h = ($maxWidth / $img['old_w']) * $img['old_h'];

                if ($new_h < $maxHeight) {
                    $new_h = $maxHeight;
                    $new_w = ($maxHeight / $img['old_h']) * $img['old_w'];
                }
            }
        } elseif (isset($arrMore["zoomMax"])) {
            if ($tl_new > $tl_old) {
                $new_h = $maxHeight;
                $new_w = ($maxHeight / $img['old_h']) * $img['old_w'];
            } else {
                $new_w = $maxWidth;
                $new_h = ($maxWidth / $img['old_w']) * $img['old_h'];
            }
        } else {
            if ($img['old_w'] > $maxWidth) {
                $new_w = $maxWidth;
                $new_h = ($maxWidth / $img['old_w']) * $img['old_h'];
            }
            if ($new_h > $maxHeight && $maxHeight != "auto") {
                $new_h = $maxHeight;
                $new_w = ($new_h / $img['old_h']) * $img['old_w'];
            }
        }
    }

    $img['des'] = @imagecreatetruecolor($new_w, $new_h);
    if ($fext == "image/png") {
        @imagealphablending($img['des'], false);
        @imagesavealpha($img['des'], true);
    } else {
        $white = @imagecolorallocate($img['des'], 255, 255, 255);
        @imagefill($img['des'], 1, 1, $white);
    }
    @imagecopyresampled($img['des'], $img['src'], 0, 0, $offsetX, $offsetY, $new_w, $new_h, $img['old_w'], $img['old_h']);
    //	print "path = ".$path."<br>";	
    @touch($path);
    switch ($fext) {
        case 'image/pjpeg':
        case 'image/jpeg':
        case 'image/jpg':
            @imagejpeg($img['des'], $path, 90);
            break;
        case 'image/png':
            @imagepng($img['des'], $path);
            break;
        case 'image/gif':
            @imagegif($img['des'], $path, 90);
            break;
    }
    // Finally, we destroy the images in memory.
    @imagedestroy($img['des']);
}

/* -------------- get_src_mod -------------------- */

function thumbnail($picture, $w = "", $h = "", $thumb = 1, $crop = 0, $arrMore = array())
{

    $arr_duoi = array('gif', 'png', 'jpg');

    $duoi = strtolower(substr($picture, strrpos($picture, ".") + 1));
    if (!in_array($duoi, $arr_duoi)) {
        $picture = 'public/upload/nophoto/nophoto.jpg';
    }

    $out = "";
    $pre = $w;
    if ($h) {
        $pre = $w . "x" . $h;
    } else {
        $h = $w;
    }
    if (isset($arrMore['fixMin'])) {
        $pre .= "_fmin";
    }
    if (isset($arrMore['fixMax'])) {
        $pre .= "_fmax";
    }
    if (isset($arrMore['fixWidth'])) {
        $pre .= "_fw";
    }
    if (isset($arrMore['zoomMax'])) {
        $pre .= "_zmax";
    }
    if ($crop != 0) {
        $pre .= "_crop";
    }

    $linkhinh = $picture;
    $linkhinh = str_replace("//", "/", $linkhinh);
    $dir = substr($linkhinh, 0, strrpos($linkhinh, "/"));
    $pic_name = substr($linkhinh, strrpos($linkhinh, "/") + 1);
    //$linkhinh = "uploads/" . $linkhinh;

    if ($w) {
        if ($thumb) {
            $folder_thumbs = str_replace('public/upload/', 'public/thumbs_size/', $dir . '/');
            $folder_thumbs .= substr($pic_name, 0, strrpos($pic_name, "."));
            $folder_thumbs .= '_' . substr($pic_name, strrpos($pic_name, ".") + 1);
            $file_thumbs = $folder_thumbs . "/{$pre}_" . substr($linkhinh, strrpos($linkhinh, "/") + 1);
            $linkhinhthumbs = SITE_PATH . $file_thumbs;
            //$linkhinhthumbs = SITE_PATH . "public/thumbs_size/" . $file_thumbs;
            if (!file_exists($linkhinhthumbs)) {
                rmkdir($folder_thumbs, 0777, "thumbs_size");
                // thum hinh
                thumbs(SITE_PATH . $linkhinh, $linkhinhthumbs, $w, $h, $crop, $arrMore);
            }
            $src = URL::root() . $file_thumbs;
        } else {
            $src = URL::root() . $folder_thumbs . "/" . $pic_name;
        }
    } else {
        $src = URL::root() . 'uploads/' . $picture;
    }

    return $src;
}
