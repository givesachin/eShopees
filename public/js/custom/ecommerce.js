app.filter('indianNumberFormat', function()
{
    return function(number) {
        return Number(number).toLocaleString('en-IN',{
            style: 'currency',
            currency: 'INR',
            maximumFractionDigits: 0
        });
    };
});

app.filter('indianNumberFormatDeliveryCharge', function()
{
    return function(cart, org) {

        if (cart && cart.length > 0)
        {
            let total = 0;
            let delivery_charge = 0;

            cart.forEach(item => {
                total += item.price * item.quantity;
              });

            delivery_charge = (total < org.delivery_charge_thresold_amount) ? org.delivery_charge_amount : 0;

            return Number(delivery_charge).toLocaleString('en-IN',{
                style: 'currency',
                currency: 'INR',
                maximumFractionDigits: 0
            });
        } else {
            return 0;
        }
    };
});

app.filter('indianNumberFormatOriginal', function()
{
    return function(number, percentage) {
        return Number(number + (number * percentage / 100)).toLocaleString('en-IN',{
            style: 'currency',
            currency: 'INR',
            maximumFractionDigits: 0
        });
    };
});

app.filter('indianNumberFormatDiscount', function()
{
    return function(cart) {

        if (cart && cart.length > 0)
        {
            let total = 0;
            let price = 0;

            cart.forEach(item => {
                total += (item.price * item.discounted_percentage / 100) * item.quantity;
              });

              return Number(total).toLocaleString('en-IN',{
                  style: 'currency',
                  currency: 'INR',
                  maximumFractionDigits: 0
              });
        } else {
            return 0;
        }
    };
});

app.filter('totalCartAmountOriginal', function()
{
    return function(cart) {

        if (cart && cart.length > 0)
        {
            let total = 0;

            cart.forEach(item => {
                total += (item.price + (item.price * item.discounted_percentage / 100)) * item.quantity;
              });

            return Number(total).toLocaleString('en-IN',{
                style: 'currency',
                currency: 'INR',
                maximumFractionDigits: 0
            });
        } else {
            return 0;
        }
    };
});

app.filter('totalCartAmount', function()
{
    return function(cart, org) {

        if (cart && cart.length > 0)
        {
            let total = 0;
            let delivery_charge = 0;

            cart.forEach(item => {
                total += item.price * item.quantity;
              });

            delivery_charge = (total < org.delivery_charge_thresold_amount) ? org.delivery_charge_amount : 0;

            return Number((total +  delivery_charge)).toLocaleString('en-IN',{
                style: 'currency',
                currency: 'INR',
                maximumFractionDigits: 0
            });
        } else {
            return 0;
        }
    };
});

app.filter('formatDate', function()
{
    return function(datetime) {

        if (datetime)
        {
             current_date_time = new Date(datetime), today = new Date().setHours(0, 0, 0, 0);

             return current_date_time.toLocaleDateString({}, {
                weekday: 'short', day: 'numeric', month: 'short',
                hour: 'numeric', minute:'2-digit', hour12: true
            });

        } else {
            return null;
        }
    };
});

app.filter('formatFullDateTime', function()
{
    return function(datetime) {

        if (datetime)
            return new Date(datetime).toLocaleString({}, {
                day: 'numeric', month: 'short', year: 'numeric',
                hour: 'numeric', minute:'2-digit', hour12: true
            }).replace(new RegExp("/", 'g'),"-" );
        else
            return null;
    };
});

app.filter('formatOrderID', function()
{
    return function(order_id, org) {
        if (org)
        {
            let order_len = `${order_id}`.length;
            let replace_len = org.order_id_padding.length;

            if (order_len < replace_len)
                return org.order_id_prefix + org.order_id_padding.substr(0, (replace_len - order_len)) + order_id;
            else
                return org.order_id_prefix + order_id;
        } else {
            return order_id;
        }
    };
});
