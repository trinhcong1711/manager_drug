function search_medicine(url) {
    $(document).on("keyup", "input[name='search_medicine']", function() {
        let value = $(this).val();
        if (value !== ""){
            $.ajax({
                url:url,
                method: 'get',
                data:{
                    name:value
                },success:function (result) {

                }
            });
        }

    });
}

function formatPrice(num) {
    var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
    if (str.indexOf(".") > 0) {
        parts = str.split(".");
        str = parts[0];
    }
    str = str.split("").reverse();
    for (var j = 0, len = str.length; j < len; j++) {
        if (str[j] != ",") {
            output.push(str[j]);
            if (i % 3 == 0 && j < (len - 1)) {
                output.push(",");
            }
            i++;
        }
    }
    formatted = output.reverse().join("");
    return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
}

function totalPrice() {
    let total_cost = 0;
    let cost = 0;
    $(".total_price").each(function () {
        cost = $(this).text().replaceAll(',','');
        total_cost = total_cost + parseInt(cost);
    });
    return total_cost;
}
function totalPrices(select) {
    let total_cost = 0;
    let cost = 0;
    $(select).each(function () {
        cost = $(this).val().replaceAll(',',"");
        total_cost = total_cost + parseInt(cost);
    });
    return total_cost;
}

function totalPriceRefundCustomer(price_customer) {
    let total_price = totalPrice();
    price_customer = price_customer.replaceAll(',','');
    if (price_customer > total_price) {
        return price_customer - total_price;
    }
    return 0;
}
