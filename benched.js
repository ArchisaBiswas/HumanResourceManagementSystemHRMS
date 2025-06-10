function pick_range()
{
    document.getElementById("offering").style.visibility = "hidden";
    document.getElementById("pick1").style.visibility = "visible";
    document.getElementById("pick2").style.visibility = "visible";
}

function back_range()
{
    document.getElementById("offering").style.visibility = "visible";
    document.getElementById("pick1").style.visibility = "hidden";
    document.getElementById("pick2").style.visibility = "hidden";
}

$(document).ready(function() 
{
    $('#submit').click(function (event) 
    {
        event.preventDefault();
        var form_data = $('#form').serialize();

        $.ajax
        ({
            url: "benched.php",
            type: "GET",
            data: form_data,
            dataType: "text",
            success: function(data)
            {
                sanitised_data = data.trim();

                if ((sanitised_data.charAt(0) == "{") || (sanitised_data.charAt(0) == "["))
                {
                    response_data = JSON.parse(sanitised_data);

                    $("#output_message").text("Results Matched!");
                    $("#results").show();

                    for (var i = 0; i < response_data.length; i++) 
                    {
                        var row = "<tr>";
                        row += "<td>" + response_data[i]["first_name"] + " " + response_data[i]["last_name"] + "</td>";
                        row += "<td>" + response_data[i]["email_id"] + "</td>";
                        row += "<td>" + response_data[i]["phone_no"] + "</td>";
                        row += "</tr>";
                        $("#results").append(row);
                    }
                }
                else
                {
                    response_data = data;
                    $("#output_message").text(response_data);
                }
            }
        });
    });
});