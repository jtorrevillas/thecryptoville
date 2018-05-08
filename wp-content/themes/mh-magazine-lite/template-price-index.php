<?php
/**
 * Template Name: Price Index
 * Description: 
 *
 */

get_header();
$symbols = array(
	10 => array(
		'symbol' => 'BTC',
		'currencies' => ['USD','EUR','GBP','JPY','RUR'],
		'sidebar_news_title' => 'Bitcoin Price News',
		'post_tag' => 'bitcoin-price'
	),
	12 => array(
		'symbol' => 'BCH',
		'currencies' => ['USD','EUR','GBP','JPY','RUR'],
		'sidebar_news_title' => 'Bitcoin Cash Price News',
		'post_tag' => 'bitcoin-cash'
	),
	14 => array(
		'symbol' => 'ETH',
		'currencies' => ['USD','EUR','GBP','JPY','RUR'],
		'sidebar_news_title' => 'Ethereum Price News',
		'post_tag' => 'ethereum-price'
	),
	16 => array(
		'symbol' => 'LTC',
		'currencies' => ['USD','EUR'],
		'sidebar_news_title' => 'Litecoin Price News',
		'post_tag' => 'litecoin'
	),
	18 => array(
		'symbol' => 'XRP',
		'currencies' => ['USD','EUR'],
		'sidebar_news_title' => 'Ripple Price News',
		'post_tag' => 'ripple'
	),
	20 => array(
		'symbol' => 'XMR',
		'currencies' => ['USD','EUR'],
		'sidebar_news_title' => 'Monero Price News',
		'post_tag' => 'monero'
	),
);

$symbol = $symbols[get_the_ID()]['symbol'];
$sidebar_news_title = $symbols[get_the_ID()]['sidebar_news_title'];
$post_tag = $symbols[get_the_ID()]['post_tag'];
$currencies = implode(',', $symbols[get_the_ID()]['currencies']);
$currenciesRaw = $symbols[get_the_ID()]['currencies'];

