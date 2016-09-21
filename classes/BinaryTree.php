<?php

/* 
 * 
 * 
 * 
 */

class FonBinaryNode
{
    public $value;
    public $left;
    public $right;
    
    public function __construct($item, $content) 
    {
        $this->value = $item;
        $this->content = $content;
        $this->position;
        $this->left = null;
        $this->right = null;
    }
    
    public function dump()
    {
        if($this->left !== null)
        {
            $this->left->dump();
        }
        echo $this->value;
        if ($this->right !== null)
        {
            $this->right->dump();
        }
    }
    
    protected function buildingBlock()
    {
        switch ($this->content)
        {
            case 1:
                $block = "yellow";
                break;
            case 2:
                $block = "red";
                break;
            case 3:
                $block = "blue";
                break;
            default:
                $block = "green";
                break;       
        }
        echo '<div class="block '.$block.'" '.$this->position.'></div>';
    }
}

class FonBinaryTree
{
    protected $root;
    
    public function __construct()
    {
        $this->root = null;
    }
    
    public function isEmpty()
    {
        return $this->root === null;
    }
    
    public function insert($item, $content)
    {
        $node = new FonBinaryNode($item, $content);
        
        if ($this->isEmpty())
        {
            $this->root = $node;
        }
        else
        {
            $this->insertNode($node, $this->root);
        }
    }
    
    protected function insertNode($node, &$subtree) 
    {
        if ($subtree === null)
        {
            $subtree = $node;
        }
        else if($node->value > $subtree->value)
        {
            $this->insertNode($node, $subtree->right);
        }
        else if($node->value < $subtree->value)
        {
            $this->insertNode($node, $subtree->left);
        }
        else
        {
        }
    }
    
    public function traverse()
    {
        $this->root->dump();
    }
}

$bla = new FonBinaryTree();

$bla->insert(4, 1);
$bla->insert(5, 2);
$bla->insert(2, 3);
$bla->insert(1, 1);
$bla->insert(3, 2);
$bla->insert(14, 3);

echo '<link rel="stylesheet" href="newcss.css" type="text/css" media="all" />';

$bla->traverse();