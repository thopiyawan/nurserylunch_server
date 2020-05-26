console.log("in js");
$(function(){
    // --- MEAL PLAN ----

    //$(".in-group-select").selectpicker({});
    //var meat_select = $(".meat-select");
 //    $(".meat-select").selectpicker().on('loaded.bs.select', function (e, clickedIndex, isSelected, previousValue) {
 //  		if (this.value == ""){
 //  			addIconToSelect(".meat-select");
 //  		}
	// });


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
    		icon = "<i class='fas fa-users'></i> ";
    		title = "เนื้อสัตว์";
    	}else if (className == ".vegetable-select"){
    		icon = "<i class='fas fa-search'></i> ";
    		title = "ผัก";
    	}else if (className == ".protein-select"){
    		icon = "<i class='fas fa-comment'></i> ";
    		title = "โปรตีน";
    	}

    	if (val == ""){
	    	var inner = $(className + " .filter-option-inner-inner");
			inner.empty();
			inner.append(icon + title);
		}else{
			var inner = $(className + " .filter-option-inner-inner");
			// inner.empty();
			//$( "<i class='fas fa-users'></i>" ).insertBefore(inner);
			inner.prepend(icon);
		}
    }

});