?>
<script type="text/javascript">
	// CONFIG
	var GLOBAL_SYMBOL = <?php echo "\"$symbol\""; ?>;
	var GLOBAL_CURRENCIES = <?php echo "\"$currencies\""; ?>;
	var GLOBAL_CURRENCIES_RAW = <?php echo "\"$currenciesRaw\""; ?>;
	console.log(GLOBAL_CURRENCIES_RAW);
	var GLOBAL_CURRENCY_SYMBOLS = {"USD":"$","EUR":"€","GBP":"£","JPY":"¥","RUR":"₽"};
	var GLOBAL_CURRENCY_EXCHANGES = {
		'BTC': {"USD":["Index","Bitfinex","GDAX","Bitstamp","Gemini","BitTrex","Kraken","HitBTC"],"EUR":["Index","Kraken","Bitstamp","GDAX","Gatecoin","Exmo","Quoine"],"GBP":["Index","Coinfloor","LakeBTC","GDAX","Localbitcoins","Kraken"],"CNY":["Index","OKCoin CNY","Huobi","Localbitcoins"],"JPY":["Index","Coincheck","Zaif","Quoine","LakeBTC"],"RUR":["Index","Livecoin","Exmo"]},

		'BCH': {"USD":["Index","Bitfinex","BitTrex","HitBTC","Kraken","Poloniex"],"EUR":["Index","Kraken"],"GBP":["Index","Coinfloor"],"CNY":["Index","OKCoin CNY","Bter"],"JPY":["Index","Zaif","Quoine"],"RUR":["Index","Livecoin"]},

		'ETH': {"USD":["Index","Bitfinex","HitBTC","GDAX","Kraken","Gemini","Poloniex"],"EUR":["Index","GDAX","Bitstamp","Kraken","Gatecoin","Exmo","HitBTC"],"GBP":["Index","Kraken"],"CNY":["Index","OKCoin CNY"],"JPY":["Index","Quoine","Kraken"],"RUR":["Index","YoBit","Exmo","Livecoin"]},

		'LTC': {"USD":["Index","Bitfinex","HitBTC","GDAX","Kraken"],"EUR":["Index","GDAX","Bitstamp","Kraken"],"GBP":["Index"],"CNY":["Index","OKCoin CNY"],"JPY":["Index"],"RUR":["Index"]},

		'XRP': {"USD":["Index","Bitfinex","HitBTC","Kraken","Poloniex"],"EUR":["Index"],"GBP":["Index"],"CNY":["Index","OKCoin CNY"],"JPY":["Index"]},

		'XMR': {"USD":["Index","Bitfinex","HitBTC","Kraken","Poloniex"],"EUR":["Index","Kraken","Exmo"],"GBP":["Index"],"CNY":["Index","OKCoin CNY"],"RUR":["Index"]},
	};

	document.addEventListener("DOMContentLoaded", function(event) { 
		var currency = "USD";
		var symbol = GLOBAL_SYMBOL;
		var currencies = GLOBAL_CURRENCIES;

		function resetSummaryDetails() {
			var data = {
				'crypto_open24h'	: '-',
				'crypto_high24h'	: '-',
				'crypto_low24h'		: '-',
				'crypto_lastprice'	: '-',
				'crypto_lastpriceH'	: '-',
				'crypto_total'		: '-',
				'crypto_mktcap'		: '-',
				'crypto_vol24h'		: '-',
				'crypto_voldot24h'	: '-',
				'crypto_daily'		: '-',
				'crypto_weekly'		: '-',
				'crypto_monthly'	: '-',
			}

			for (var property in data) {
				var elem = document.getElementById(property);
				elem.innerHTML = data[property];
			}
		}

		function fillSummaryDetails(data, originPrices) {
			// PERCENTAGES
			// -- DAILY
			var Change1D = data.RAW[symbol][currency].PRICE - data.RAW[symbol][currency].OPEN24HOUR;
			var ChangePct1D = Change1D / data.RAW[symbol][currency].OPEN24HOUR * 100;
			ChangePct1D = (Math.floor(ChangePct1D * 100) / 100).toFixed(2);

			// -- WEEKLY
			var Change1W = data.RAW[symbol][currency].PRICE - originPrices[currency].WeekOpen;
			var ChangePct1W = Change1W / originPrices[currency].WeekOpen * 100;
			ChangePct1W = (Math.floor(ChangePct1W * 100) / 100).toFixed(2);
			ChangePct1W = isFinite(ChangePct1W) ? ChangePct1W : 0;

			// -- MONTHLY
			var Change1M = data.RAW[symbol][currency].PRICE - originPrices[currency].MonthOpen;
			var ChangePct1M = Change1M / originPrices[currency].MonthOpen * 100;
			ChangePct1M = (Math.floor(ChangePct1M * 100) / 100).toFixed(2);
			ChangePct1M = isFinite(ChangePct1M) ? ChangePct1M : 0;

			var data = {
				'crypto_open24h'	: data.DISPLAY[symbol][currency].OPEN24HOUR,
				'crypto_high24h'	: data.DISPLAY[symbol][currency].HIGH24HOUR,
				'crypto_low24h'		: data.DISPLAY[symbol][currency].LOW24HOUR,
				'crypto_lastprice'	: data.DISPLAY[symbol][currency].PRICE,
				'crypto_lastpriceH'	: data.DISPLAY[symbol][currency].PRICE,
				'crypto_total'		: data.DISPLAY[symbol][currency].SUPPLY,
				'crypto_mktcap'		: data.DISPLAY[symbol][currency].MKTCAP,
				'crypto_vol24h'		: data.DISPLAY[symbol][currency].VOLUME24HOUR,
				'crypto_voldot24h'	: data.DISPLAY[symbol][currency].VOLUME24HOURTO,
			}

			for (var property in data) {
				var elem = document.getElementById(property);
				elem.innerHTML = data[property];
			}

			document.getElementById('crypto_daily').innerHTML = Math.abs(ChangePct1D) + '%';
			document.getElementById('crypto_weekly').innerHTML = Math.abs(ChangePct1W) + '%';
			document.getElementById('crypto_monthly').innerHTML = Math.abs(ChangePct1M) + '%';

			document.getElementById('crypto_daily').className = (ChangePct1D >= 0) ? 'pull-right positive' : 'pull-right negative';
			document.getElementById('crypto_weekly').className = (ChangePct1W >= 0) ? 'pull-right positive' : 'pull-right negative';
			document.getElementById('crypto_monthly').className = (ChangePct1M >= 0) ? 'pull-right positive' : 'pull-right negative';
		}

		function updateOriginPrices() {
			var url = 'https://api.cointrend.club/data/priceHistory?fsym=' + symbol + '&tsyms=' + currencies;
			var xhr = typeof XMLHttpRequest != 'undefined' ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

			xhr.open('get', url, true);
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					var status = xhr.status;

					if (status == 200) {
						var data = JSON.parse(xhr.responseText);
						updateSummary(data);
					}
				}
			};
			xhr.send();
		}

		function updateSummary(originPrices) {
			var url = "https://api.cointrend.club/data/pricemultifull?fsyms=" + symbol + "&tsyms=" + currencies;
			var xhr = typeof XMLHttpRequest != 'undefined' ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

			xhr.open('get', url, true);
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					var status = xhr.status;

					if (status == 200) {
						var data = JSON.parse(xhr.responseText);
						fillSummaryDetails(data, originPrices);
					}
				}
			};
			xhr.send();
		}

		function toggleCurrency(c) {
			currency = c;
			updateOriginPrices();
		}
 
	    var buttons = document.querySelectorAll('li.currency-item');
		[].forEach.call(buttons, function(el) {
			el.addEventListener('click', function(e) {
				// remove active class
				var elems = document.querySelectorAll(".currency-item.active");
				[].forEach.call(elems, function(el) {
				    el.classList.remove("active");
				});

				e.target.parentElement.className += ' active';
				toggleCurrency(e.target.innerHTML);
			});
		});
		// 
		updateOriginPrices();
	});
</script>

<div class="mh-wrapper mh-clearfix">
	<div id="main-content" class="mh-content" role="main">

	</div>
	<aside class="mh-widget-col-1 mh-sidebar">
		
	</aside>
</div>

<?php get_footer(); ?>
