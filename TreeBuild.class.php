<?php
namespace Org\Util;

/**
 * 树形构建
 *
 * @author loftor<i@loftor.com>
 */
class TreeBuild
{
    private $result; //结果数组
    private $arrSource; //待处理数组
    public $sort = false;
    public $sortFiled = 'sort';
    public $id = 'id';
    public $pid = 'parent';
    public $topId = '0';
    public $childrens = 'childrens';

    public function __construct(array $arrSource)
    {
        $this->arrSource = $arrSource;
        $this->result = array();
    }

    public function  getSubArray($pid)
    {
        $temp = array();
        foreach($this->arrSource as $key => $item){
            if($item[$this->pid] == $pid){
                $this->result_push($temp,$item);
                unset($this->arrSource[$key]);
            }
        }

        if(count($temp)){
            foreach($temp as $key => $item){
                $temp[$key][$this->childrens] = $this->getSubArray($item[$this->id]);
            }
            return $temp;
        }
        return false;
    }

    /**
     * 构建tree
     */
    public function make()
    {
        $this->result = $this->getSubArray($this->topId);
    }

    public function getResult()
    {
        return $this->result;
    }

    /**
     * 将需要插入的数据更新到结果数组中
     * @param  [array] $arr       [结果数组]
     * @param  [array] $pushValue [需要插入的数组]
     */
    private function result_push(&$arr, $pushValue) {
        if (false === $this->sort) {//未开启sort
            $arr[] = $pushValue;
        } else {//开启sort
            $length = 0;
            foreach ($arr as $one) {
                $one[$this->sortFiled]       = isset($one[$this->sortFiled])?$one[$this->sortFiled]:0;
                $pushValue[$this->sortFiled] = isset($pushValue[$this->sortFiled])?$pushValue[$this->sortFiled]:0;
                if ($one[$this->sortFiled] > $pushValue[$this->sortFiled]) {
                    break;
                } else {
                    $length++;
                }
            }
            $before = array_slice($arr, 0, $length);
            $after  = array_slice($arr, $length, count($arr)-$length);
            $arr    = array_merge($before, array($pushValue), $after);
        }
    }
}