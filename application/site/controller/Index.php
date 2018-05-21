<?php
namespace app\site\controller;
use think\Request;

class Index extends Base
{
    public $pageSize;

    /**
     * Index constructor.
     * @param Request|null $request
     */
    public function __construct()
    {
        parent::__construct();
        $this->pageSize = config('paginate.list_rows');
    }

    /**
     * @param int $p
     * @param string $title
     * @return \data|mixed|\strings
     */
    public function index($p=1,$article_title='')
    {      
        $article_title = str_content_replace($article_title);
        $where['a.article_title'] = ['like',"%{$article_title}%"];
        $allart = $this->Article->getAllArticleByWhere($p,$where,$this->pageSize);
        if(empty($allart)){
            $this->redirect('/error');
        }
        $count= count($allart);
		$page = ceil($count/$this->pageSize);//总页数
        if(request()->isAjax()){
            return $allart;
        }

		$this->assign('allart',$allart);
		$this->assign('p',$p);
		$this->assign('page',$page);
        $this->assign('title',$article_title);
    	return $this->fetch();
	}

    public function about($id=7){
        $where = "article_id={$id}";
        $content = $this->Article->getArticleByWhere($where);
        if(empty($content)){
            $this->redirect('/error');
        }
        $content['des'] = $this->Article->getDes()->where("pid={$id}")->select();
        $this->assign('content',$content);
        return $this->fetch('index/about');
    }


}
