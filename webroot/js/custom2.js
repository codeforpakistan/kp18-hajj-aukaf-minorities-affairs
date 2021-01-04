//$(function () {
////    $('#qualification_list').hide();
//    $('#fund_id').change(function () {
//        var fund_id = $(this).val();
//        $.ajax({
//            type: "GET",
//            contentType: 'json',
//            url: "services",
//            data: "fund_subcategory=" + fund_id,
//            success: function (data) {
//                data = JSON.parse(data);
//                if (data == 3) {
//                    $('#q_num').text('4');
//                    $('#c_num').text('5');
//                    $('#qualification_list').show();
//                } else {
//                    $('#qualification_list').hide();
//                    $('#c_num').text('4');
//                }
//
//            }, error: function (error) {
//                alert(json.stringify(error));
//            }
//        });
//        if (fund_id) {
//            $.ajax({
//                type: "GET",
//                contentType: 'json',
//                url: "services",
//                data: "fund_id=" + fund_id,
//                success: function (data) {
//                    data = JSON.parse(data);
//                    $('#attach_doc').remove();
//                    $('#attachments').after('<p id="attach_doc" style="color:red">' + data + '</p>');
//                }, error: function (error) {
//                    alert(json.stringify(error));
//                }
//            });
//        } else {
//            $('#attach_doc').remove();
//        }
//    });
//});