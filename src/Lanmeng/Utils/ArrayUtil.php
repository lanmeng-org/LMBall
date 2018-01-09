<?php namespace Lanmeng\Utils;

class ArrayUtil
{
    /**
     * 把一维数组转为树状数组
     * @param array  $list  待处理的数组
     * @param string $pk    主键Key名称
     * @param string $pid   父元素ID
     * @param string $child 子元素Key名称
     * @param int    $root  根节点Parent ID的值
     * @return array
     */
    public static function list2Tree(array $list, $pk = 'id', $pid = 'pid', $child = 'child', $root = 0)
    {
        $tree = [];
        $refer = [];

        foreach ($list as $key => $data) {
            $refer[$data[$pk]] = &$list[$key];
        }

        foreach ($list as $key => $data) {
            $parentId = $data[$pid];

            if ($root == $parentId) {
                $tree[$list[$key][$pk]] = &$list[$key];
            } else {
                if (isset($refer[$parentId])) {
                    $parent = &$refer[$parentId];
                    $parent[$child][$list[$key][$pk]] = &$list[$key];
                }
            }
        }

        return $tree;
    }
}
