<?php
class Tag{
	// 标签组
	public $tag = array(
		'topnav' => array('block' => 1, 'level' => 1),
		'sidebar' => array('block' => 1, 'level' => 1)
	);
	// 顶部菜单
	public function _topnav($attr, $content){
		$php = <<<str
	<?php \$db = M('category');
	\$_cate = \$db->order('sort ASC')->all();
	if(\$_cate):
		\$_cate = Data::channelLevel(\$_cate);
		foreach(\$_cate as \$field):
			extract(\$field);
			\$url = U('artlist', array('cid' => \$cid));
?>
str;
		$php .= $content;
		$php .= '<?php endforeach; endif; ?>';
		return $php;
	}
	// 边栏标签
	public function _sidebar($attr, $content){
		// 数据类型('待完善')
		$type = isset($attr['type']) ? $attr['type'] : 'new';
		// 数据行数
		$row = isset($attr['row']) ? $attr['row'] : 10;
		$tilen = isset($attr['tilen']) ? $attr['tilen'] : 10;
		$hasimg = intval(isset($att['image']) ? $attr['image'] : 0);
		$php = <<<str
			<?php
			\$db = M('article');
			\$db->field(array('aid', 'title', 'click'));
			if($hasimg){
				\$db->where('thumb<>""');
			}
			switch('$type'){
				case 'hot':
					\$db->order('click DESC');
					break;
				default:
					\$db->order('addtime DESC');
					break;
			}
			\$result = \$db->order('$order')->limit('$row')->all();
			if(\$result):
				foreach(\$result as \$field):
					\$field['title'] = mb_substr(\$field['title'], 0, $tilen, 'utf8');
?>
str;
		$php .= $content;
		$php .= '<?php endforeach; endif;?>';
		return $php;
	}
}