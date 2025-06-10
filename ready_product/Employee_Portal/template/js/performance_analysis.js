$(document).ready(function() 
{
  $.ajax
	({
        url: "performance_analysis.php",
        type: "POST",
        dataType: "json",
        success: function(data) 
        {
          
          //'use strict';
          
          var doughnutPieData = 
          {
            datasets: 
            [{
              data: data.doughnut_data,
              backgroundColor: 
              [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)'
              ],
              borderColor:
              [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
              ],
            }],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: data.doughnut_labels
          };
      
          var doughnutPieOptions = 
          {
            responsive: true,
            animation: 
            {
              animateScale: true,
              animateRotate: true
            }
          };

          var quarter1_data = 
          {
            labels: data.labels1_area_data,
            datasets: 
            [{
              label: 'Performance of Employees in Quarter 1',
              data: data.quarter1_area_data,
              backgroundColor: 
              [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: 
              [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1,
              fill: true, // 3: no fill
            }]
          };

          var quarter2_data = 
          {
            labels: data.labels2_area_data,
            datasets: 
            [{
              label: 'Performance of Employees in Quarter 2',
              data: data.quarter2_area_data,
              backgroundColor: 
              [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: 
              [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1,
              fill: true, // 3: no fill
            }]
          };

          var quarter3_data = 
          {
            labels: data.labels3_area_data,
            datasets: 
            [{
              label: 'Performance of Employees in Quarter 3',
              data: data.quarter3_area_data,
              backgroundColor: 
              [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: 
              [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1,
              fill: true, // 3: no fill
            }]
          };

          var quarter4_data = 
          {
            labels: data.labels4_area_data,
            datasets: 
            [{
              label: 'Performance of Employees in Quarter 4',
              data: data.quarter4_area_data,
              backgroundColor: 
              [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: 
              [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1,
              fill: true, // 3: no fill
            }]
          };

          var areaOptions = 
          {
            plugins: 
            {
              filler: 
              {
                propagate: true
              }
            }
          }

        
          if ($("#doughnut_chart").length) 
          {
            var doughnutChartCanvas = $("#doughnut_chart").get(0).getContext("2d");
            
            var doughnutChart = new Chart(doughnutChartCanvas, 
            {
              type: 'doughnut',
              data: doughnutPieData,
              options: doughnutPieOptions
            });
          }

          if ($("#quarter1").length) 
          {
            var areaChartCanvas = $("#quarter1").get(0).getContext("2d");

            var areaChart = new Chart(areaChartCanvas, 
            {
              type: 'line',
              data: quarter1_data,
              options: areaOptions
            });
          }

          if ($("#quarter2").length) 
          {
            var areaChartCanvas = $("#quarter2").get(0).getContext("2d");

            var areaChart = new Chart(areaChartCanvas, 
            {
              type: 'line',
              data: quarter2_data,
              options: areaOptions
            });
          }

          if ($("#quarter3").length) 
          {
            var areaChartCanvas = $("#quarter3").get(0).getContext("2d");

            var areaChart = new Chart(areaChartCanvas, 
            {
              type: 'line',
              data: quarter3_data,
              options: areaOptions
            });
          }

          if ($("#quarter4").length) 
          {
            var areaChartCanvas = $("#quarter4").get(0).getContext("2d");

            var areaChart = new Chart(areaChartCanvas, 
            {
              type: 'line',
              data: quarter4_data,
              options: areaOptions
            });
          }
        }
  });
});