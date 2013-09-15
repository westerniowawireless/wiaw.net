primeShortcodeMeta={
	attributes:[
		{
			label:"Tabs",
			id:"content",
			controlType:"tab-control"
		},
		{
			label:"Tabber Title",
			id:"tabberTitle",
			help:"Set an optional main heading for the tabber.", 
			defaultText: ''
		},
        {
            label:"Color",
            id:"color",
            help:'the background color of tabs (you can choose any color you want in hex format)'
        },
        {
            label:"Border Color",
            id:"border",
            help:'the border color of the tab content area'
        }
		],
		disablePreview:true,
		customMakeShortcode: function(b){
			var a=b.data;
			var tabTitles = new Array();
			
			if(!a)return"";
			
			var c=a.content;
			var tabberStyle = b.style;
			var tabberTitle = b.tabberTitle;
			
			var g = ''; // The shortcode.
			
			for ( var i = 0; i < a.numTabs; i++ ) {
			
				var currentField = 'tle_' + ( i + 1 );

				if ( b[currentField] == '' ) {
				
					tabTitles.push( 'Tab ' + ( i + 1 ) );
				
				} else {
				
					var currentTitle = b[currentField];
					
					currentTitle = currentTitle.replace( /"/gi, "'" );
					
					tabTitles.push( currentTitle );
				
				} // End IF Statement
			
			} // End FOR Loop
			
			g += '[tabs ';
			
			if ( tabberTitle ) { g += ' title="' + tabberTitle + '"'; } // End IF Statement
			
			g += '] ';
			
			for ( var t in tabTitles ) {
			
				g += '[tab title="' + tabTitles[t] + '"]' + tabTitles[t] + ' content goes here.[/tab] ';
			
			} // End FOR Loop

			g += '[/tabs]';

			return g
		
		}
};