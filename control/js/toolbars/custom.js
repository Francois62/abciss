if (typeof RTOOLBAR == 'undefined') var RTOOLBAR = {};

RTOOLBAR['custom'] = 
{
	html:
	{
		title: RLANG.html,
		func: 'toggle',
		separator: true
	},	
	styles:
	{ 
		title: RLANG.styles,
		func: 'show', 				
		dropdown: 
	    {
			 p:
			 {
			 	title: RLANG.paragraph,			 
			 	exec: 'formatblock',
			 	param: '<p>'
			 },
			 h3:
			 {
			 	title: RLANG.header3,			 
			 	exec: 'formatblock', 
			 	param: '<h3>',			 	  
			 },		
			 h4:
			 {
			 	title: RLANG.header4,			 
			 	exec: 'formatblock', 
			 	param: '<h3>',			 	  
			 }					 														
		},
		separator: true
	},
	bold:
	{ 
		title: RLANG.bold,
		exec: 'Bold',
	 	param: false	
	}, 
	italic:
	{
		title: RLANG.italic,
		exec: 'italic',
	 	param: null
	},
	deleted:
	{
		title: RLANG.deleted,
		exec: 'strikethrough',
	 	param: null,
		separator: true	 		
	},	
	link:
	{ 
		title: RLANG.link,
		func: 'show', 				
		dropdown: 
		{
			link:
			{
				title: RLANG.link_insert, 
				func: 'showLink'
			},
			unlink: 
			{
				title: RLANG.unlink,
				exec: 'unlink', 
			 	param: null
			}
		},
		separator: true															
	},
	fullscreen:
	{
		title: RLANG.fullscreen,
		func: 'fullscreen'
	}	
};