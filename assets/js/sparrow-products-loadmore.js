jQuery(document).ready(function($) {

    if($('.loadmore-trigger').length) {
        console.log($('.loadmore-trigger').attr('data-disabled'));
        if($('.loadmore-trigger').attr('data-disabled') != 1) {
            $('[data-elementor-type="footer"]').css('display', 'none');
        }
    }

    if($('.post-type-archive-product .products').length) {
        var page = 2; // Current page number
        var postsPerPage = 9; // Number of posts to load per page
        var loading = false; // Prevent multiple AJAX calls
        var tmpCategory = '';

        function loadMorePosts(category, tag) {
            if (!loading && $('.loadmore-trigger').attr('data-disabled') != 1) {
                loading = true;
                $('.loadmore-trigger').html("<div></div><div></div><div></div><div></div>");
                $.ajax({
                    url: ajax_loadmore.ajaxurl,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        action: 'load_more_products',
                        page: page,
                        posts_per_page: postsPerPage,
                        category: category,
                        tag: tag
                    },
                    success: function(response) {
                        if (response) {
                            $('.products').append(response.data);
                            loading = false;
                            $('.loadmore-trigger').html("<p>Scroll down to load more products</p>");

                            $('.products').find('.product:not(.loaded)').each(function(i) { 
                                $(this).find('img').addClass("is-loaded");
                                $(this).delay(i*2000).animate({'opacity': 1},800, 'swing', function() { 
                                    $(this).addClass("loaded");
                                });
                            });

                            if (response.max_num_pages == page) {
                                $('.loadmore-trigger').attr('data-disabled', 1);
                                $('[data-elementor-type="footer"]').css('display', 'block');
                            }
                            page++;
                        }
                    },
                });
            }
        }

        $(window).scroll(function() {
            var windowBottom = $(window).scrollTop() + $(window).height();
            var containerBottom = $('.loadmore-trigger').offset().top + $('.loadmore-trigger').height() - 200;

            var category = $('.products').attr('data-category');
            var tag = $('.products').attr('data-tag');

            var term = category ? category : tag;

            if (tmpCategory != term) {
                tmpCategory = term;
                page = 2
            }

            if (windowBottom >= containerBottom) {
                loadMorePosts(category, tag);
            }
        });
    }
});


