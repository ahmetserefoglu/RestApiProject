$(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var dataPoints = [];
  var dataPoints2 = [];
  var dataPoints3 = [];
  var dataPoints4 = [];

  $.ajax({
    type: "GET",
    url: 'http://127.0.0.1:8000/rapor',
    data: this.value,
    success: function(data){
      console.log(data);
      if(data)
      {
        Test(data);
        Test2(data);
      }
      
      
    }
  });

  var element = {}, cart = [];

  function  Test(data){
    for (var i = 0; i < data.faturalar.length; i++) {
      dataPoints2.push(data.faturalar[i].fatura_tutar);
      dataPoints.push(data.faturalar[i].fatura_adi);
    }

    console.log(dataPoints);
    console.log(dataPoints2);

    var $salesChart = $('#sales-chart')
    var salesChart  = new Chart($salesChart, {
      type   : 'bar',
      data   : {
        labels  : dataPoints,
        datasets: [
        {
          backgroundColor: '#007bff',
          borderColor    : '#007bff',
          data           : dataPoints2,
        }
        ]
      },
      options: {
        maintainAspectRatio: false,
        tooltips           : {
          mode     : mode,
          intersect: intersect
        },
        hover              : {
          mode     : mode,
          intersect: intersect
        },
        legend             : {
          display: false
        },
        scales             : {
          yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value, index, values) {
              if (value >= 1000) {
                value /= 1000
                value += 'k'
              }
              return 'TL' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })
  }

  var mode      = 'index'
  var intersect = true


  function  Test2(data){
 for (var i = 0; i < data.gelirler.length; i++) {
      dataPoints3.push(data.gelirler[i].gelir_adi);
      dataPoints4.push(data.gelirler[i].total_gelir);
    }


    
    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: dataPoints3,
      datasets: [
        {
          data: dataPoints4,
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions      
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions      
    })


   

    console.log(dataPoints3);
    console.log(dataPoints4);
    var $visitorsChart = $('#visitors-chart')
    var visitorsChart  = new Chart($visitorsChart, {
      data   : {
        labels  : dataPoints3,
        datasets: [{
          type                : 'line',
          data                : dataPoints4,
          backgroundColor     : 'transparent',
          borderColor         : '#f44336',
          pointBorderColor    : '#f44336',
          pointBackgroundColor: '#f44336',
          fill                : false,
          pointHoverBackgroundColor: '#007bff',
          pointHoverBorderColor    : '#007bff'
      }]
      },
      options: {
        maintainAspectRatio: false,
        tooltips           : {
          mode     : mode,
          intersect: intersect
        },
        hover              : {
          mode     : mode,
          intersect: intersect
        },
        legend             : {
          display: false
        },
        scales             : {
          yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero : true,
            suggestedMax: 200
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })
  }


  
})
