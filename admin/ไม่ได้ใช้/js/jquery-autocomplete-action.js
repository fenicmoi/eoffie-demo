$(function() {
    $("#country").autocomplete({
        source: function(request, response) {
            $.getJSON("ajaxCountry.php?keyword=" + request.term, function(data) {
                if (data != null) {
                    response($.map(data, function(item) {
                        return {
                            label: item.dep_id + " - " + item.dep_name,
                            value: item.dep_name,
                            id: item.dep_id
                        };
                    }));
                }
            });
        },
        select: function(event, ui) {
            $("span.result-data").html(ui.item.label);
        }
    });
});