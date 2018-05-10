
(function($){
	$('#tabs').tabs();

})(jQuery);

// (function($){

// 			let div_countries = jQuery('#cv-dropdown-countries');
// 			let div_cities = jQuery('#cv-dropdown-cities');

// 			let a_countries = jQuery('#cv-countries');
// 			let a_cities = jQuery('#cv-cities');
// 			let a_month = jQuery('#cv-month');
// 			let countries = '';
// 			let cities = '';

// 	let plugin = {
			
// 			loadContents : function(){

// 				if(countries == '' && cities == ''){
				
// 					(jQuery).ajax({
// 						url: "https://restcountries.eu/rest/v2/all",
// 						type: "GET",
// 						dataType: 'json',
// 					}).done(function(data){
								
							
// 							countries+='<ul id="countries" style="list-style-type:none; color:white;">';
// 							cities+='<ul style="list-style-type:none; color:white;">';
								
// 							(jQuery).each(data,function(k,v){

// 								if(v.name.length != 0 || v.capital.length != 0)
// 								countries+='<li>'+v.name+'</li>';
// 								cities+='<li>'+v.capital+'</li>';
// 							});
// 							countries+='</ul>';
// 							cities+='</ul>';

							
// 							div_countries.html(countries);
// 							div_cities.html(cities);

// 					});
// 				}
// 			}
// 	}


// 	plugin.loadContents();

// 	let isShowing1 = false;
	
// 	a_countries.on('click',function(e){
// 		 e.preventDefault();
// 		 if(!isShowing1){
// 		 	div_countries.css('display','block');
// 		 	isShowing1 = true;
// 		 }else{
// 		 	div_countries.css('display','none');
// 		 	isShowing1 = false;
// 		 }
// 	});

// 	 let isShowing2 = false;
// 	a_cities.on('click',function(e){
// 		e.preventDefault();
// 		 if(!isShowing2){
// 		 	div_cities.css('display','block');
// 		 	isShowing2 = true;
// 		 }else{
// 		 	div_cities.css('display','none');
// 		 	isShowing2 = false;
// 		 }
// 	});

// 	$('ul[id*=countries] li').click(function(){
// 		console.log($(this).text());
// 	});








// })(jQuery);