$(document).ready(function() 
{
    $.ajax
    ({
        url: "dynamic_table.php",
        type: "GET",
        dataType: "json",
        success: function(data) 
        {
            for (var i = 0; i < data.length; i++) 
            {
                var row = "<tr>";
                row += "<td>" + data[i].last_name + "</td>";
                row += "<td>" + data[i].email_id + "</td>";
                row += "</tr>";
                $("#userTable").append(row);
            }
        }
    });
});
  