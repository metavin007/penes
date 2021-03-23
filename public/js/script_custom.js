////จำลอง datable ไว้ทำ view ชั่วคราว
//var TableList = $('#TableList').dataTable({
//    scrollCollapse: true,
//    autoWidth: false,
//    responsive: true,
//    columnDefs: [{
//            targets: "datatable-nosort",
//            orderable: false,
//        }],
//    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
//    "language": {
//        "info": "_START_-_END_ of TOTAL entries",
//        searchPlaceholder: "Search"
//    },
//});
//
////ปุ่มย้อนกลับ
//$('body').on('click', '.btn-backward', function (e) {
//    e.preventDefault();
//    var url = $(this).data('url');
//    swal({
//        title: "คุณจะย้อนกลับไปที่ตารางหลัก ?",
//        text: "",
//        type: 'warning',
//        showCancelButton: true,
//        confirmButtonClass: 'btn btn-success',
//        cancelButtonClass: 'btn btn-danger',
//        confirmButtonText: "ใช่ ฉันต้องการย้อนกลับ",
//        cancelButtonText: "ยกเลิก",
//        showLoaderOnConfirm: true,
//    }).then(function (result) {
//        if (result.value) {
//            window.location.href = url;
//        }
//    });
//});
//
//
////ฟังก์ชั่นใส่ลูกน้ำให้
//function formatNumber(num) {
//    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
//}
//
////ฟังก์ชั่นปัดขึ้นปัดลง
//function roundNumber(num, scale) {
//    if (!("" + num).includes("e")) {
//        return +(Math.round(num + "e+" + scale) + "e-" + scale);
//    } else {
//        var arr = ("" + num).split("e");
//        var sig = ""
//        if (+arr[1] + scale > 0) {
//            sig = "+";
//        }
//        return +(Math.round(+arr[0] + "e" + sig + (+arr[1] + scale)) + "e-" + scale);
//    }
//}
//
////บล็อกให้กรอกเฉพาะตัวเลข
//$("body").on("keypress keyup blur", '.number_only', function (event) {
//    $(this).val($(this).val().replace(/[^\d].+/, ""));
//    if ((event.which < 48 || event.which > 57)) {
//        event.preventDefault();
//    }
//});
//
////บล็อกให้กรอกเฉพาะตัวเลขและตัวอักษรภาษาอังกฤษเท่านั้น
//$("body").on("keypress keyup blur", '.number_and_character_only', function (event) {
//    var regex = new RegExp("^[a-zA-Z0-9]+$");
//    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
//    if (!regex.test(key)) {
//        event.preventDefault();
//        return false;
//    }
//});
//
////สร้างเลขให้วิ่งตามลำดับไม่ว่าจะเพิ่มหรือลบก็จะเรียงให้ใหม่
function gen_auto_no(class_name) {
    $.each($(class_name), function (index, value) {
        $(this).html((Number(index) + 1));
    });
}
//
//// + 30 day
//function parseMDY(s) {
//    var b = s.split("-");
//    return new Date(b[2], b[1] - 1, b[0]);
//}
//function formatMDY(d) {
//    function z(n) {
//        return (n < 10 ? '0' : '') + n
//    }
//    if (isNaN(+d))
//        return d.toString();
//    return z(d.getDate()) + '-' + z(d.getMonth() + 1) + '-' + d.getFullYear();
//}
//function addDays(s, days) {
//    var d = parseMDY(s);
//    d.setDate(d.getDate() + Number(days));
//    return formatMDY(d);
//}
//
//// บล็อกปุ่มให้กดไม่ได้
//$('body').on('click', '.isDisabled', function (e) {
//    e.preventDefault();
//});
//
//// ทำให้อักษรภาษาอังกฤษเป็นตัวใหญ่
//$("body").on('keyup change', 'input', function (e) {
//    if (!$(this).data('type_case_sensitive')) {
//        $(this).val($(this).val().toUpperCase());
//    }
//});
//
//// ช่อง input ที่เป็นเปอร์เซ็นหากใส่เกิน 100
//$("body").on('keyup change', '.percent_custom', function (e) {
//    if ($(this).val() > 100) {
//        $(this).val(100);
//        $(this).trigger('input');
//    }
//});
//
//// ฟังกชั่น บล้อกช่องว่าง
//$('body').on('keydown change', '.not_allowed_space', function (e) {
//    this.value = this.value.replace(/\s/g, "");
//});