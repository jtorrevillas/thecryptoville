<style type="text/css">
	
	.slick-slide {
outline: none !important;
}

.slick-prev,.slick-next,.slick-dots{
	display: none !important;
}

.autoplay{
  text-align: center !important;
  padding: 0;
  padding-top:3px;
  background:white;
  z-index: 0;
    padding:8px 17px 8px 17px;
}

.crpyto-prices-label{
  float:left;
  width:auto;
  background:#ff8400;
  padding:8px 17px 8px 17px;
  font-size:13px;
  color:white;
  font-weight:600;
  position: relative;
  z-index: 1;
}


@media screen and (max-width: 450px) {

.crpyto-prices-label{
  display: none;
}

.autoplay{
  text-align: center !important;
}


}

</style>
	
	<div class="crpyto-prices-label">
			LATEST CRYPTO PRICES  <i style="margin-left:10px;" class="fa fa-chevron-right"></i> 
	</div>

	<div class="autoplay">
			 <div><span class="eth"></span> <span class="eth-change"></span></div>
			 <div><span class="ltc"></span> <span class="ltc-change"></span></div>
			 <div><span class="xrp"></span> <span class="xrp-change"></span></div>
			 <div><span class="eos"></span> <span class="eos-change"></span></div>
			 <div><span class="bch"></span> <span class="bch-change"></span></div>
			 <div><span class="sec"></span> <span class="sec-change"></span></div>
			 <div><span class="sev"></span> <span class="sev-change"></span></div>
			 <div><span class="seb"></span> <span class="seb-change"></span></div>
			 <div><span class="btc"></span> <span class="btc-change"></span></div>

	</div>
			



<script type="text/javascript">
	

//-----Mike JS ----------------
	jQuery(document).ready(function(){
  	
  jQuery('.autoplay').slick({
  	 centerMode: true,
  centerPadding: '0px',
  slidesToShow: 3,
  slidesToScroll: 3,
  autoplay: true,
  autoplaySpeed: 2000,
    responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
 

});

});

//---------END ---------------------------------

//--------Ariel JS-------------
  document.addEventListener("DOMContentLoaded", function(event) { 
        
      let url = 'https://api.coinmarketcap.com/v1/ticker/?limit=10'  
      let ticker = new XMLHttpRequest();
      getPrices();
      setInterval(getPrices, 15000)
      ticker.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
                // setInterval(gotValue(this), 5000);
                gotValue(this)
        }
            
      }
      
      function getPrices(){
          ticker.open( 'GET', url, true );
          ticker.send();
          // alert('asdf')
      }
      function gotValue(a){
        let a1 = JSON.parse(a.responseText);
        // console.log(typeof a1)
        // console.log(a1)
        let btc = new Object(); //bitcoin
        let ltc = new Object(); //litecoin
        let eth = new Object(); //ethereum
        let xrp = new Object(); //ripple
        let eos = new Object(); //monero
        let bch = new Object(); //btc cash
        let sec = new Object(); //btc cash
        let sev = new Object(); //btc cash
        let seb = new Object(); //btc cash
        for(let i in a1){
            
            switch(a1[i].rank){
                case '1':
                    btc = a1[i];
                    break;
                case '2':
                    ltc = a1[i];
                    break;
                case '3':
                    eth = a1[i];
                    break;
                case '4':
                    xrp = a1[i];
                    break;
                case '5':
                    eos = a1[i];
                    break;
                case '6':
                    bch = a1[i];
                    break;
                case '7':
                    sec = a1[i];
                    break;
                case '8':
                    sev = a1[i];
                    break;
                case '9':
                    seb = a1[i];
                    break;
            }       
        }

        		jQuery(".btc").text(btc.symbol+" $"+parseFloat(btc.price_usd).toFixed(2));
				jQuery(".btc-change").text((parseFloat(btc.percent_change_1h) >=0 ? '+' + btc.percent_change_1h  + '%': btc.percent_change_1h  + '%'));
				jQuery(".btc-change").css('color',parseFloat(jQuery(".btc-change").text()) >= 0 ? 'green' : 'red');

				jQuery(".eth").text(eth.symbol+" $"+parseFloat(eth.price_usd).toFixed(2));
				jQuery(".eth-change").text((parseFloat(eth.percent_change_1h) >=0 ? '+' + eth.percent_change_1h  + '%': eth.percent_change_1h  + '%'));
				jQuery(".eth-change").css('color',parseFloat(jQuery(".eth-change").text()) >= 0 ? 'green' : 'red');

				jQuery(".ltc").text(ltc.symbol+" $"+parseFloat(ltc.price_usd).toFixed(2));
				jQuery(".ltc-change").text((parseFloat(ltc.percent_change_1h) >=0 ? '+' + ltc.percent_change_1h  + '%': ltc.percent_change_1h  + '%'));
				jQuery(".ltc-change").css('color',parseFloat(jQuery(".ltc-change").text()) >= 0 ? 'green' : 'red');

				jQuery(".xrp").text(xrp.symbol+" $"+parseFloat(xrp.price_usd).toFixed(2));
				jQuery(".xrp-change").text((parseFloat(xrp.percent_change_1h) >=0 ? '+' + xrp.percent_change_1h  + '%': xrp.percent_change_1h  + '%'));
				jQuery(".xrp-change").css('color',parseFloat(jQuery(".xrp-change").text()) >= 0 ? 'green' : 'red');

				jQuery(".eos").text(eos.symbol+" $"+parseFloat(eos.price_usd).toFixed(2));
				jQuery(".eos-change").text((parseFloat(eos.percent_change_1h) >=0 ? '+' + eos.percent_change_1h  + '%': eos.percent_change_1h  + '%'));
				jQuery(".eos-change").css('color',parseFloat(jQuery(".eos-change").text()) >= 0 ? 'green' : 'red');

				jQuery(".bch").text(bch.symbol+" $"+parseFloat(bch.price_usd).toFixed(2));
				jQuery(".bch-change").text((parseFloat(bch.percent_change_1h) >=0 ? '+' + bch.percent_change_1h  + '%': bch.percent_change_1h  + '%'));
				jQuery(".bch-change").css('color',parseFloat(jQuery(".bch-change").text()) >= 0 ? 'green' : 'red');

				jQuery(".sec").text(sec.symbol+" $"+parseFloat(sec.price_usd).toFixed(2));
				jQuery(".sec-change").text((parseFloat(sec.percent_change_1h) >=0 ? '+' + sec.percent_change_1h  + '%': sec.percent_change_1h  + '%'));
				jQuery(".sec-change").css('color',parseFloat(jQuery(".sec-change").text()) >= 0 ? 'green' : 'red');

				jQuery(".sev").text(sev.symbol+" $"+parseFloat(sev.price_usd).toFixed(2));
				jQuery(".sev-change").text((parseFloat(sev.percent_change_1h) >=0 ? '+' + sev.percent_change_1h  + '%': sev.percent_change_1h  + '%'));
				jQuery(".sev-change").css('color',parseFloat(jQuery(".sev-change").text()) >= 0 ? 'green' : 'red');

				jQuery(".seb").text(seb.symbol+" $"+parseFloat(seb.price_usd).toFixed(2));
				jQuery(".seb-change").text((parseFloat(seb.percent_change_1h) >=0 ? '+' + seb.percent_change_1h  + '%': seb.percent_change_1h  + '%'));
				jQuery(".seb-change").css('color',parseFloat(jQuery(".seb-change").text()) >= 0 ? 'green' : 'red');

      }
    });

//--------End of Js ---------------


</script>