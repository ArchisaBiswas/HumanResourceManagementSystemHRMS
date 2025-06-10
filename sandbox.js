$(document).ready(function() 
{
    $.ajax
	({
        url: "sandbox.php",
        type: "GET",
        dataType: "json",
        success: function(data) 
		{
			new Chart(document.getElementById("mixed-chart"), 
			{
				type: 'bar',
				data: 
				{
				  labels: ["Quarter 1", "Quarter 2", "Quarter 3", "Quarter 4"],
				  datasets: 
				   [{
					  label: "My Performance",
					  type: "line",
					  borderColor: "#8e5ea2",
					  data: data.line_data,
					  fill: false
					}, 
					{
					  label: "Average Performances",
					  type: "bar",
					  backgroundColor: "rgba(0,0,0,0.2)",
					  data: data.bar_data
					}]
				},
				options: 
				{
				  title: 
				  {
					display: true,
					text: 'My Performance Progression'
				  },
				  legend: { display: false }
				}
			});
        },

        error: function(jqXHR, textStatus, errorThrown) 
		{
            console.log("Error: " + errorThrown);
        }
    });
});