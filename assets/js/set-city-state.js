function loadStates() {
    var requestType = "getStates";
    $.ajax({
        url: "../php/state-city.php",
        type: 'post',
        data: { requestType: requestType },
        success: function(result) {
            var states = "<option value='' disabled selected>-- Select State --</option>";
            $.each(result, function(key, value) {
                states = states + "<option value='" + value.id + "'>" + value.state + "</option>";
            });
            // $('#drpdlistState').append(states);
            // $('#drpdlistState').val('32');

        }
    });
}

function getCities(object) {
    var requestType = "getCities";
    $.ajax({
        url: "../php/state-city.php",
        type: 'post',
        data: { requestType: requestType, id: object.value },
        success: function(result) {
            var cities = "<option value=''disabled selected>-- Select City --</option>";
            $.each(result, function(key, value) {
                cities = cities + "<option value='" + value.id + "'>" + value.city + "</option>";
            });
            $('#drpdlistCity').html(cities);
        }
    });
}

$('#drpdlistState').ready(function() {
    loadStates();
});

$('#drpdlistState').on('change', function() {
    getCities(this);
});