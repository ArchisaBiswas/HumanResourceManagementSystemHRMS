$(document).ready(function() 
{
    $.ajax
    ({
        url: "managers_employees.php",
        type: "GET",
        dataType: "json",
        success: function(data)
        {
            for (var i = 0; i < data.length; i++) 
            {
                row = "<tr>";
                row += "<td>" + data[i].employee_id + "</td>";
                row += "<td>" + data[i].first_name + " " + data[i].last_name + "</td>";
                row += "<td>" + data[i].email_id + "</td>";
                row += "</tr>";
                $("#employees").append(row);
            }
        }
    });
});