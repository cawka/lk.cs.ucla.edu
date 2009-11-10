<?php

class TextsModel extends TableModel
{
		public function __construct( $php, $page_id=NULL, $page_block=NULL )
		{
				global $DB;

				if( !isset($page_id) || !isset($page_block) )
				{
					$page_id=$_REQUEST['page_id'];
					$page_block=$_REQUEST['page_block'];
				}

				$this->myParentId="frame_$page_block";

				parent::__construct( $DB, $php, "texts", array(
						new TextAreaHTMLColumn("text","Content",NULL,false,""," ckhtml"),
						'page_id'=>new HiddenColumn("page_id",$page_id),
						'page_block'=>new HiddenColumn("page_block",$page_block), 
					)
				);

				$this->myRefreshAction="show";
		}

		protected function rowId( $request )
		{
				if( isset($request['id']) ) return parent::rowId( $request );

				$ret="page_id=".$this->myDB->qstr($this->myColumns['page_id']->getValue()).
					" AND ".
					 "page_block=".$this->myDB->qstr($this->myColumns['page_block']->getValue());
				return $ret;
		}

		public function getQuery( )
		{
			if( !isset($_REQUEST['id']) )
				$q=array( "page_id"=>$_REQUEST['page_id'], "page_block"=>$_REQUEST['page_block'] );
			else
				$q=array( "id"=>$_REQUEST['id'] );
			return http_build_query( $q,'','&amp;' );
		}
}

?>
