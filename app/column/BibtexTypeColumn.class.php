<?php

class BibtexTypeColumn extends ListColumn
{
		public function __construct( $name, $descr )
		{
				parent::ListColumn( $name, $descr, "Required", array(
							"article"=>"Journal paper",
							"conference"=>"Conference paper",
							"book"=>"Book",
							"incollection"=>"Book chapter",
							"patent"=>"Patent",
							"techreport"=>"Tech.Report",
							"misc"=>"Misc",
							"phdthesis"=>"PhD Thesis",
							"misc"=>"Presentation",
							"raw"=>"Raw BibTex entry",
						) 
				);

				$this->myAdditional="onchange='changeBibtexType(this,\"$_REQUEST[biblio_type]\")'";
//				$this->myAdditionalText="<script type=\"text/javascript\">changeBibtexType($(\"$this->myName\"))</script>";
		}

}

