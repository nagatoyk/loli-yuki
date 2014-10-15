<?php
/**
 * 文章视图模型
 */
class ArticleModel extends ViewModel{
	public $table = 'article';
	public $view = array(
		'article' => array(
			'aid',
			'catid',
			'addtime' => 'time',
			'title',
			'content',
			'click',
			'thumb',
			'_type' => 'INNER'
		),
		'category' => array(
			'cname',
			'_type' => 'INNER',
			'_on' => '__article__.catid=__category__.cid',
		)
	);
}