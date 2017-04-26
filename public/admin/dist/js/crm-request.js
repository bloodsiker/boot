var id = 0;
$(document).on('click', '.edit-request', function (e) {
    $('.panel-edit-request').css('right','0px');
    var _parent = $(this).parent('td').parent('tr');
    _parent.addClass('green');
    id = _parent.attr('data-id');
    var service_center = _parent.find('td').eq(1).text();

    // Получаем информацию о заявке из бд и подставляем в форму
    $.ajax({
        method:'GET',
        url: urlRequestInfo,
        data: {id: id, _token: token}
    }).done(function (response) {
        //console.log(response);
        $('.title-sc').text(service_center);
        $("[name='phone']").val(response.request.phone);
        $("[name='name']").val(response.request.user_name);
        $("[name='comment']").val(response.request.comment);
        $("[name='status'] :contains('" + response.request.status + "')").attr("selected", "selected");
    });

    // Обновляем информацию в бд
    $(document).on('click', '#edit-request', function () {
        var comment = $("[name='comment']").val();
        var status = $("[name='status']").val();
        $.ajax({
            method:'POST',
            url: urlRequestEdit,
            data: {id: id, comment: comment, status: status, _token: token}
        }).done(function (response) {
            //console.log(response);
            var request_id = $('[data-id="' + id + '"]');
            request_id.find('td').eq(4).text(response.comment);
            request_id.find('td').eq(5).text(response.status);
            $('.panel-edit-request').css('right','-320px');
            $('#table1').children('tbody').children('tr').removeClass('green');
        });
    })
});

// Закрываем блок с информацией о заявке
$(document).on('click', '#edit-cancel', function () {
    $('.panel-edit-request').css('right','-320px');
    $('#table1').children('tbody').children('tr').removeClass('green');
});