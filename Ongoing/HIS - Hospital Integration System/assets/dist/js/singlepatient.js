$(document).ready(function(){

    var switchToInput = function () {
        var $input = $("<input>", {
            val: $(this).text(),
            type: "number",
            rel : jQuery(this).text(),
        });
        $input.addClass("form-control singlepatient-changeableInput");
        $(this).replaceWith($input);
        $input.on("blur", switchToSpan);

        $input.keyup(function(e){
            if(e.keyCode == 13)
            {
                spanSwitch($input);
            }
        });

        $input.select();
    };
    var switchToSpan = function () {
            if(jQuery(this).val()){
                        var $text = jQuery(this).val();
                } else {
                      var $text = jQuery(this).attr('rel');
                }
        var $span = $("<span>", {
            text: $text,
        });
        $span.addClass("mt-1 singlepatient-info singlepatient-i-editable");
        $(this).replaceWith($span);
        $span.on("click", switchToInput);
    }

    /**
     * Needs Some Work 
     * 
     * Merge This And Above Functions
     */
    function spanSwitch(el){
        if(jQuery(el).val()){
            var $text = jQuery(el).val();
        } else {
            var $text = jQuery(el).attr('rel');
        }
        var $span = $("<span>", {
        text: $text,
        });
        $span.addClass("mt-1 singlepatient-info singlepatient-i-editable");
        $(el).replaceWith($span);
        $span.on("click", switchToInput);
    }

    $('.singlepatient-i-editable').on('click', switchToInput);



});