$(document).ready(function(){

    $('#generate').click(function () {

        $("#qr-code").html('');
        $("#b64").val('');
        $("#download").hide();

        var data = [];

        data[0] = $("input[name='text']").val();
        data[1] = $("input[name='fill']").val();
        data[2] = $("input[name='background']").val();

        $.ajax({
            type: "POST",
            url: '/ajax/qr-generate/preview',
            data: {data: data},
            success: function(data) {
                $("#qr-code").append('<img  src="data:image/png;base64, '+data+'" >');
                $("#b64").val(data);
                $("#download").show();

            }
        });

    });
});