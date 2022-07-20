$(function () {

    var BASE_URL = window.APP_DATA.base_url;

    function loadHeaderCartContent() {
        $.ajax({
            url: BASE_URL + '/ajax/cart',
            success: function (res) {
                $('.blockcart .cart-products-count').text(res.data.total);

                var template = $($('[data-template="cart-list"]').html());
                var list = [];
                var totalPrice = 0;

                $.each(res.data.cart, function (i, cart) {
                    totalPrice += parseFloat(cart.product.price, 10) || 0;
                    var el = template.clone();
                    var productUrl = BASE_URL + '/products/' + cart.product_id;
                    var productImage = cart.product.pict_url;
                    el.find('.product-image img').attr('src', productImage);
                    el.find('.product-image a').attr('href', productUrl);
                    el.find('.product-name a').attr('href', productUrl).text(cart.product.product_name);
                    el.find('.product-price').text(cart.product.price);
                    el.find('.action .remove').attr('href', BASE_URL + '/cart/hapus/' + cart.id);
                    list.push(el);
                });

                $('[data-template-content="cart-list"]').html(list);
                $('.blockcart .total > td:last').text(totalPrice)
            }
        });
    }

    loadHeaderCartContent();

    $(document).on('click', '[data-add-to-cart]', function (e) {
        e.preventDefault();
        $(this).prop('disabled', true)
        var $this = $(this);

        $.ajax({
            type: 'POST',
            url: BASE_URL + '/ajax/cart/add/' + $(this).data('add-to-cart'),
            success: function (res) {
                if (res.status === 'success') {
                    loadHeaderCartContent();
                    window.location.href = BASE_URL + '/carts';
                }
            },
            complete: function () {
              $this.prop('disabled', false)
            }
        })
    })
});

