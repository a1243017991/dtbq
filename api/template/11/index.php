<?php
if(!defined('MK_Pic_api')) die('非法访问 - Insufficient Permissions');

header("content-type:image/jpeg");

// error_reporting(0); 
$maker = array(
    'str1' => getParam('str1', '张三'),   // 字符串1
    'str2' => getParam('str2', '十大杰出青年'),   // 字符串1
    'str3' => getParam('str3', '杰出青年评选中心'),   // 字符串1
    'font1' => $fonts['song_bold'],   // 字体
    'font2' => $fonts['kai'],   // 姓名字体
    'font_size1' => 14,     // 获奖者字体大小1
    'font_size2' => 40,     // 奖项名称字体大小1
    'font_size3' => 12,     // 落款字体大小1
    'image_bg' => $config['path'] . 'bg.jpg',   // 背景图片
);


$m_arr = getimagesize($maker['image_bg']); // 高度、宽度、格式(GIF-JPEG/JPG-PNG)、高宽值字符串
$m_width = $m_arr[0];   // 图像宽度
$m_height = $m_arr[1];  // 图像高度

$m_im = imagecreatetruecolor($m_width, $m_height);     // 新建一个 宽x高 的真彩色图像


// imagecreatefromgif()：创建一块画布，并从 GIF 文件或 URL 地址载入一副图像
// imagecreatefromjpeg()：创建一块画布，并从 JPEG 文件或 URL 地址载入一副图像
// imagecreatefrompng()：创建一块画布，并从 PNG 文件或 URL 地址载入一副图像
// imagecreatefromwbmp()：创建一块画布，并从 WBMP 文件或 URL 地址载入一副图像
// imagecreatefromstring()：创建一块画布，并从字符串中的图像流新建一副图像
$m_bg = imagecreatefromjpeg($maker['image_bg']);     // 创建背景
imagecopy($m_im, $m_bg, 0, 0, 0, 0, $m_width, $m_height);
imagedestroy($m_bg);

$m_color = imagecolorallocate($m_im, 0, 0, 0);  // 创建一个颜色


// 获奖者
// 输入：句柄、字体大小、角度、坐标点x、y、颜色、字体文件、字符串 (int im, int size, int angle, int x, int y, int col, string fontfile, string text);
$m_fontBox = imagettfbbox($maker['font_size1'], 0, $maker['font2'], $maker['str1']);
$m_x = ($m_width - $m_fontBox[2]) - 430;  // 获取字符宽度并居中显示
imagettftext($m_im, $maker['font_size1'], 0, $m_x, 195, $m_color, $maker['font2'], $maker['str1']);  // 在图片上绘制文字

imagettftext($m_im, $maker['font_size1'], 0, 180, 195, $m_color, $maker['font1'], '同志被评为：');  // 在图片上绘制文字


// 发奖机构
$m_fontBox = imagettfbbox($maker['font_size3'], 0, $maker['font1'], $maker['str3']);
$m_x = ($m_width - $m_fontBox[2]) / 2 + 160;  // 获取字符宽度并居中显示

// 输入：句柄、字体大小、角度、坐标点x、y、颜色、字体文件、字符串 (int im, int size, int angle, int x, int y, int col, string fontfile, string text);
imagettftext($m_im, $maker['font_size3'], 0, $m_x, 325, $m_color, $maker['font1'], $maker['str3']);  // 在图片上绘制文字


$maker['str4'] = date("Y年m月d日");
$m_fontBox = imagettfbbox($maker['font_size3'] - 1, 0, $maker['font1'], $maker['str4']);
$m_x = ($m_width - $m_fontBox[2]) / 2 + 160;  // 获取字符宽度并居中显示
imagettftext($m_im, $maker['font_size3'] - 1, 0, $m_x, 345, $m_color, $maker['font1'], $maker['str4']);  // 在图片上绘制文字



// 奖项名称
$m_fontBox = imagettfbbox($maker['font_size2'], 0, $maker['font1'], $maker['str2']);
$m_x = ($m_width - $m_fontBox[2])/2;  // 获取字符宽度并居中显示
// 输入：句柄、字体大小、角度、坐标点x、y、颜色、字体文件、字符串 (int im, int size, int angle, int x, int y, int col, string fontfile, string text);
$m_color = imagecolorallocate($m_im, 251, 238, 46);  // 创建一个颜色
imagettftext($m_im, $maker['font_size2'], 0, $m_x + 1, 261, $m_color, $maker['font1'], $maker['str2']);  // 在图片上绘制文字
// imagettftext($m_im, $maker['font_size2'], 0, $m_x + 2, 262, $m_color, $maker['font1'], $maker['str2']);  // 在图片上绘制文字
$m_color = imagecolorallocate($m_im, 246, 1, 3);  // 创建一个颜色
imagettftext($m_im, $maker['font_size2'], 0, $m_x, 260, $m_color, $maker['font1'], $maker['str2']);  // 在图片上绘制文字




imagejpeg($m_im);
imagedestroy($m_im);
?>