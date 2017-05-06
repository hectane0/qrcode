$(document).ready(function(){

    $('#check-occupied').click(function () {
        var url = $("input[name='url']").val();
        $("#suggests").hide();

        if(!url) {
            alert("Wartość nie może być pusta");
            return;
        }

        var firstTry = $("input[name='firstTry']");
        if (!firstTry.val()) {
            firstTry.val(url);
        }

        $.ajax({
            type: "POST",
            url: '/ajax/check-occupied',
            data: {url: url},
            dataType: 'json',
            success: function(data) {
                $("#occupied-info").html(data[1]);
                $("#suggestions").html("");
                $.each(data[2], function (index, value) {
                    $("#suggestions").append("<a class='suggestion' style='cursor: pointer'>"+value+"</a>");
                    $("#suggests").show();
                })
            }
        });

    });

    $(document).on("click", ".suggestion" , function () {
        $("input[name='url']").val(this.text);
        $("#occupied-info").html("");
    })
});