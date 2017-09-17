<?php

namespace app\home\controller;

use app\common\controller\HomeController;
use app\common\model\Slider;
use app\common\model\HouseBetter;
use app\common\model\News;

/**
 * 默认控制器
 * @author Sir Fu
 */
class BetterController extends HomeController
{
    //广告类别
    private $sliderType = 6;
    // 资讯类别
    private $newsType = 6;

    protected function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->assign('nav','better');
    }

    /**
     * 默认方法
     * @author Sir Fu
     */
    public function indexAction()
    {
        $list = [];
        $where = ['type'=>$this->sliderType];
        $slider = Slider::getSlider($where);
        foreach ($slider as $item){
            $list[] = [
                'title'=>$item['title'],
                'desc'=>$item['description'],
                'target'=>$item['target'],
                'url'=>$item['url'],
            ];
        }
        if (empty($list)){
            $where = array_merge($where,['isDefault'=>'1']);
            $slider = Slider::getSlider($where,null,true);
            foreach ($slider as $item){
                $list[] = [
                    'title'=>$item['title'],
                    'desc'=>$item['description'],
                    'target'=>$item['target'],
                    'url'=>$item['url'],
                ];
            }
        }
        if (empty($list)){
            $list[] = [
                'title'=>'',
                'desc'=>'',
                'target'=>'',
                'url'=>Slider::T('default',$this->sliderType),
            ];
        }
        $slider = json_encode($list);

        // 资讯
        $newsModel = News::load();
        $news = $newsModel->where(['type'=>$this->newsType])->select();

        return view('better/index',[
            'meta_title'=>'家装',
            'slider'=>$slider,
            'news'=>$news,
        ]);
    }

}