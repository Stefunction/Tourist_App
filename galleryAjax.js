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
                var gal = result[index];                      //get a single DVD from result array             

                var htmlCode = "<div class='w3-card-4 w3-third w3-display-container w3-margin-bottom'>";
                htmlCode += "<img src=" + gal["uploadPath"] + " alt='Uploaded_Pic Description' style='width:100%' class='w3-hover-opacity'>";
                htmlCode += "<div class='w3-display-topleft w3-container w3-text-black'>";
                htmlCode += "<h5 style='color: white;'>" + gal["userName"] + "</h5></div>";
                htmlCode += "<div class='w3-container w3-white'>";
                htmlCode += "<h5 class='p-2'><b>Lorem Ipsum</b></h5>";
                htmlCode += "<div class='row'>";
                htmlCode += "<p class='col-md-6'>" + gal["categoryName"] + "</p>";
                htmlCode += "<p class='col-md-6'>" + gal["date"] + "</p>";
                htmlCode += "<p class='me-2'>" + gal["description"] + "!</p>";
                htmlCode += "</div></div></div>";
                $("#gallery-grid").append(htmlCode);      //add a child to table body





            }
        } //end callback function
    ); //end function call
} //end function




