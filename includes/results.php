<?php
if(! defined('ABSPATH')) exit;

//receive parameters by quizbook.js and send back an AJAX result
function quizbook_results() {
    if(isset($_POST['data'])) {
        $answers = $_POST['data'];
    }

    foreach($answers as $ans){
        $question = explode(':', $ans);
        $correct = get_post_meta($question[0], 'quizbook_correct', true);

        $letter_correct = explode(':', $correct);
    }

  $answer = array(
      'answer' => $answers
  );

  header('Content-type: application/json');
  echo json_encode($answer);
  die();
}
add_action('wp_ajax-nopriv_quizbook_results');
add_action('wp_ajax_quizbook_results', 'quizbook_results');