$(document).ready(function () {
    
    $("#search_form").on("submit",function (e) { 
        e.preventDefault()
        $.ajax({
            type: "POST",
            url: "search.php",
            data:"search="+$("#search").val()+"&where="+$("#where").val(),
            dataType: "html",
            success: function(html){
                $("#resultsearch").html(html)
            }
        })
    })

})