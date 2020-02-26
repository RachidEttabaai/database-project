$(document).ready(function () {

    $("#target").load("pagination.php?page=1")

    $("#pagination li").on("click",function(e){
	    e.preventDefault()
		$("#pagination li").removeClass('active')
		$(this).addClass('active')
        var pageNum = $(this).attr("id")

        $.ajax({
            type: "GET",
            url: "pagination.php",
            data: { page : pageNum },
            dataType: "html",
            success: function(html){
                $("#target").html(html)
            }
        })
    })
    
})