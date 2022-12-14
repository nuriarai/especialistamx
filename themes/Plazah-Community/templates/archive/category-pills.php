<section class="bg-white box-sh-1 fixed-top mt-51" style="margin-left: 0; margin-right: 0;">
    <div class="container">
        <div class="row py-2">
            <div class="col-12 prx-0">
                <div id="category-pills" class="pills-row" style="overflow-x: auto;">
                    <ul class="nav nav-pills nav-pills-c nav-fill">
                        <?php
                        $categories = get_categories();
                        $current_cat = get_queried_object_id();
                        foreach ($categories as $category) {
                            //TODO: add in general option the cat "todos" and Sin categoría = 1

                            if ($category->term_id != 1) {
                                if ($current_cat == $category->term_id || (is_home() && $category->name == "TODOS")) {
                                    $class = "active";
                                } else {
                                    $class = "";
                                }
                                printf(
                                    '<li><a href="%1$s" class="nav-link %3$s">%2$s</a></li>',
                                    esc_url(get_category_link($category->term_id)),
                                    esc_html($category->name),
                                    esc_html($class)
                                );
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>