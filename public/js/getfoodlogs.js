var startDate;
var endDate;
var startLogDate;
var endLogDate;
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
        var count = $("#day-count").data("daycount");
        var date = $(this).datepicker("getDate");
        startDate = new Date(date.getFullYear(),date.getMonth(),date.getDate() - date.getDay() + 1);
        endDate = new Date(date.getFullYear(),date.getMonth(),date.getDate() - date.getDay() + 7);
        startLogDate = startDate;
        endLogDate = new Date(date.getFullYear(),date.getMonth(),date.getDate() - date.getDay() + count);

        var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
        updateDate();
        selectCurrentWeek();
        getFoodLogs(startLogDate, endLogDate);
    },
    beforeShow : function(date){
        let lastState = localStorage.getItem("weekHandle")
        if(lastState === "1"){
            var currentDate = localStorage.getItem("startDateOfWeek")
            let dat = new Date(currentDate)
            $( "#week-picker" ).datepicker( "setDate", dat );
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

function getFoodLogs(start, end){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    var pathname = window.location.pathname;
    if (pathname == "/"){
        var view = "meal";
        callFoodLogs(view, start, end);
    }
    if (pathname == "/nutritionreport"){
        var view = "nutritionreport";
        callFoodLogs(view, start, end);
        //callNutritionLogs(view);
    }
    if (pathname == "/materialreport"){
        var view = "materialreport";
        callMaterialData(view, start, end);
    }
}

function callMaterialData(view, start, end){
    $.ajax({
        type: "POST",
        url: "/report/getmaterial",
        data: {
            date: {
                startDate: start.toLocaleDateString(),
                endDate: end.toLocaleDateString(), 
            }
        },
        success: function(data) {
            
            $("#meal-plan").html(data);
            updateDate();
        }
    });
}
function callFoodLogs(view, start, end){
    $.ajax({
        type: "POST",
        url: "/mealplan/dateselect",
        data: {
            date: {
                startDate: start.toLocaleDateString(),
                endDate: end.toLocaleDateString(), 
            }, 
            foodType: foodType,
            view : view,
        },
        success: function(data) {
            $("#meal-plan").html(data);
            updateDate();
            if(view == "nutritionreport"){
                callNutritionLogs(view, start, end);
            }
        }
    });
}
function callNutritionLogs(view, start, end){
    $.ajax({
        type: "POST",
        url: "/report/getnutrition",
        data: {
            date: {
                startDate: start.toLocaleDateString(),
                endDate: end.toLocaleDateString(), 
            }, 
            foodType: foodType,
            view : view,
        },
        success: function(data) {
            updateNutritionData(data);
        }
    });
}
function updateNutritionData(data){
    var energyLogs = data['energy_logs'];
    var targetNutrition = data['target_nutrition'];
    var reports = $('.report-nutrition');

    $.each(reports, function(){
        var report = $(this);
        var type = report.attr('id'); 
        var ageTxt = report.data("age") == "small" ? "ต่ำกว่า 1 ปี":"1-3 ปี";
        $(".age-range-span").text(ageTxt);
        var covertedLogs = {"energy":1, "fat":9, "carbohydrate":4, "protein":4.1};
        // var energySum = energyLogs[type]['energy'];
        //updateNutritionLabel(report, energyLogs[type], keys);
        $.each(covertedLogs, function(key, value){
            if(energyLogs[type] != null){
                // var key = this;
                var sum = energyLogs[type][key];
                var scale = targetNutrition[key];
                updateNutritionBar(report, key, scale, sum);
                covertedLogs[key] *= sum;
            }
        });
        updateNutritionLabel(report, covertedLogs);
    });
}

function updatePieChart(report, key, sum, energySum){
    var cahrt = report.find('.doughnutChart');

}

function updateNutritionBar(report, key, scale, sum){
    var grade = "";
    report.find("." + key).find(".nut-bar").removeClass("selected");
    if( sum < scale["toolow"]){
        grade = "toolow";
    }else if(sum < scale["low"]){
        grade = "low";
    }else if (sum < scale["ok"]){
        grade = "ok";
    }else if(sum < scale["high"]){
        grade = "high";
    }else{
        grade = "toohigh";
    }
    if (grade != ""){
        report.find("." + key).find(".nut-bar." + grade).addClass("selected");
    }
}

function updateNutritionLabel(report, covertedLogs){
    var energy = covertedLogs["energy"];
    $.each(covertedLogs, function(key, value){
        if(key != "energy"){
            if (energy == 1){
                report.find(".nutrition-span." + key).text(0);
            }else{
                var percentage = (value/energy*100).toFixed();
                report.find(".nutrition-span." + key).text(percentage);
            }
        }
    });


    // var doughnutData = null;
    // var doughnutOptions = null;
    var doughnutData = {
        labels: ["ไม่มีข้อมูล"],
            datasets: [{
                data: [1],
                backgroundColor: ["#eee"],
                hoverBackgroundColor: ["#ddd"]
        }]
    }

    if (energy > 1){
        var doughnutData = {
            labels: ["โปรตีน (กรัม)","ไขมัน (กรัม)", "คาร์โบไฮเดรต (กรัม)"],
            datasets: [{
                data: [covertedLogs['protein'].toFixed(), covertedLogs['fat'].toFixed(), covertedLogs['carbohydrate'].toFixed()],
                backgroundColor: ["#f7931e","#7ac943","#3fa6f2"],
                hoverBackgroundColor: ["#de7c0a","#5fb922","#1c89da"]
            }]
        }
    }
    var doughnutOptions = {
        responsive: false, 
        aspectRatio: 1.2,
        legend: {display:false},
    };
    var ctx = report.find('.doughnutChart')[0].getContext("2d");
    var chart = new Chart(ctx, {type: 'doughnut', data: doughnutData, options:doughnutOptions});
}

function updateDate(){
    $("#startDate").text(
        startLogDate.toLocaleDateString('th-TH', {
        year: '2-digit',
        month: 'short',
        day: 'numeric',})
    );
    $("#endDate").text(
        endLogDate.toLocaleDateString('th-TH', {
        year: '2-digit',
        month: 'short',
        day: 'numeric',})
    );
     $.each($(".report-date"), function(){
        var date = new Date($(this).data("date"));
        $(this).text(
            date.toLocaleDateString('th-TH', {
            year: '2-digit',
            month: 'short',
            day: 'numeric',})
        );
    });
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

initPicker();
function initPicker(){
    $(".ui-datepicker-current-day").click();
   

    var age = $(".age-tab.active").first().data("age");
       var text = ""
   if (age == "is_for_small"){
        text = "ต่ำกว่า 1 ปี";
   }else if (age == "is_for_big"){
        text = "1-3 ปี";
   }
   $("#age-range-span").text(text);
}

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
   var text = ""
   if (age == "is_for_small"){
        text = "ต่ำกว่า 1 ปี";
   }else if (age == "is_for_big"){
        text = "1-3 ปี";
   }
   $("#age-range-span").text(text);
   // $(".age-range-span").text(text);
   

   $(".age-tab").removeClass("active");
   $(this).addClass("active");
   foodType = $(this).attr('id');
   localStorage.setItem("foodType", foodType);
   $("#foodTypeInput").val(foodType);
   getFoodLogs(startLogDate, endLogDate);
});

// $(".age-tab").first().click();
