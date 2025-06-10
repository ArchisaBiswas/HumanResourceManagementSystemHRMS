$(document).ready(function() 
{
    $.ajax
    ({
        url: "dependents.php",
        type: "GET",
        dataType: "text",
        success: function(data)
        {
            if (data.charAt(0) == "{")
            {
                response_data = JSON.parse(data);

                document.getElementById("name").innerHTML = response_data.employee_name[0].first_name + " " + response_data.employee_name[0].last_name;

                container = document.getElementById("container");

                //style="position: static !important;"

                for (i = 0; i < response_data.information.length; i++) 
                {
                    divHtml = '<div style="position: static !important;" class="dropdown-menu show" aria-labelledby="dropdownMenuButton2">\n';
                    divHtml += '<h6 class="dropdown-header">' + response_data.information[i].relationship_to_employee + '</h6>\n';

                    divHtml += '<a class="dropdown-item" href="#"> Name: ' + response_data.information[i].name + '</a>\n';

                    date_of_birth = response_data.information[i].date_of_birth;

                    date_parts = date_of_birth.split('-');
                    formatted_date_of_birth = date_parts[2] + '-' + date_parts[1] + '-' + date_parts[0];

                    divHtml += '<a class="dropdown-item" href="#"> Date of Birth: ' + formatted_date_of_birth + '</a>\n';
                    divHtml += '</div>';
                    container.insertAdjacentHTML('beforeend', divHtml);
                }
            }
            else
            {
                console.log(data);
            }
        }
    });
});