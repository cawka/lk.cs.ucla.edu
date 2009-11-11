<?php

class BibtexTypeColumn extends ListColumn
{
		public function __construct( $name, $descr )
		{
				parent::ListColumn( $name, $descr, "Required", array(
							"raw"=>"Raw BibTex entry",
							"article"=>"Journal paper",
							"conference"=>"Conference paper",
							"book"=>"Book",
							"incollection"=>"Book chapter",
							"patent"=>"Patent",
							"techreport"=>"Tech.Report",
							"misc"=>"Misc",
						) 
				);

				$this->myAdditional="onchange='changeBibtexType(this)'";
//				$this->myAdditionalText="<script type=\"text/javascript\">changeBibtexType($(\"$this->myName\"))</script>";
		}


}

