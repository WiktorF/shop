console.log($);
$(document).ready(function () {
        $('div.products_count a').click(function(event){
            event.preventDefault();
            $('a.products_actual_count').text($(this).text());
            getProducts($(this).text());
    });

    $('a#filter-button').click(function(event){
        event.preventDefault();
        getProducts($('a.products_actual_count').first().text());
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
                    '   </div>' +
                    '</div>';
                    $('div#products_wrapper').append(html);
                })
            })
}

function getImage(product){
    if(!!product.image_path){
        return StoragePath + product.image_path;
    }else{
        return defaultImage;
    }
}
