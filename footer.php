        </div>
    </main>
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4><a href="<?php echo esc_url( get_permalink( get_page_by_path('faq') ) ); ?>">FAQ</a></h4>
                </div>
                <div class="footer-section">
                    <h4><a href="<?php echo esc_url( get_permalink( get_page_by_path('politica-de-privacidad') ) ); ?>">Política de Privacidad</a></h4>
                </div>
                <div class="footer-section">
                    <h4><a href="<?php echo esc_url( get_permalink( get_page_by_path('curiosidades') ) ); ?>">Curiosidades</a></h4>
                    <div class="curiosidades-footer-list">
                        <?php
                        $curiosidades_query = new WP_Query([
                            'post_type' => 'post',
                            'posts_per_page' => 3,
                            'orderby' => 'rand',
                            'category_name' => 'curiosidades',
                        ]);
                        if ($curiosidades_query->have_posts()) {
                            while ($curiosidades_query->have_posts()) {
                                $curiosidades_query->the_post();
                                echo '<div class="curiosidades-footer-item">';
                                echo '<h5><a href="' . get_permalink() . '">' . get_the_title() . '</a></h5>';
                                echo '<p>' . get_the_excerpt() . '</p>';
                                echo '</div>';
                            }
                            wp_reset_postdata();
                        } else {
                            echo '<p>No hay curiosidades disponibles.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> Blog Ferrocarril Esp. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
    <script>
    <?php
    $events = [];
    $args = [
        'post_type' => 'ferroblog_event',
        'posts_per_page' => -1,
    ];
    $event_query = new WP_Query($args);
    if ($event_query->have_posts()) {
        while ($event_query->have_posts()) {
            $event_query->the_post();
            $event_date = get_post_meta(get_the_ID(), '_event_date', true);
            if ($event_date) {
                $events[] = [
                    'title' => get_the_title(),
                    'date'  => $event_date,
                    'description' => get_the_excerpt(),
                ];
            }
        }
    }
    wp_reset_postdata();
    ?>
    const ferroblog_events = <?php echo json_encode($events); ?>;
    </script>
    <?php wp_footer(); ?>
</body>
</html>