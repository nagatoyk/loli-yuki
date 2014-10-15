<?php
class IndexController extends Controller{
	private $cate, $art;
	public function __construct(){
		parent::__construct();
		$this->cate = F('category');
		$this->art = K('Article');
	}
	public function index(){
		$db = M('article');
		$cdb = M('category');
		$db->field(array('aid', 'catid', 'title', 'addtime'));
		$cate = $cdb->where('pid=0')->all();
		$list = array();
		foreach($cate as $k => $v){
			$_p = $cdb->where('pid='.$v['cid'])->all();
			if(!empty($_p)){
				$tmp = array();
				foreach($_p as $_v){
					$tmp[] = $_v['cid'];
				}
				$tmp[] = $v['cid'];
				$cids = implode(',', $tmp);
				$db->where("catid IN({$cids})");
			}else{
				$db->where('catid='.$v['cid']);
			}
			$list[$k]['cid'] = $v['cid'];
			$list[$k]['cname'] = $v['cname'];
			$list[$k]['art'] = $db->order('addtime')->select();
		}
		$this->list = $list;
		$this->display();
	}
	// 分类列表
	public function artlist(){
		$cid = Q('cid', 0, 'intval');
		$cids = array();
		$tmp = Data::channelList($this->cate, $cid);
		foreach($tmp as $k => $v){
			$cids[] = $v['cid'];
		}
		if($cids){
			$cids[] = $cid;
			$cids = implode(',', $cids);
			$where = "catid IN({$cids})";
		}else{
			$where = 'catid='.$cid;
		}
		$this->cname = M('category')->where('cid='.$cid)->getField('cname');
		$this->artlist = $this->art->where($where)->order('time DESC')->all();
		$this->display();
	}
	// 文章页面
	public function artview(){
		$aid = Q('aid', 0, 'intval');
		$article = $this->art->find($aid);
		$this->art->inc('click', 'aid='.$aid, 1);
		$cate = Data::parentChannel($this->cate, $article['catid']);
		sort($cate);
		$this->category = $cate;
		$this->article = $article;
		$this->display();
	}
	// 计数器
	public function artcount(){
		$aid = Q('aid', 0, 'intval');
		$click = M('article')->where('aid='.$aid)->getField('click');
		$this->ajax(array('click' => $click));
	}
}