<?php

class TextAreaHTMLColumn extends TextAreaColumn 
{
	function getInputPostfix( )
	{
		global $langdata, $SETTINGS;
		
		return "<script type='text/javascript'>
        if (CKEDITOR.instances['$this->myName']) {
            CKEDITOR.remove(CKEDITOR.instances['$this->myName']);
        }       
        var editor=CKEDITOR.replace( '$this->myName', {height: 400} );
		CKFinder.SetupCKEditor( editor, '/lib/ckfinder/' );
		CKEDITOR.config.contentsCss='/css/$SETTINGS[theme]/site.css';
        </script>";
	}
}

?>
