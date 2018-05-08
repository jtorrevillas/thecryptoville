(function($){

			let div_countries = jQuery('#cv-dropdown-countries');
			let div_cities = jQuery('#cv-dropdown-cities');
			let a_countries = jQuery('#cv-countries');
			let a_cities = jQuery('#cv-cities');
			let a_month = jQuery('#cv-month');
			let countries = '';
			let cities = '';

	let plugin = {
			
			loadContents : function(){

				if(countries == '' && cities == ''){
				
					(jQuery).ajax({
						url: "https://restcountries.eu/rest/v2/all",
						type: "GET",
						dataType: 'json',
					}).done(function(data){
								
							
							countries+='<ul>';
							cities+='<ul>';
								
							(jQuery).each(data,function(k,v){

								if(v.name.length != 0 || v.capital.length != 0)
								countries+='<li><a href="#">'+v.name+'</a></li>';
								cities+='<li><a href="#">'+v.capital+'</a></li>';
							});
							countries+='</ul>';
							cities+='</ul>';

							
							div_countries.html(countries);
							div_cities.html(cities);


					});
				}
			}
	}


	plugin.loadContents();

	
	a_countries.on('click',function(){
			div_countries.css('','block');
	});








})(jQuery);