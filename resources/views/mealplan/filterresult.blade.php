<div class="">
    @foreach ($foodList as $food)
        <div class="ui-sortable food-list">
            <div class="menu-body">
                <div class="col col-food-name" data-energy="{{ $food->getEnergy() }}"
                    data-protein="{{ $food->getProtein() }}" data-fat="{{ $food->getFat() }}" id="{{ $food->id }}">
                    {{ $food->food_thai }}
                </div>
                <div class="col col-delete">
                    <a class="pull-right" data-toggle="modal" data-target="#editKidForm">
                        <span><i class="fas fa-times"></i></span>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>



<script type="application/javascript">
    $(".ui-sortable").sortable({
        cancel: ".ui-state-disabled",
        connectWith: ".ui-sortable-meal",
        cursor: "move",
        cursorAt: {
            top: 5,
            left: 5
        },
        dropOnEmpty: false,
        remove: onSortableRemove,
        receive: onSortableReceive,
    });


    function onSortableRemove(event, ui) {
        var target = event.target;
        if (target.classList.contains("food-list")) {
            ui.item.clone(true).appendTo(target);
        }
        var parent = $(event.target).parents('.meal-panel');
    }

    function onSortableReceive(event, ui) {
        var parent = $(event.target).parents('.meal-panel');
        calculateNutrition(parent);
    }


    $('[data-toggle="tooltip"]').tooltip();

    $(".col-delete").on('click', onColDeleteClick);

    function onColDeleteClick(event) {

        var parent = $(this).parents('.meal-panel');
        $(this).parent().remove();
        calculateNutrition(parent);
    }

</script>
