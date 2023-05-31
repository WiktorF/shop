console.log($, Swal);

$(document).ready(function () {
        $('div.products_count a').click(function(event){
            event.preventDefault();
            $('a.products_actual_count').text($(this).text());
            getProducts($(this).text());
    })
});

    $('a#filter-button').click(function(event){
        event.preventDefault();
        getProducts($('a.products_actual_count').first().text());
    });

    $('button.add-product-button').click(function(event){
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: welcome_data.addToCart + $(this).data('id'),
        })
            .done(function(response){
                Swal.fire({
                    title: "Sukces",
                    text: "Produkt zostal dodany do koszyka!",
                    icon: "success",
                    showDenyButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#808080",
                    denyButtonText: "<i class='fa-solid fa-bag-shopping'> Powrot</i>",
                    confirmButtonText: "<i class='fa-solid fa-cart-plus'> Przejdz do koszyka</i>",
                        })
                        .then((result) => {
                            if (result.isConfirmed) {
                                window.location = welcome_data.listCart;
                                }
                            })

                        .fail(function () {
                            Swal.fire(
                            "Oops..",
                            "Wystąpił błąd",
                            'error',
                            )
                        })
                    })
                });

function getProducts(paginate){
    const form = $('form.sidebar-filter').serialize();
        $.ajax({
            method: "GET",
            url: "/",
            data: form + "&" + $.param({paginate : paginate}),
        })
            .done(function (response) {
                $('div#products_wrapper').empty();
                $.each(response.data, function(index, product){
                    const html = '<div class="col-6 col-md-6 col-lg-4 mb-3">' +
                    '    <div class="card h-100 border-0">' +
                    '       <div class="card-img-top">' +
                    '            <img src="' + getImage(product) + '") }}" class="img-fluid mx-auto d-block" alt="Zdjecie">' +
                    '       </div>' +
                    '       <div class="card-body text-center">' +
                    '            <h4 class="card-title">' +
                                    product.name +
                    '           </h4>' +
                    '           <h5 class="card-price small">' +
                    '               <i>'+ product.price +' zł</i>' +
                    '            </h5>' +
                    '        </div>' +
                    '        <button type="button" class="btn btn-success add-product-button"' + getDisabled() + ' data-id="' + product.id + '">' +
                    '            <i class="fa-solid fa-cart-plus"></i>   Dodaj do koszyka' +
                    '        </button>' +
                    '   </div>' +
                    '</div>';
                    $('div#products_wrapper').append(html);
                });
            })
        }


function getImage(product){
    if(!!product.image_path){
        return welcome_data.StoragePath + '/' + product.image_path;
    }else{
        return welcome_data.defaultImage;
    }
}

function getDisabled(){
    if(welcome_data.isGuest){
        return ' disabled';
    }
    return '';
}
