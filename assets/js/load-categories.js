function loadCategories() {
    var requestType = "getCategories";
    $.ajax({
        url: "../../php/load-categories.php",
        type: 'post',
        data: { requestType: requestType },
        success: function(result) {
            var categories = "<option value='' disabled selected>-- Select Category --</option>";
            $.each(result, function(key, value) {
                categories = categories + "<option value='" + value.id + "'>" + value.category + "</option>";
            });
            $('#drpdlistCategory').html(categories);
        }
    });
}

function getSubCategories(object) {
    var requestType = "getSubCategories";
    $.ajax({
        url: "../../php/load-categories.php",
        type: 'post',
        data: { requestType: requestType, id: object.value },
        success: function(result) {
            var subCategories = "<option value=''disabled selected>-- Select Sub Category --</option>";
            $.each(result, function(key, value) {
                subCategories = subCategories + "<option value='" + value.id + "'>" + value.subCategory + "</option>";
            });
            $('#drpdlistSubCategory').html(subCategories);
        }
    });
}

$('#drpdlistCategory').ready(function() {
    loadCategories();
});

$('#drpdlistCategory').on('change', function() {
    getSubCategories(this);
});