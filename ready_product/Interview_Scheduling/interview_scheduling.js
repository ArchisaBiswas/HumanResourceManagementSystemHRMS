$(document).ready(function() 
{
    $('#submit').click(function (event) 
    {
        event.preventDefault();
        var form_data = $('#form').serialize();

        $.ajax
        ({
            url: "interview_scheduling.php",
            type: "GET",
            data: form_data,
            dataType: "text",
            success: function(data)
            {
                const params = new URLSearchParams(form_data);

                $("#job_role").show();
                $("#job_description").show();
                $("#job_role").append(params.get('job_role'));
                $("#job_description").append(params.get('job_description'));
                $("#export").show();

                sanitised_data = data.trim();

                if (sanitised_data.charAt(0) == "{")
                {
                    response_data = JSON.parse(sanitised_data);

                    $("#output_message").text("Interview Set Up With:");
                    $("#applicants").show();
                    $("#interviewers").show();

                    for (var i = 0; i < response_data.applicants.length; i++) 
                    {
                        var row = "<tr>";
                        row += "<td>" + response_data.applicants[i].first_name + " " + response_data.applicants[i].last_name + "</td>";
                        row += "<td>" + response_data.applicants[i].email_id + "</td>";
                        row += "<td><button id='approve-" + i + "' type='button'>Approve</button></td>";
                        row += "</tr>";
                        $("#applicants").append(row);

                        var approve = document.getElementById("approve-" + i);
                        approve.addEventListener("click", function() 
                        {
                            window.location.href = "../Onboarding/onboarding.html";
                        });
                    }

                    for (var i = 0; i < response_data.interviewers.length; i++) 
                    {
                        var row = "<tr>";
                        row += "<td>" + response_data.interviewers[i].first_name + " " + response_data.interviewers[i].last_name + "</td>";
                        row += "<td>" + response_data.interviewers[i].email_id + "</td>";
                        row += "<td>" + response_data.interviewers[i].qualifications + "</td>";
                        row += "<td>" + response_data.interviewers[i].experience_in_company + "</td>";
                        row += "</tr>";
                        $("#interviewers").append(row);
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

function exporting(event)
{
	event.preventDefault();
	content = document.getElementById("output").innerHTML;
	//document.body.innerHTML = content;
	window.print(content);
}