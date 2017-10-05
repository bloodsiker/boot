
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
    });
});

// Сервисный центер модерирует заявку от клиента
// Добавляем блок с деадлайном
$(document).on('click', '#add-deadline', function (e) {
    e.preventDefault();
    $('.request-deadline').remove();
    var _this = $(this);
    var html = "<div class='request-deadline'>"
        + "<div class='input-group date'>"
        + "<input type='date' name='deadline' class='form-control pull-right' id='datepicker'>"
        + "</div>"
        + "<div class='form-group'>"
        + "<label><input type='checkbox' name='client_notification' class='minimal' checked>"
        + "Проинформировать клиента о deadline</label>"
        + "</div>"
        + "<button id='cancel-completed' class='btn btn-danger pull-left btn-xs'>Отмена</button>"
        + "<button id='send-completed' class='btn btn-success pull-left btn-xs'>Отправить</button>"
        + "<div class='clearfix'></div>"
        + "</div>";
    _this.after(html);


    // Удаляем форму с комментариями
    $('#cancel-completed').on('click', function (e) {
        e.preventDefault();
        $('.request-deadline').remove();
    });
});


// Исполнитель переводит заявку в статус Выполнена
$(document).on('click', '#request-completed', function (e) {
    e.preventDefault();
    $('.request-completed').remove();
    var _this = $(this);
    var html = "<div class='request-completed'>"
        + "<div class='form-group'>"
        + "Подтвердите выполнение задания и окончательную стоимость"
        + "<input type='number' step='0.01' name='cost_of_work_end' required> ГРН"
        + "</div>"
        + "<button id='cancel-completed' class='btn btn-danger pull-left btn-xs'>Отмена</button>"
        + "<button id='send-completed' class='btn btn-success pull-left btn-xs'>Отправить</button>"
        + "<div class='clearfix'></div>"
        + "</div>";
    _this.after(html);

    //Если не заполнено поле комментарий, блокируем кнопку
    $('#send-completed').attr('disabled', true);
    $("[name='cost_of_work_end']").on('keyup', function () {
        if ($("[name='cost_of_work_end']").val().length < 1) {
            $('#send-completed').attr('disabled', true)
        } else {
            $('#send-completed').removeAttr('disabled');
        }
    });

    // Удаляем форму с комментариями
    $('#cancel-completed').on('click', function (e) {
        e.preventDefault();
        $('.request-completed').remove();
    });
});

// Время реагирования
(function () {
    $(document).ready(function() {
        var tdList = document.getElementsByClassName('response-time');


        var timerId = setTimeout(function tick() {
            for(var i = 0; i < tdList.length; i++) {
                var status = tdList[i].getAttribute('data-status');
                if (status === '1') {
                    var DATE = tdList[i].getAttribute('data-time');
                    var res = tdList[i].getAttribute('data-res');
                    var resTime = moment(DATE, "YYYY-MM-DD hh:mm:ss").add(res, 'minutes').fromNow();
                    tdList[i].innerHTML = resTime;
                }
            }
            timerId = setTimeout(tick, 1000);
        }, 1000);


    });
})();
