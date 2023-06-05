(function ($) {
    $('#category-product').change(function () {
        $.ajax({
            url: as.ajaxurl,
            method: "POST",
            data: {
                "action": "an_filter_products",
                "category_id": $(this).find(':selected').val()
            },
            beforeSend: function () {
                $('#category_results').html('Loading...');
            },
            success: function (data) {
                let html = "";

                data.forEach(item => {
                    html += `
                    <div class="col-md-6 col-sm-12 my-3">
                    <div class="card">
                        ${item.image}
                        <div class="card-body">
                            <h3>${item.title}</h3>
                            <a href="${item.link}" class="btn btn-primary">Read more</a>
                        </div>
                    </div>
                </div>
                    `;
                });

                $('#category_results').html(html);

                console.log(data);
            },
            error: function (error) {
                console.log(error);
            }
        })
    });

    $(document).ready(function () {
        $.ajax({
            url: as.apiurl + "latest/2",
            method: "GET",
            beforeSend: function () {
                $('#lastest-posts').html('Loading...');
            },
            success: function (data) {
                let html = "";

                data.forEach(item => {
                    html += `
                    <div class="col-md-12 col-sm-12 my-3">
                    <div class="card">
                        ${item.image}
                        <div class="card-body">
                            <h3>${item.title}</h3>
                            <a href="${item.link}" class="btn btn-primary">Read more</a>
                        </div>
                    </div>
                </div>
                    `;
                });

                $('#lastest-posts').html(html);

                console.log(data);
            },
            error: function (error) {
                console.log(error);
            }
        })
    });
})(jQuery);