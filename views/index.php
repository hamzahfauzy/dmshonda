<?php $this->load("partial.header") ?>
<?php $this->load("partial.nav") ?>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3">
			<br>
			<h2 align="center">Top 5 Sales</h2>
			<div class="top5sales"></div>
		</div>

		<div class="col-sm-6">
			<br>
			<h2 align="center">Target vs Sales</h2>
			<canvas id="myChart"></canvas>
		</div>

		<div class="col-sm-3">
			<br>
			<h2 align="center">Stok</h2>
			<canvas id="horizontalBar"></canvas>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<br>
			<h2 align="center">Sales performance</h2>
			<div class="salesgoals"></div>
		</div>
	</div>
	<div class="row">
		<br><br><br>
		<div style="width: 50%;margin: auto;">
		<center>&copy; copyright 2019 . DMS Honda</center>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?=$this->assets->get("mdb/js/popper.min.js") ?>"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="<?=$this->assets->get("mdb/js/bootstrap.min.js") ?>"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="<?=$this->assets->get("mdb/js/mdb.min.js") ?>"></script>
<script type="text/javascript">
  var chart_labels = [];
  var chart_data = [];
  var chart_bg = [];
  var chart_border = [];

  var chart_stok = [];
  var chart_stok_label = [];

  var old_data = "";
  var old_stok = "";

  function setChart()
  {
  	$.get("<?=base_url()?>/targetsales",function(response){
  		if(JSON.stringify(old_data) === JSON.stringify(response))
  		{
  		}else{
  			old_data = response

	  		chart_labels = [];
	  		chart_data = [];
	  		chart_bg = [];
	  		chart_border = [];
	  		total_target = 0;
	  		total_penjualan = 0;
	  		for (var key in response.kategori) {
			    if (response.kategori.hasOwnProperty(key)) {
			        chart_labels.push(response.kategori[key].nama+" (target)")
			        chart_labels.push(response.kategori[key].nama+" (penjualan)")

			        chart_data.push(response.kategori[key].target)
	  				chart_data.push(response.kategori[key].penjualan)

	  				chart_bg.push("rgba(255, 206, 86, 0.2)")
	  				chart_bg.push("rgba(75, 192, 192, 0.2)")

	  				chart_border.push("rgba(255, 206, 86, 1)")
	  				chart_border.push("rgba(75, 192, 192, 1)")

	  				total_target += response.kategori[key].target
	  				total_penjualan += response.kategori[key].penjualan
			    }
			}

			chart_data.push(total_target)
			chart_data.push(total_penjualan)

			chart_bg.push("rgba(255, 206, 86, 0.2)")
	  		chart_bg.push("rgba(75, 192, 192, 0.2)")

	  		chart_border.push("rgba(255, 206, 86, 1)")
	  		chart_border.push("rgba(75, 192, 192, 1)")
	  		// ["AT (target)", "AT (sales)", "Bebek (target)", "Bebek (sales)", "Sport (target)", "Sport (sales)", "Total (target)", "Total (sales)"]
	  		chart_labels.push("Total (target)")
	  		chart_labels.push("Total (sales)")

		    var ctx = document.getElementById("myChart").getContext('2d');
			var myChart = new Chart(ctx, {
			    type: 'bar',
			    data: {
			      labels: chart_labels, //["AT (target)", "AT (sales)", "Bebek (target)", "Bebek (sales)", "Sport (target)", "Sport (sales)", "Total (target)", "Total (sales)"],
			      datasets: [{
			        label: '# Target',
			        data: chart_data,
			        backgroundColor: chart_bg,
			        borderColor: chart_border,
			        borderWidth: 1
			      }]
			    },
			    options: {
			      scales: {
			        yAxes: [{
			          ticks: {
			            beginAtZero: true
			          }
			        }]
			      }
			    }
			});
		}
  	},"json")
  }


function top5sales()
{
	$.get("<?=base_url()?>/top5sales",function(response){
		$(".top5sales").html(response)
	})
}

function salesgoals()
{
	$.get("<?=base_url()?>/salesgoals",function(response){
		$(".salesgoals").html(response)
	})
}

top5sales();
salesgoals();
setChart();
stok();
setInterval(setChart,5000)
setInterval(stok,5000)
setInterval(top5sales,5000)
setInterval(salesgoals,5000)

function stok()
{
	$.get("<?=base_url()?>/stok",function(response){
		if(JSON.stringify(old_stok) === JSON.stringify(response))
		{

		}else{
			old_stok = response
			var chart_stok = [];
  			var chart_stok_label = [];
	  		for (var key in response.stok) {
			    if (response.stok.hasOwnProperty(key)) {
			        chart_stok.push(response.stok[key].stok)
			        chart_stok_label.push(response.stok[key].nama)
			    }
			}
			new Chart(document.getElementById("horizontalBar"), {
			    "type": "horizontalBar",
			    "data": {
			      "labels": chart_stok_label,
			      "datasets": [{
			        "label": "Sales goals",
			        "data": chart_stok,
			        "fill": false,
			        "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)", "rgba(255, 205, 86, 0.2)"
			        ],
			        "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
			        ],
			        "borderWidth": 1
			      }]
			    },
			    "options": {
			      "scales": {
			        "xAxes": [{
			          "ticks": {
			            "beginAtZero": true
			          }
			        }]
			      }
			    }
			});
		}
	},"json")
}
</script>
<?php $this->load("partial.footer") ?>