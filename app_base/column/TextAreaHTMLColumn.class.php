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
			
		return "<script type='text/javascript'>
window.addEvent('domready',function(){
        if (CKEDITOR.instances['$this->myName']) {
			CKEDITOR.remove(CKEDITOR.instances['$this->myName']);
			CKEditors.erase( '$this->myName' );
        }       
		var editor=CKEDITOR.replace( '$this->myName', {height: 400} );
		CKEditors.set( '$this->myName', '$this->myName' );

		CKFinder.SetupCKEditor( editor, '/lib/ckfinder/' );
		CKEDITOR.config.contentsCss='/css/$SETTINGS[theme]/site.css';
	} );
		</script>";
		
	}
}

?>
