$(document).ready(function() 
{
    $.ajax
	({
        url: "employee_portal.php",
        type: "GET",
        dataType: "json",
        success: function(data) 
		{
			average = data.line_data.reduce((a, b) => a + b) / data.line_data.length;
            average = average.toFixed(2); 

            document.getElementById("average_performance").innerHTML = average.toString() + "/10";

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
					  label: "Average Performance",
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

function printing(event)
{
	event.preventDefault();
	content = document.getElementById("print").innerHTML;
	//document.body.innerHTML = content;
	window.print(content);
}