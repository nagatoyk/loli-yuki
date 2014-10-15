<?php
/**
 * 站点配置模型
 */
class ConfigModel extends Model{
	// 数据表名
	public $table = 'config';
	// 获得配置项
	public function get_config(){
		$config = $this->all();
		foreach($config as $k => $v){
			$config[$k]['html'] = $this->get_config_html($v);
		}
		return $config;
	}
	// 根据不同类型输出不同的html代码
	public function get_config_html($c){
		switch($c['show_type']){
			case 1:
				$html = "<input type=\"text\" name=\"{$c['id']}\" class=\"w400\" value=\"{$c['value']}\">";
				break;
			case 2:
				$option = $c['option'];
				$data = explode(',', $option);
				$html = '';
				foreach($data as $d){
					$tmp = explode('|', $d);
					$html .= "<label><input type=\"radio\" name=\"{$c['id']}\" value=\"{$tmp[0]}\"";
					if($c['value'] == $tmp[0]){
						$html .= ' checked="checked"';
					}
					$html .= ">{$tmp[1]}&nbsp;&nbsp;</label>";
				}
				break;
			case 3:
				$html = "<textarea name=\"{$c['id']}\" class=\"w400 h100\">{$c['value']}</textarea>";
				break;
		}
		return $html;
	}
	// 更新数据方法
	public function update_config(){
		foreach($_POST as $k => $v){
			$this->save(array('id' => $k, 'value' => $v));
		}
		$config = $this->all();
		$d = array();
		foreach($config as $k){
			$d[$k['name']] = $k['value'];
		}
		F('config.inc', $d, APP_CONFIG_PATH);
		return true;
	}
}