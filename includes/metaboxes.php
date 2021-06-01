<?php
if(! defined('ABSPATH')) exit;

function quizbook_add_metaboxes() {
   //add metabox to quizzes
   add_meta_box('quizbook_meta_box', 'Answers', 'quizbook_metaboxes', 'quizzes', 'normal', 'high', null);
}
add_action('add_meta_boxes', 'quizbook_add_metaboxes');


/**
 * Show metaboxes HTML content
 */

 function quizbook_metaboxes($post) { 
        wp_nonce_field(basename(__FILE__), 'quizbook_nonce');
        ?>
         <table class="form-table">
       <tr>
           <th class="row-title" colspan="2">
               <h2>Put your answer here</h2>
           </th>
       </tr>
       <tr>
           <th class="row-title">
               <label for="answer_a">a)</label>
           </th>
           <td>
               <input value="<?php echo esc_attr(get_post_meta($post->ID, 'qb_answer_a', true)); ?>" id="answer_a" name="qb_answer_a" class="regular-text" type="text">
           </td>
       </tr>
       <tr>
           <th class="row-title">
               <label for="answer_b">b)</label>
           </th>
           <td>
           <input value="<?php echo esc_attr(get_post_meta($post->ID, 'qb_answer_b', true)); ?>" id="answer_b" name="qb_answer_b" class="regular-text" type="text">
           </td>
       </tr>
       <tr>
           <th class="row-title">
               <label id="answer_c">c)</label>
           </th>
           <td>
           <input value="<?php echo esc_attr(get_post_meta($post->ID, 'qb_answer_c', true)); ?>" id="answer_c" name="qb_answer_c" class="regular-text" type="text">
           </td>
       </tr>
       <tr>
           <th class="row-title">
               <label id="answer_d">d)</label>
           </th>
           <td>
           <input value="<?php echo esc_attr(get_post_meta($post->ID, 'qb_answer_d', true)); ?>" id="answer_d" name="qb_answer_d" class="regular-text" type="text">
           </td>
       </tr>
       <tr>
           <th class="row-title">
               <label id="answer_e">e)</label>
           </th>
           <td>
           <input value="<?php echo esc_attr(get_post_meta($post->ID, 'qb_answer_e', true)); ?>" id="answer_e" name="qb_answer_e" class="regular-text" type="text">
           </td>
       </tr>
       <tr>
           <th class="row-title">
               <label for="correct_answer">Correct answer</label>
           </th>
           <td>
               <?php $answer = esc_html( get_post_meta($post->ID, 'quizbook_correct', true) ); ?>
               <select name="quizbook_correct" id="correct_answer" class="postbox">
                   <option value="">Select the correct answer</option>
                   <option <?php selected($answer, 'qb_correct:a') ?> value="qb_correct:a">a</option>
                   <option <?php selected($answer, 'qb_correct:b') ?> value="qb_correct:b">b</option>
                   <option <?php selected($answer, 'qb_correct:c') ?> value="qb_correct:c">c</option>
                   <option <?php selected($answer, 'qb_correct:d') ?> value="qb_correct:d">d</option>
                   <option <?php selected($answer, 'qb_correct:e') ?> value="qb_correct:e">e</option>
               </select>
           </td>
       </tr>
    </table>
   <?php  
 }

 function quizbook_save_metaboxes($post_id, $post, $update) {
    if(!isset($_POST['quizbook_nonce']) || !wp_verify_nonce( $_POST['quizbook_nonce'], basename(__FILE__)  ) )
      return $post_id;
  
    if(!current_user_can('edit_post', $post_id))
      return $post_id;
  
    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
      return $post_id;

    $answer_a = $answer_b = $answer_c = $answer_d = $answer_e = $correct = '';
    if(isset( $_POST['qb_answer_a'] ) ) {
        $answer_a = sanitize_text_field($_POST['qb_answer_a']);
      }
      update_post_meta($post_id, 'qb_answer_a', $answer_a );

    if(isset( $_POST['qb_answer_b'] ) ) {
        $answer_b = sanitize_text_field($_POST['qb_answer_b']);
      }
      update_post_meta($post_id, 'qb_answer_b', $answer_b );

    if(isset( $_POST['qb_answer_c'] ) ) {
        $answer_c = sanitize_text_field($_POST['qb_answer_c']);
      }
      update_post_meta($post_id, 'qb_answer_c', $answer_c );

    if(isset( $_POST['qb_answer_d'] ) ) {
        $answer_d = sanitize_text_field($_POST['qb_answer_d']);
      }
      update_post_meta($post_id, 'qb_answer_d', $answer_d );
      
    if(isset( $_POST['qb_answer_e'] ) ) {
        $answer_e = sanitize_text_field($_POST['qb_answer_e']);
      }
      update_post_meta($post_id, 'qb_answer_e', $answer_e );
    if(isset( $_POST['qb_answer_a'] ) ) {
        $answer_a = sanitize_text_field($_POST['qb_answer_a']);
      }
      update_post_meta($post_id, 'qb_answer_a', $answer_a );

    if(isset( $_POST['quizbook_correct'] ) ) {
        $correct = sanitize_text_field($_POST['quizbook_correct']);
      }
      update_post_meta($post_id, 'quizbook_correct', $correct );
 }
 add_action('save_post', 'quizbook_save_metaboxes', 10, 3);
