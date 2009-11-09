<?php

class TextAreaHTMLLangColumn extends TextAreaLangColumn 
{
	function getInputPostfix( $lang, $lang_id )
	{
		global $langdata;
		$name="$this->myName"."_$lang";
		
		return "<script type='text/javascript'>
		if (CKEDITOR.instances['$name']) {
            CKEDITOR.remove(CKEDITOR.instances['$name']);
        }		
	 	var editor=CKEDITOR.replace( '$name' );
	 	CKFinder.SetupCKEditor( editor, '/class/ckfinder/' );
	 	</script>";
	}
}

?>