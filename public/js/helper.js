console.log("in js");
$(function(){
    //---- side menu
    $('#aside-menu').metisMenu();

    // --- MEAL PLAN ----
    $(".meat-select").selectpicker().on('loaded.bs.select', addIconToSelect(".meat-select", "")).on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue){
    	addIconToSelect (".meat-select", this.value);
    }); 
    $(".vegetable-select").selectpicker().on('loaded.bs.select', addIconToSelect(".vegetable-select", "")).on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue){
    	addIconToSelect (".vegetable-select", this.value);
    }); 
    $(".protein-select").selectpicker().on('loaded.bs.select', addIconToSelect(".protein-select", "")).on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue){
    	addIconToSelect (".protein-select", this.value);
    }); 

    function addIconToSelect (className, val){
    	var icon = "";
    	var title = "";
    	if (className == ".meat-select"){
    		icon = "<i class='fas fa-piggy-bank'></i> ";
    		title = "เนื้อสัตว์";
    	}else if (className == ".vegetable-select"){
    		icon = "<i class='fas fa-carrot'></i> ";
    		title = "ผัก";
    	}else if (className == ".protein-select"){
    		icon = "<i class='fas fa-egg'></i> ";
    		title = "โปรตีน";
    	}

    	if (val == ""){
	    	var inner = $(className + " .filter-option-inner-inner");
			inner.empty();
			inner.append(icon + title);
		}else{
			var inner = $(className + " .filter-option-inner-inner");
			inner.prepend(icon);
		}
    }




    // var element = ".ui-sortable";
    // // var items = ".ui-sortable-item";
    // var connect = ".ui-sortable";
    // // var connect = "[class*=ui-sortable2]";
    // $(element).sortable({
    //     cancel: ".ui-state-disabled",
    //     connectWith: connect,
    //     cursor: "move",
    //     cursorAt: { top:5, left: 5 }, 
    //     dropOnEmpty: false
    // }).disableSelection();

    $( ".ui-sortable" ).sortable();
    console.log("end sortable");

});