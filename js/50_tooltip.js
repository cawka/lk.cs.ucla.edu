function ToolTips( )
{
	$$('.tooltip').each( function(element,index) {
		var value=element.get('title');
		if( value )
		{
			var content=value.split('::');
			element.store('tip:title',content[0]);
			element.store('tip:text',content[1]);
		}
	} );
	
	var tips = new TipsFixed($$('.tooltip'), {
		showDelay: 400,
		hideDelay: 10
	});

	tips.addEvents( {
		'show': function(tip) {
			tip.fade('in');
		},
		'hide': function(tip) {
			tip.fade('out');
		}
	} );
}

window.addEvent('domready', function(){
	ToolTips( );	
} );

