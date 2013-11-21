<?php
class bookAction extends frontendAction {
	
	
	/* 首页数据 */
	public function index() {
		$hot_tags = explode ( ',', C ( 'pin_hot_tags' ) ); // 热门标签
		$page_max = C ( 'pin_book_page_max' ); // 发现页面最多显示页数
		$sort = $this->_get ( 'sort', 'trim', 'hot' ); // 排序
		$tag = $this->_get ( 'tag', 'trim' ); // 当前标签
		$cate_id = $this->_get ( 'cate_id', 'trim' );
		$where = array ();
		$tag && $where ['intro'] = array (
				'like',
				'%' . $tag . '%' 
		);
		$cate_id && $where ["cate_id"] = $cate_id;
		// 排序：最热(hot)，最新(new)
		switch ($sort) {
			case 'hot' :
				$order = 'hits DESC,id DESC';
				break;
			case 'new' :
				$order = 'id DESC';
				break;
		}
		$this->waterfall ( $where, $order, '', $page_max );
		
		// 获取分类
		$where_args = array (
				'pid' => '1'
		);
		//分类查询
		$cate_mod = M ( "item_cate" );
		$field = "id,name";
		$cate_list = $cate_mod->field ( $field )->where ( $where_args )->select ();
		$list = array ();
		foreach ( $cate_list as $key => $value ) {
			$pid = $value ["id"];
			$where_args ['pid'] = $pid;
			$children_list = $cate_mod->where ( $where_args )->select ();
			$list [$pid] ["info"] = $value;
			$list [$pid] ["children"] = $children_list;
		}
		$this->assign ( 'cate_list', $list );
		
		$this->assign ( 'hot_tags', $hot_tags );
		$this->assign ( 'tag', $tag );
		$this->assign ( 'sort', $sort );
		$this->assign ( 'cate_id', $cate_id );
		$this->_config_seo ( C ( 'pin_seo_config.book' ), array (
				'tag_name' => $tag 
		) ); // SEO
		$this->display ();
	}
	/**
	 * 获取分页数据
	 */
	public function index_ajax() {
		$tag = $this->_get ( 'tag', 'trim' ); // 标签
		$sort = $this->_get ( 'sort', 'trim', 'hot' ); // 排序
		$cate_id = $this->_get ( 'cate_id', 'trim' );//分类
		switch ($sort) {
			case 'hot' :
				$order = 'hits DESC,id DESC';
				break;
			case 'new' :
				$order = 'id DESC';
				break;
		}
		$where = array ();
		$tag && $where ['intro'] = array (
				'like',
				'%' . $tag . '%' 
		);
		$cate_id && $where ["cate_id"] = $cate_id;
		$this->wall_ajax ( $where, $order );
	}
	
	/**
	 * 获取数据
	 */
	public function waterfall($where = array(), $order = 'id DESC', $field = '', $page_max = '', $target = '') {
		$spage_size = C ( 'pin_wall_spage_size' ); // 每次加载个数
		$page_size = $spage_size * 1; // 每页显示个数
		
		$item_mod = M ( 'item' );
		$where_init = array (
				'status' => '1' 
		);
		$where = $where ? array_merge ( $where_init, $where ) : $where_init;
		$count = $item_mod->where ( $where )->count ( 'id' );
		// 控制最多显示多少页
		if ($page_max && $count > $page_max * $page_size) {
			$count = $page_max * $page_size;
		}
		// 查询字段
		$field == '' && $field = 'id,uid,uname,title,intro,img,price,likes,comments,comments_cache';
		// 分页
		$pager = $this->_pager ( $count, $page_size );
		$target && $pager->path = $target;
		$item_list = $item_mod->field ( $field )->where ( $where )->order ( $order )->limit ( $pager->firstRow . ',' . $spage_size )->select ();
		foreach ( $item_list as $key => $val ) {
			isset ( $val ['comments_cache'] ) && $item_list [$key] ['comment_list'] = unserialize ( $val ['comments_cache'] );
		}
		$this->assign ( 'item_list', $item_list );
		// 当前页码
		$p = $this->_get ( 'p', 'intval', 1 );
		$this->assign ( 'p', $p );
		
		/*
		 * // 当前页面总数大于单次加载数才会执行动态加载 if (($count - ($p - 1) * $page_size) > $spage_size) { $this->assign ( 'show_load', 1 ); } // 总数大于单页数才显示分页 $count > $page_size && $this->assign ( 'page_bar', $pager->fshow () ); // 最后一页分页处理 if ((count ( $item_list ) + $page_size * ($p - 1)) == $count) { $this->assign ( 'show_page', 1 ); }
		 */
	}
	/**
	 * 瀑布加载
	 */
	public function wall_ajax($where = array(), $order = 'id DESC', $field = '') {
		$spage_size = C ( 'pin_wall_spage_size' ); // 每次加载个数
		$p = $this->_get ( 'p', 'intval', 1 ); // 页码
		                                       // 条件
		$where_init = array (
				'status' => '1' 
		);
		$where = array_merge ( $where_init, $where );
		// 计算开始
		$start = $spage_size * $p;
		$item_mod = M ( 'item' );
		$count = $item_mod->where ( $where )->count ( 'id' );
		$field == '' && $field = 'id,uid,uname,title,intro,img,price,likes,comments,comments_cache';
		$item_list = $item_mod->field ( $field )->where ( $where )->order ( $order )->limit ( $start . ',' . $spage_size )->select ();
		$this->assign ( 'item_list', $item_list );
		$totalPages = ceil ( $count / $spage_size ); // 总页数
		$end=0;
		if ($p < $totalPages) {
			$p = $p + 1;
		}else{
			$end=1;
		}
		$this->ajaxReturn ( 1, $p, $item_list,$end );
	}
	/* 首页数据 */
	public function hot() {
		$hot_tags = explode ( ',', C ( 'pin_hot_tags' ) ); // 热门标签
		$page_max = C ( 'pin_book_page_max' ); // 发现页面最多显示页数
		$sort = $this->_get ( 'sort', 'trim', 'hot' ); // 排序
		$tag = $this->_get ( 'tag', 'trim' ); // 当前标签
		
		$where = array ();
		$tag && $where ['intro'] = array (
				'like',
				'%' . $tag . '%' 
		);
		// 排序：最热(hot)，最新(new)
		switch ($sort) {
			case 'hot' :
				$order = 'hits DESC,id DESC';
				break;
			case 'new' :
				$order = 'id DESC';
				break;
		}
		$this->waterfall ( $where, $order, '', $page_max );
		// }
		
		$this->assign ( 'hot_tags', $hot_tags );
		$this->assign ( 'tag', $tag );
		$this->assign ( 'sort', $sort );
		$this->_config_seo ( C ( 'pin_seo_config.book' ), array (
				'tag_name' => $tag 
		) ); // SEO
		$this->display ();
	}
}