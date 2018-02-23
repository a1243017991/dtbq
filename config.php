<?php

$webConfig = array(
    'webTitle' => '斗图',   // 网站标题
    'siteurl' => 'http://a1243017991.huidianw.cn/bqb',    // 网站网址,结尾不需要 “/”
    'miibeian' => '',   // 工信部备案编号
    'beian' => '',    // 公安部备案编号
    'imgPath' => 'images/upload' // 表情大全中的表情图片存储路径(无需修改)
);

/**
 * 返回配置
 * @param string $name 配置名称
 */
function C($name=''){
	global $webConfig;
	if(!$name)
		return $webConfig;
	else
		return $webConfig[$name]? $webConfig[$name]: '';
}