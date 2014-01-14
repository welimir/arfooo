<?php
/**
 * Arfooo
 * 
 * @package    Arfooo
 * @copyright  Copyright (c) Arfooo Annuaire (fr) and Arfooo Directory (en)
 *             by Guillaume Hocine (c) 2007 - 2010
 *             http://www.arfooo.com/ (fr) and http://www.arfooo.net/ (en)
 * @author     Guillaume Hocine & Adrian Galewski
 * @license    http://creativecommons.org/licenses/by/2.0/fr/ Creative Commons
 */


class NavigationTree
{
    private $tree;

    function __construct()
    {
        $rootNode = array("childs" => array());
        $rootNode['nodeId'] = 0;
        $rootNode['value'] = array("name" => "Root", "count" => 0);
        $this->tree[0] = $rootNode;
    }

    function addNode($nodeId, $parentId, $value = null)
    {
        if (!isset($this->tree[$parentId])) {
            $this->tree[$parentId] = array("childs" => array());
        }

        if (!isset($this->tree[$nodeId])) {
            $this->tree[$nodeId] = array("childs" => array());
        }

        $newNode = & $this->tree[$nodeId];
        $parentNode = & $this->tree[$parentId];

        $newNode['nodeId'] = $nodeId;
        $newNode['value'] = $value;
        $newNode['parentId'] = $parentId;

        $parentNode['childs'][] = $nodeId;
    }

    function calculateLeftRight($nodeId = 0)
    {
        if (!$nodeId) {
            $this->nr = 0;
        }

        $this->tree[$nodeId]['value']['left'] = $this->nr++;

        foreach ($this->tree[$nodeId]['childs'] as $childNodeId) {
            $this->calculateLeftRight($childNodeId);
        }

        $this->tree[$nodeId]['value']['right'] = $this->nr++;
    }

    function getAllConnections($index = 0, $filterFunction = null)
    {
        $out = array();
        $this->tree[$index]['depth'] = 0;
        $stack = array($index);

        while (!empty($stack)) {
            $nodeId = array_pop($stack);
            $node = & $this->tree[$nodeId];
            $depth = $node['depth'];

            if ($nodeId) {
                if ($filterFunction && !$filterFunction($node)) {
                    continue;
                }

                $out[] = array("parentCategoryId" => $node['parentId'],
                               "categoryId" => $nodeId,
                               "depth" => $depth,
                               "value" => $node['value']);
            }

            foreach ($node['childs'] as $childNodeId) {
                $this->tree[$childNodeId]['depth'] = $depth + 1;
                array_push($stack, $childNodeId);
            }
        }

        return $out;
    }

    function getFullOptionList()
    {
        $list = array();
        $levelValues = array("");

        foreach ($this->getAllConnections() as $connection) {
            $currentLevelValue = & $levelValues[$connection['depth']];
            $currentLevelValue = $levelValues[$connection['depth'] - 1];
            if ($currentLevelValue) {
                $levelValues[$connection['depth']] .= " > ";
            }
            $currentLevelValue .= $connection['value']['name'];

            $list[$connection['categoryId']] = $currentLevelValue;
        }

        return $list;
    }

    function render()
    {
        $resultList = array();
        $this->renderNode(0, array(), $resultList);
        return $resultList;
    }

    function renderNode($nodeId, $parents, &$resultList, $level = 0)
    {
        $node = $this->tree[$nodeId];
        $value = & $node['value'];

        if ($level > 0) {
            $newItem = $value;

            $newItem['parents'] = $parents;
            $parents[] = $newItem;

            $resultList[] = $newItem;
        }

        foreach ($node['childs'] as $childNodeId) {
            $this->renderNode($childNodeId, $parents, $resultList, $level + 1);
        }
    }
}
