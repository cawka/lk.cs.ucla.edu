<?php

class TextAreaHTMLColumn extends TextAreaColumn 
{
	function getInputPostfix( )
	{
		global $langdata, $SETTINGS;

		/*return "<script type='text/javascript'>
window.addEvent('domready', function(){
	var oFCKeditor = new FCKeditor( '$this->myName' ) ;
	oFCKeditor.BasePath = \"/lib/fckeditor/\" ;
	oFCKeditor.ReplaceTextarea() ;
} );
</script>
";
		 */

		global $GLOBAL_PREFIX;

		return "<script type='text/javascript'>
window.addEvent('domready',function(){
        if (CKEDITOR.instances['$this->myName']) {
			CKEDITOR.remove(CKEDITOR.instances['$this->myName']);
			CKEditors.erase( '$this->myName' );
        }       
		var editor=CKEDITOR.replace( '$this->myName', {height: 400} );
		CKEditors.set( '$this->myName', '$this->myName' );

		CKFinder.setupCKEditor( editor, '".$GLOBAL_PREFIX."lib/ckfinder/' );
		CKEDITOR.config.contentsCss='".$GLOBAL_PREFIX."css/$SETTINGS[theme]/site.css';
	} );
		</script>";
		
	}
}

?>
