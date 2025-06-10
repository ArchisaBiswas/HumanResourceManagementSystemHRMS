$(document).ready(function() 
{
    $.ajax
    ({
        url: "retrieve_employees.php",
        type: "GET",
        dataType: "json",
        success: function(data)
        {
            for (var i = 0; i < data.length; i++) 
            {
                row = "<tr>";
                row += "<td>" + data[i].employee_id + "</td>";
                row += "<td>" + data[i].first_name + " " + data[i].last_name + "</td>";
                row += "<td><input type='text' name='ratings'></td>";
                row += "</tr>";
                $("#enter_performances").append(row);
            }
        }
    });

    $('#submit').click(function (event) 
    {
        event.preventDefault();

        quarter = document.getElementById("quarter").value;

        form = document.getElementById("form");
        form_data = new FormData(form);
        ratings = form_data.getAll("ratings");

        const xhr = new XMLHttpRequest();

        xhr.open("POST", "employee_performances.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() 
        {
            if (xhr.readyState === 4 && xhr.status === 200) 
            {
                console.log(xhr.responseText);
            }
        };

        data = "quarter=" + encodeURIComponent(quarter) + "&ratings=" + encodeURIComponent(ratings.join(";"));
        xhr.send(data);     
    })    
});