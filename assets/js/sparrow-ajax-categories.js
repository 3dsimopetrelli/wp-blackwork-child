jQuery(document).ready(function($) {

    $(".sparrow-category").click(function fetchCategory() {
        
        $(".sparrow-category").removeClass("active");
        $(".sparrow-tag").removeClass("active");
        $(this).addClass("active");
        var catslug = $(this).data("catname");
        var catname = $(this).text();

        $(".products").attr("data-category", catslug);
        $(".products").attr("data-tag", '');
        
        $.ajax({
            url: ajax_categories.ajaxurl,
            type: 'post',
            data: { action: 'sparrow_category_data_fetch', pcat: $(this).attr("id") },
            dataType: 'json',
            success: function(data) {
                $('.products').html( data.data );
                $(window).scrollTop(0);
                //var url = `http://localhost/sparrow/negozio/`;
                var url = `${window.location.origin}/shop/`;
                if (catslug) {
                    //url = `http://localhost/sparrow/categoria-prodotto/${catslug}`;
                    url = `${window.location.origin}/shop-category/${catslug}`;
                    $("h1.elementor-heading-title").text(catname);
                } else {
                    $("h1.elementor-heading-title").text("Shop");
                }
                window.history.pushState(null, null, url);

                if(data.max_num_pages > 1) {
                    $('.loadmore-trigger').attr('data-disabled', 0);
                    $('[data-elementor-type="footer"]').css('display', 'none');
                } else {
                    $('.loadmore-trigger').attr('data-disabled', 1);
                    $('[data-elementor-type="footer"]').css('display', 'block');
                }

                lazyLoad();
                
                $('.products').find('.product:not(.loaded)').each(function(i) { 
                    $(this).find('img').addClass("is-loaded");
                    $(this).delay(i*200).animate({'opacity': 1},800, 'swing', function() { 
                        $(this).addClass("loaded");
                    });
                });
            },
        });
    });

    

    $(".sparrow-tag").click(function() {
        $(".sparrow-category").removeClass("active");
        $(".sparrow-tag").removeClass("active");
        $(this).addClass("active");
        var tagslug = $(this).attr("id");
        var tagname = $(this).text();

        $(".products").attr("data-category", '');
        $(".products").attr("data-tag", tagslug);

        $.ajax({
            url: ajax_categories.ajaxurl,
            type: 'post',
            data: { action: 'sparrow_tag_data_fetch', ptag: $(this).attr("id") },
            dataType: 'json',
            success: function(data) {
                $('.products').html( data.data );

                $(window).scrollTop(0);
                //var url = `http://localhost/sparrow/tag-prodotto/${tagslug}`;
                var url = `${window.location.origin}/shop-tag/${tagslug}`;
                window.history.pushState(null, null, url);
                $("h1.elementor-heading-title").text(tagname);

                if(data.max_num_pages > 1) {
                    $('.loadmore-trigger').attr('data-disabled', 0);
                    $('[data-elementor-type="footer"]').css('display', 'none');
                } else {
                    $('.loadmore-trigger').attr('data-disabled', 1);
                    $('[data-elementor-type="footer"]').css('display', 'block');
                }

                lazyLoad();

                $('.products').find('.product:not(.loaded)').each(function(i) { 
                    $(this).find('img').addClass("is-loaded");
                    $(this).delay(i*200).animate({'opacity': 1},800, 'swing', function() { 
                        $(this).addClass("loaded");
                    });
                });
            },
        });
    });

    $(".sparrow-category.has-children").click(function() {
        if ($(this).hasClass("open")) {
            $(this).removeClass("open");
            $(this).next().removeClass("open");
        } else {
            $(".sparrow-product-categories-children").removeClass("open");
            $(this).next().addClass("open");
        }
    });

    $(".sparrow-product-filter-btn").click(function() {
        $("body").addClass("filters-open");
        $(window).scrollTop(0);
    });

    $(".sparrow-product-filter-btn-close").click(function() {
        $("body").removeClass("filters-open");
    });
});


