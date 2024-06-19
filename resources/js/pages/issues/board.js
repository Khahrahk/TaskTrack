// const draggables = $(".task");
// const droppables = $(".swim-lane");
//
// draggables.each((i, task) => {
//     task.addEventListener("dragstart", () => {
//
//         task.classList.add("is-dragging");
//     });
//     task.addEventListener("dragend", () => {
//         console.log(task.closest('.status').getAttribute('data-id'));
//         console.log(task.getAttribute('data-id'));
//
//         let formData = {
//             'status': task.closest('.status').getAttribute('data-id'),
//             'id': task.getAttribute('data-id'),
//             'name': task.getAttribute('data-name')
//         };
//
//
//         $.ajax({
//             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//             type: 'POST',
//             url: route('issues.update'),
//             data: formData,
//             success: () => {
//
//             },
//         });
//         task.classList.remove("is-dragging");
//     });
// });
//
// droppables.each((i, zone) => {
//     zone.addEventListener("dragover", (e) => {
//         e.preventDefault();
//
//         const bottomTask = insertAboveTask(zone, e.clientY);
//         const curTask = document.querySelector(".is-dragging");
//
//         if (!bottomTask) {
//             zone.appendChild(curTask);
//         } else {
//             zone.insertBefore(curTask, bottomTask);
//         }
//     });
// });
//
// const insertAboveTask = (zone, mouseY) => {
//     const els = zone.querySelectorAll(".task:not(.is-dragging)");
//
//     let closestTask = null;
//     let closestOffset = Number.NEGATIVE_INFINITY;
//
//     els.forEach((task) => {
//         const {top} = task.getBoundingClientRect();
//
//         const offset = mouseY - top;
//
//         if (offset < 0 && offset > closestOffset) {
//             closestOffset = offset;
//             closestTask = task;
//         }
//     });
//
//     return closestTask;
// };
