function hide_edit_form( )
{
	TB_remove( );
}

function del( url,data,el )
{
	new Request.HTML( 
		{ url: url, 
		  method: 'post',
		  data: data+"&ajax=true",
		  evalScripts: true,
		  update: el,
		  onComplete: TB_init
		} ).send( );
}

function cancel( )
{
	hide_edit_form( );
}

CKEditors=new Hash();

function refresh_list( url,name,id,urladdon )
{
	var frame="frame_"+id;
	var mydata="";
	if( name!="" ) mydata=name+"="+id+"&";
	mydata+="ajax=true";
	if( urladdon!="" ) mydata+="&"+urladdon;
	
	new Request.HTML( { 
			url: url, 
			method: "get",
			data: mydata,
			update: $(frame),
			onComplete: TB_init
		  }
		).send( );
}

function updateImage( el, value )
{
	$(el+'_pic').src=value;
	$(el).value=value;
}

function BrowserPopup( name )
{
	finder=new CKFinder();
	
	finder.basePath=PREFIX+'lib/ckfinder/';
	finder.selectActionFunction=function( fileUrl, data ) 
		{
			eval( "set_"+name+"('"+fileUrl+"')");
//			eval( "set_"+name+"(" fileUrl+")" );
		};
	finder.rememberLastFolder=true;

	finder.popup( );
}

function checkAll( fields )
{
    fields.each( function(field){
            field.set( 'checked', true );
            } );
    return false;
}

function uncheckAll( fields )
{
    fields.each( function(field){
            field.set( 'checked', false );
            } );
    return false;
}

function add( name )
{
    value = $(name).get( 'value' );
    if( value!=parseInt(value) ) return;

    $$("."+name).each( function(e){
        try
        {
            v=e.get('value');
            if( v )
            {
                va = v.split( " " );
                va.each( function(x){ if(x==value) throw "break"; } );
                e.set( 'value',v+" "+value );
            }
            else
                e.set( 'value',value );
        }
        catch( e )
        {
            return;
        }
    } );
}

function remove( name )
{
    value=$(name).get( 'value' );
    if( value!=parseInt(value) ) return;

    $$("."+name).each( function(e){
        v=e.get('value');
        if( v )
        {
            va = v.split(' ');
            vb = new Array();
            va.each( function(x){ if(x!=value) vb.push(x); } );

            e.set( 'value', vb.join(' ') );
        }
    } );
}

var syncImgValues=function()
{
    if( arguments[0]!=undefined ) arguments[0].set( 'src', arguments[1].get('value') );
}

var BibTexHash=new Hash();

function changeBibtexType( field, biblio_type )
{
	//step 1. Save all variables.
	var form=field.getParent("form");

	form.getElements("input").each( function(e){if( e.get('type')=='text' || e.get('type')=='hidden' ) BibTexHash.set(e.get('name'),e.get('value'));} );

	var mydata="bibtex="+field.options[field.selectedIndex].value+"&biblio_type="+biblio_type+"&ajax=true";
	if( BibTexHash.has('id') ) mydata+="&id="+BibTexHash.get('id');

	new Request.HTML( {
		url : PREFIX+"bibwiki/fields",
		method : "get",
		data : mydata,
		update : $("TB_ajaxContent"),
		onComplete : function() {
			 BibTexHash.each( function(value,key){
						if( $(key) ) $(key).set( 'value',value );
					 } );
		}
	} ).send();
}

// Form Validation
window.addEvent('domready', function() {
    $$("form.validate").each( function(form){
        new Form.Validator.Inline( form, {
                useTitles: true,
                stopOnFailure: true
            } );
    } );
} );

