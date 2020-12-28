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
    // console.log("pathname : ", view);
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
            updateDate();
            // console.log("dateselect -success");
        }
    });

    if(view == "report"){
        // console.log("js start date" + startDate);
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
                updateNutritionData(data);
            }
        });
    }
}
function updateDate(){
    var dates = $(".report-date");
    dates.each(function(){
        var dateSpan = $(this);
        var date = new Date(dateSpan.data('date'));
        dateSpan.text(
            date.toLocaleDateString('th-TH', {
            year: '2-digit',
            month: 'short',
            day: 'numeric',})
        );
    });
}
function updateNutritionData(data){
    var energy = data["energy"][0];
    var protein = (data["protein"][0]*4).toFixed();
    var fat = (data["fat"][0]*9).toFixed();
    var carbohydrate = (data["carbohydrate"][0]*4).toFixed();
    // console.log(data["energy"], protein, fat, carbohydrate);
    updatePieChart(energy, protein, fat, carbohydrate);
    updateNutritionBar(data);
}

function updatePieChart(energy, protein, fat, carbohydrate){
    $("#doughnutChart").empty();
    $(".chartjs-size-monitor").empty();
    if (energy){
        $(".nutrition-label").removeClass("none");
        $("#protein-label").text((protein/energy*100).toFixed());
        $("#fat-label").text((fat/energy*100).toFixed());
        $("#carb-label").text((carbohydrate/energy*100).toFixed());

        var doughnutData = {
            labels: ["โปรตีน (กรัม)","ไขมัน (กรัม)", "คาร์โบไฮเดรต (กรัม)"],
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
        var chart = null;
        var ctx = document.getElementById("doughnutChart").getContext("2d");
        chart = new Chart(ctx, {type: 'doughnut', data: doughnutData, options:doughnutOptions});
    }else{
        $("#protein-label").text(0);
        $("#fat-label").text(0);
        $("#carb-label").text(0);
        $(".nutrition-label").addClass("none");

        var doughnutData = {
            labels: ["ไม่มีข้อมูล"],
            datasets: [{
                data: [1],
                backgroundColor: ["#eee"],
                hoverBackgroundColor: ["#ddd"]
            }]
        }

        var doughnutOptions = {
            responsive: true, 
            aspectRatio: 1.2,
            legend: {display:false},
        };
        var chart = null;
        var ctx = document.getElementById("doughnutChart").getContext("2d");
        chart = new Chart(ctx, {type: 'doughnut', data: doughnutData, options:doughnutOptions});
    }
}

function updateNutritionBar(data){
    $(".nut-bar").removeClass("selected");
    if(data["energy"][0] != 0){
        for( var key in data){
            var value = data[key][0];
            var grade = data[key][1];
            // console.log(grade);
            $("."+key+" .nut-bars").find(".nut-bar."+grade).addClass("selected");
            // console.log($("."+key+" .nut-bars").find(".nut-bar."+grade));
        }
    }
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