<?php

class LoadChunk
{	
	private $location  = 'chunks/';
	private $chunk;
	private $extention = '.tpl';
	private $vars;
	
	public function __construct($chunk , $folder = '' , array $vars = array(), $level = '')
	{
		$this->vars = $vars;
		if(empty($chunk)) return false;
		if(!empty($folder)) $this->location = $this->location . '/' . $folder . '/';
		$this->chunk = $level . $this->location . $chunk . $this->extention;
	}

	public function __toString()
    {
        return strtr($this->GetChunkText(), $this->GetReplacementPairs());
    }

	private function PrintChunk()
    {
        return strtr($this->GetChunkText(), $this->GetReplacementPairs());
    }

	private function GetChunkText()
    {
        return file_get_contents($this->chunk);
    }

	private function GetReplacementPairs()
    {
        $pairs = array();
        foreach ($this->vars as $name => $value)
        {
            $key         = sprintf('[[+%s]]', $name);
            $pairs[$key] = (string)$value;
        }
        return $pairs;
    }	
}