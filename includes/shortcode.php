<?php
if(! defined('ABSPATH')) exit;

//Create a Shortcode, use: [quizbook]
function quizbook_shortcode($atts) {
    $args = array(
        'posts_per_page' => $atts['questions'],
        'orderby' =>  $atts['order'],
        'post_type' => 'quizzes',
    );
    $quizbook = new WP_Query($args); ?>
    <form name="quizbook_send" id="quizbook_send">
        <div id="quizbook" class="quizbook">
            <ul>
            <?php while($quizbook->have_posts()): $quizbook->the_post(); ?>
                <li data-question="<?php echo get_the_ID(); ?>">
                    <h3><?php the_title(); ?></h3>
                    <?php the_content(); ?>

                    <?php
                       $options = get_post_meta(get_the_ID() );
                       foreach($options as $key  => $option){
                            $result = quizbook_filter_questions($key);
                            $number = explode('_', $key);
                            if($result === 0) { ?>
                                <div id="<?php echo get_the_ID() . ":" . $number[2]; ?>" class="answer">
                                  <?php echo $option[0]; ?>
                                </div>
                            <?php }
                       }
                    ?>
                </li>
    
            <?php endwhile; ?>
            </ul>
        </div> <!--#quizbook-->
    
        <input type="submit" value="Send" id="quizbook_btn_submit">
    
        <div id="quizbook_result"></div>
    </form><!--form-->
    <?php wp_reset_postdata();
}
add_shortcode('quizbook', 'quizbook_shortcode');