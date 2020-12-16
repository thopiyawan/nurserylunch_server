var startDate;
var endDate;
var foodType;

foodType = $(".age-tab").first().attr('id');
$(".age-tab").first().addClass('active');

// --- set up calebdar

var selectCurrentWeek = function() {
    window.setTimeout(function() {
        $("#week-picker")
            .find(".ui-datepicker-current-day a")
            .addClass("ui-state-active");
    }, 1);
};


$("#week-picker").datepicker({
    showOtherMonths: true,
    selectOtherMonths: true,
    showButtonPanel: true,
    isBuddhist: true,
    onSelect: function(dateText, inst) {
        var date = $(this).datepicker("getDate");
        startDate = new Date(date.getFullYear(),date.getMonth(),date.getDate() - date.getDay() + 1);
        endDate = new Date(date.getFullYear(),date.getMonth(),date.getDate() - date.getDay() + 7);

        var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
        $("#startDate").text(
            startDate.toLocaleDateString('th-TH', {
            year: '2-digit',
            month: 'short',
            day: 'numeric',})
        );
        $("#endDate").text(
            endDate.toLocaleDateString('th-TH', {
            year: '2-digit',
            month: 'short',
            day: 'numeric',})
        );
        var mondayDate = new Date(date.getFullYear(),date.getMonth(),date.getDate() - date.getDay() + 1);
        var tuesdayDate = new Date(date.getFullYear(),date.getMonth(),date.getDate() - date.getDay() + 2);
        var wednesdayDate = new Date(date.getFullYear(),date.getMonth(),date.getDate() - date.getDay() + 3);
        var thursdayDate = new Date(date.getFullYear(),date.getMonth(),date.getDate() - date.getDay() + 4);
        var fridayDate = new Date(date.getFullYear(),date.getMonth(),date.getDate() - date.getDay() + 5);
        $("#mondayDate").text(mondayDate.getDate());
        $("#tuesdayDate").text(tuesdayDate.getDate());
        $("#wednesdayDate").text(wednesdayDate.getDate());
        $("#thursdayDate").text(thursdayDate.getDate());
        $("#fridayDate").text(fridayDate.getDate());

        localStorage.setItem("startDateOfWeek", startDate);
        localStorage.setItem("mondayDate", mondayDate);
        localStorage.setItem("tuesdayDate", tuesdayDate);
        localStorage.setItem("wednesdayDate", wednesdayDate);
        localStorage.setItem("thursdayDate", thursdayDate);
        localStorage.setItem("fridayDate", fridayDate);

        selectCurrentWeek();
        getFoodLogs(startDate, endDate);
    },
    beforeShow : function(date){
        let lastState = localStorage.getItem("weekHandle")
        if(lastState === "1"){
            var currentDate = localStorage.getItem("startDateOfWeek")
            console.log("currentDate", currentDate)
            let dat = new Date(currentDate)
            console.log("dat", dat)
            $( "#week-picker" ).datepicker( "setDate", dat );
            console.log("currentDate", currentDate)
        }
        localStorage.setItem("weekHandle", 0)
    },
    beforeShowDay: function(date) {
        var cssClass = "";
        if (date >= startDate && date <= endDate)
            cssClass = "ui-datepicker-current-day";
        return [true, cssClass];
    },
    onChangeMonthYear: function(year, month, inst) {
        selectCurrentWeek();
    },
    _gotoToday: function(id) {
        $(".ui-datepicker-current-day").click();
    }
});

function getFoodLogs(startDate, endDate){
    // console.log("getFoodLogs");
    var pathname = window.location.pathname;
    var view = pathname == "/" ? "meal" : "report";
    console.log("pathname : ", view);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    // console.log("before select", startDate, endDate, foodType);
    $.ajax({
        type: "POST",
        url: "/mealplan/dateselect",
        data: {
            date: {
                startDate: startDate.toLocaleDateString(),
                endDate: endDate.toLocaleDateString(), 
            }, 
            foodType: foodType,
            view : view,
        },
        success: function(data) {
            //console.log(data);
            $("#meal-plan").html(data);
            // console.log("dateselect -success");
        }
    });

    if(view == "report"){
        $.ajax({
            type: "POST",
            url: "/mealplan/nutritiondata",
            data: {
                date: {
                    startDate: startDate.toLocaleDateString(),
                    endDate: endDate.toLocaleDateString(), 
                }, 
                foodType: foodType,
                view : view,
            },
            success: function(data) {
                updatePieChart(data);
            }
        });
    }
}

function updatePieChart(data){
    var energy = data["energy"];
    var protein = (data["protein"]*4).toFixed();
    var fat = (data["fat"]*9).toFixed();
    var carbohydrate = (data["carbohydrate"]*4).toFixed();
    // console.log(data["energy"], protein, fat, carbohydrate);

    $("#protein-label").text((protein/energy*100).toFixed());
    $("#fat-label").text((fat/energy*100).toFixed());
    $("#carb-label").text((carbohydrate/energy*100).toFixed());

    var doughnutData = {
        labels: ["โปรตีน","ไขมัน", "คาร์โบไฮเดรต"],
        datasets: [{
            data: [protein, fat, carbohydrate],
            backgroundColor: ["#f7931e","#7ac943","#3fa6f2"],
            hoverBackgroundColor: ["#de7c0a","#5fb922","#1c89da"]
        }]
    }
    var doughnutOptions = {
        responsive: true, 
        aspectRatio: 1.2,
        legend: {display:false},
    };
    var ctx = document.getElementById("doughnutChart").getContext("2d");
    new Chart(ctx, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

}
$.datepicker.regional["th"] = {
    closeText: "ปิด",
    prevText: "",
    nextText: "",
    currentText: "สัปดาห์นี้",
    monthNames: ["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"],
    monthNamesShort: ["ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","สิ.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค."],
    dayNames: ["อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัส","ศุกร์","เสาร์"],
    dayNamesShort: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"],
    dayNamesMin: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"],
    weekHeader: "อาทิตย์",
    dateFormat: "dd M y",
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
};
$.datepicker.setDefaults($.datepicker.regional["th"]);

$(".ui-datepicker-current-day").click();

$(document).on(
    "mousemove",
    "#week-picker .ui-datepicker-calendar tr",
    function() {
        $(this)
            .find("td a")
            .addClass("ui-state-hover");
    }
);
$(document).on(
    "mouseleave",
    "#week-picker .ui-datepicker-calendar tr",
    function() {
        $(this)
            .find("td a")
            .removeClass("ui-state-hover");
    }
);
$(document).on("click", "button.ui-datepicker-current", function() {
    $(".ui-datepicker-today").click();
});

// ----- set up foodType 
$('.age-tab').on('click', function(){
   var age = $(this).data("age");
   var text = age == "is_for_small" ? "ต่ำกว่า 1 ปี":"1-3 ปี";
   $("#age-range-span").text(text);

   $(".age-tab").removeClass("active");
   $(this).addClass("active");
   foodType = $(this).attr('id');
   localStorage.setItem("foodType", foodType);
   getFoodLogs(startDate, endDate);
});

// $(".age-tab").first().click();