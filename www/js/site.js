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
