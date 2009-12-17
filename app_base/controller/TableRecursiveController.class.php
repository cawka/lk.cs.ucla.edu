<?php

class TableRecursiveController extends TableController
{
	public function index( &$tmpl,$request )
	{
		if( isset($this->myItems) )
		{
			if( $this->myForceRecursive )
				$ret2=parent::showList( $tmpl,$request );

			$request2=array_merge($request,	
						array( $this->myItems->myParentIdName => $request[$this->myParentIdName] ) );
			
			$ret=$this->myItems->showList( $tmpl,$request2 );
			return $ret.$ret2;
		}
		else
			return parent::showList( $tmpl,$request );
	}
}


?>
