function searchTable(id) {
    var searchValue = new RegExp($("#" + id).val(), "i");

    $(".search-table .search-items").hide();

    $(".search-table .search-items")
        .filter(function () {
            var matchesSearch = searchValue.test($(this).text());

            return matchesSearch;
        })
        .show();
}

function filterTable(id) {
    var selectedValue = $("#" + id).val();

    $(".search-table .search-items").hide();

    $(".search-table .search-items")
        .filter(function () {
            var matchesFilter =
                selectedValue === "all" || $(this).hasClass(selectedValue);

            return matchesFilter;
        })
        .show();
}
