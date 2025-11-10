<?php
/**
 * Plantilla de comentarios para el tema Ferrocarril Esp
 */

if (!defined('ABSPATH')) {
    exit;
}

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if (have_comments()) : ?>
        <h3 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ('1' === $comments_number) {
                printf(__('Una respuesta a "%s"', 'ferrocarril-esp'), get_the_title());
            } else {
                printf(
                    _nx(
                        '%1$s respuesta a "%2$s"',
                        '%1$s respuestas a "%2$s"',
                        $comments_number,
                        'comments title',
                        'ferrocarril-esp'
                    ),
                    number_format_i18n($comments_number),
                    get_the_title()
                );
            }
            ?>
        </h3>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 50,
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation();
        ?>

    <?php endif; ?>

    <?php
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
    ?>
        <p class="no-comments"><?php _e('Los comentarios están cerrados.', 'ferrocarril-esp'); ?></p>
    <?php endif; ?>

    <?php
    comment_form(array(
        'title_reply'         => __('Deja un comentario', 'ferrocarril-esp'),
        'title_reply_to'      => __('Responder a %s', 'ferrocarril-esp'),
        'cancel_reply_link'   => __('Cancelar respuesta', 'ferrocarril-esp'),
        'label_submit'        => __('Publicar comentario', 'ferrocarril-esp'),
        'comment_field'       => '<p class="comment-form-comment"><label for="comment">' . __('Comentario', 'ferrocarril-esp') . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea></p>',
        'fields'              => array(
            'author' => '<p class="comment-form-author">' .
                       '<label for="author">' . __('Nombre', 'ferrocarril-esp') . ' <span class="required">*</span></label> ' .
                       '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" maxlength="245" required="required" /></p>',
            'email'  => '<p class="comment-form-email"><label for="email">' . __('Correo electrónico', 'ferrocarril-esp') . ' <span class="required">*</span></label> ' .
                       '<input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" maxlength="100" aria-describedby="email-notes" required="required" /></p>',
            'url'    => '<p class="comment-form-url"><label for="url">' . __('Sitio web', 'ferrocarril-esp') . '</label> ' .
                       '<input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" maxlength="200" /></p>',
        ),
        'class_submit'        => 'btn-comment',
        'submit_button'       => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
        'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">' . __('Tu dirección de correo electrónico no será publicada.', 'ferrocarril-esp') . '</span> ' . __('Los campos obligatorios están marcados con *', 'ferrocarril-esp') . '</p>',
        'comment_notes_after'  => '',
    ));
    ?>

</div><!-- #comments -->
