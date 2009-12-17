<?php

class HiddenExactValueColumn extends HiddenColumn 
{
	function getInsert( &$req )
	{
		return $this->myValue;
	}
}

