
$(document).ready(function () {
    $("#keyword").on('keyup', function () {         //Capture keyup on the id keyword
        var keyword = $(this).val();                //return value to variable keyword

        $.ajax({
            url: "filter-gallery.php",
            data: { "keyword": keyword },
            beforeSend: function () {
                $("#gallery-grid").html("<span class='w3-lime p-2'>No associated Keyword Found, Try again...</span>");
            },
            success: function (result) {
                $("#gallery-grid").empty();   //empty grid
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

                    $("#gallery-grid").append(htmlCode);      //append to gallery grid
                }
            }
        });
    });
});









