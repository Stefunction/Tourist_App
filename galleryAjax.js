/*
 * The document ready function which runs automatically after the HTML page is loaded.
 */

$(function () {
    //set up the click handler of the search button.
    $("#searchButton").click(function () {
        search_Gallery();
    }
    );

    //populate the table after the page is loaded.
    search_Gallery();
} //end document ready function
);


//  Function to handle search button.

function search_Gallery() {
    var keyword = $("#keyword").val();    //get value of keyword text field
    populateGrid(keyword);             //populate table
} //end function




// Function to populate grid using Ajax.

function populateGrid(keyword) {
    var url = "filter-gallery.php";              //request URL
    var data = { "keyword": keyword };   //request parameters as a map

    //send Ajax request
    $.getJSON(url,
        data,
        function (result) {
            $("#gallery-grid").empty();   //remove all children first
            for (var index in result)       //iterate through the reply (in JSON)
            {
                var gal = result[index];                      //get a single  from result array             

                var htmlCode = "<div class='col-md-4'><div class='card'>";
                htmlCode += "<img src=" + gal["uploadPath"] + " alt='Uploaded_Pic Description' style='width:100%' class='w3-hover-opacity card-img-top'>";
                htmlCode += "<div class='card-body'><h5 class='p-2'><b>" + gal["categoryName"] + "</b></h5><div class='row'>";
                htmlCode += "<p class='col-md-6'>Owner: " + gal["userName"] + "</p>";
                htmlCode += "<p class='col-md-6'>Date: " + gal["date"] + "</p>";
                htmlCode += "<p class='col'><strong>Description: </strong> " + gal["description"] + "</p>";
                htmlCode += "<p class='col-md-12'><strong>URL: </strong> " + gal["url"] + "</p>";

                htmlCode += "</div></div></div></div>";
                $("#gallery-grid").append(htmlCode);      //add a child to table body


            }
        } //end callback function
    ); //end function call
} //end function




