
// Заявки на ремонт для сервисных центров
// Добавляем блок с информацией о заявке
$(document).on('click', '#request-reject', function (e) {
    e.preventDefault();
    $('.cancel_comment').remove();
    var _this = $(this);
    var html = "<div class='cancel_comment'>"
        + "<textarea name='cancel_comment' id='text-reject' style='width: 100%;' rows='4'></textarea>"
        + "<button id='cancel-reject' class='btn btn-danger pull-left btn-xs'>Отмена</button>"
        + "<button id='send-reject' class='btn btn-success pull-left btn-xs'>Отправить</button>"
        + "<div class='clearfix'></div>"
        + "</div>";
    _this.after(html);


    //Если не заполнено поле комментарий, блокируем кнопку
    $('#send-reject').attr('disabled', true);
    $("[name='cancel_comment']").on('keyup', function () {
        if ($("[name='cancel_comment']").val().length < 3) {
            $('#send-reject').attr('disabled', true)
        } else {
            $('#send-reject').removeAttr('disabled');
        }
    });

    // Удаляем форму с комментариями
    $('#cancel-reject').on('click', function (e) {
        e.preventDefault();
        $('.cancel_comment').remove();
    })
});




// Заявки на помощь в подборе
// Добавляем блок с информацией о заявке
$(document).on('click', '#request-close', function (e) {
    e.preventDefault();
    $('.operator_comment').remove();
    var _this = $(this);
    var html = "<div class='operator_comment'>"
        + "<textarea name='operator_comment' style='width: 100%;' rows='4'></textarea>"
        + "<button id='cancel-completed' class='btn btn-danger pull-left btn-xs'>Отмена</button>"
        + "<button id='send-completed' class='btn btn-success pull-left btn-xs'>Отправить</button>"
        + "<div class='clearfix'></div>"
        + "</div>";
    _this.after(html);


    //Если не заполнено поле комментарий, блокируем кнопку
    $('#send-completed').attr('disabled', true);
    $("[name='operator_comment']").on('keyup', function () {
        if ($("[name='operator_comment']").val().length < 3) {
            $('#send-completed').attr('disabled', true)
        } else {
            $('#send-completed').removeAttr('disabled');
        }
    });

    // Удаляем форму с комментариями
    $('#cancel-completed').on('click', function (e) {
        e.preventDefault();
        $('.operator_comment').remove();
    })
});