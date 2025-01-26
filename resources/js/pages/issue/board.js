const draggables = $(".task");
const droppables = $(".swim-lane");

draggables.each((i, task) => {
    task.addEventListener("dragstart", () => {
        task.classList.add("is-dragging");
    });

    task.addEventListener("dragend", () => {
        let statuses = document.querySelectorAll('.status');
        let arr = {};

        statuses.forEach(function (element) {
            let tasks = [...element.querySelectorAll('.task')]
            arr[element.dataset.id] = tasks.map(a => a.dataset.id);
        });

        let formData = {
            'tasksArray': arr,
        };

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            url: route('issues.reorder'),
            data: formData,
            success: () => {

            },
        });
        task.classList.remove("is-dragging");
    });
});

droppables.each((i, zone) => {
    zone.addEventListener("dragover", (e) => {
        e.preventDefault();

        const bottomTask = insertAboveTask(zone, e.clientY);
        const curTask = document.querySelector(".is-dragging");

        if (!bottomTask) {
            zone.appendChild(curTask);
        } else {
            zone.insertBefore(curTask, bottomTask);
        }
    });
});

const insertAboveTask = (zone, mouseY) => {
    const els = zone.querySelectorAll(".task:not(.is-dragging)");
    let closestTask = null;
    let closestOffset = Number.NEGATIVE_INFINITY;
    els.forEach((task) => {
        const {top} = task.getBoundingClientRect();
        const offset = mouseY - top;
        if (offset < 0 && offset > closestOffset) {
            closestOffset = offset;
            closestTask = task;
        }
    });

    return closestTask;
};

var updateModal = $('.modal#update-modal');
var createModal = $('.modal#create-modal');

createModal.on('shown.bs.modal', function (e) {
    $(e.currentTarget).find('#submit').prop('disabled', false);
    $(this).find('input[autofocus]').focus();
})

createModal.on('hidden.bs.modal', function (e) {
    $(e.currentTarget).find('#submit').prop('disabled', true);
})

createModal.on('submit', 'form', function (e) {
    e.preventDefault();
    var form = $(this);
    let dangerLabel = $('#danger-label-create');
    var formData = new FormData(form[0]);
    $.ajax({
        type: 'POST',
        url: route('issues.store'),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: () => {
            createModal.modal('toggle');
            if(dangerLabel.length > 0){
                dangerLabel.remove();
                $('.has-error').removeClass("has-error");
            }
            setTimeout(() => {
                form.trigger('reset');
            }, 300);
        },
        error: response => {
            if(dangerLabel.length > 0) {
                dangerLabel.remove();
                $('.has-error').removeClass("has-error");
            }
            $.each(response.responseJSON.errors, function (key, value) {
                var input = form.find(`input[name=${key}]`),
                    inputContainer = input.parent().parent(),
                    errorContainer = inputContainer.find('label.text-danger-500');
                var svg = feather.icons['x'].toSvg({class: 'icon-wrapper', height: 10})
                if (errorContainer.length) {
                    errorContainer.html(svg + value[0]);
                } else {
                    inputContainer.append(`<label class="text-danger" id='danger-label-create' for="${input.attr('id')}">${svg} ${value[0]}</label>`);
                }
                input.addClass('has-error');
            });
        },
    });
});

updateModal.on('shown.bs.modal', function (e) {
    $(e.currentTarget).find('input[name="id"]').val($(e.relatedTarget).data('id'));
    $(e.currentTarget).find('input[name="name"]').val($(e.relatedTarget).data('name'));
    $(e.currentTarget).find('#submit').prop('disabled', false);
    $(e.currentTarget).find('#delete').prop('disabled', false);
    $(this).find('input[autofocus]').focus();
})

updateModal.on('hidden.bs.modal', function (e) {
    $(e.currentTarget).find('#submit').prop('disabled', true);
    $(e.currentTarget).find('#delete').prop('disabled', true);
})

updateModal.on('submit', 'form', function (e) {
    e.preventDefault();
    var form = $(this);
    var formData = new FormData(form[0]);
    $.ajax({
        type: 'POST',
        url: route('issues.update'),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: () => {
            updateModal.modal('toggle');
            setTimeout(() => {
                form.trigger('reset');
            }, 300);
        },
        error: response => {
            $.each(response.responseJSON.errors, function (key, value) {
                var input = form.find(`input[name=${key}]`),
                    inputContainer = input.parent().parent(),
                    errorContainer = inputContainer.find('label.text-danger-500');
                var svg = feather.icons['x'].toSvg({class: 'icon-wrapper'})
                if (errorContainer.length) {
                    errorContainer.html(svg + value[0]);
                } else {
                    inputContainer.append(`<label class="text-danger" for="${input.attr('id')}">${svg} ${value[0]}</label>`);
                }
                input.addClass('has-error');
            });
        },
    });
});

updateModal.find('#delete').on('click', function () {
    var form = updateModal.find('#form');
    var formData = new FormData(form[0]);
    $.ajax({
        type: 'POST',
        url: route('issues.delete'),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: () => {
            updateModal.modal('toggle');
            setTimeout(() => {
                form.trigger('reset');
            }, 300);
        },
    });
});
