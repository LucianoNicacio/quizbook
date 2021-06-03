(function($) {
    $('.quizbook ul li .answer').on('click', function() {
        $(this).siblings().removeClass('selected');
        $(this).siblings().removeAttr('selected', false);
        $(this).addClass('selected');
        $(this).attr('selected', true);
    });;

    $('#quizbook_send').on('submit', function(e) {
        e.preventDefault();

        var questions = jQuery('#quizbook ul li');

   var answers = [];

   $.each(questions, function(key, value) {
       var id_questions = $(value).attr('data-question');

       var result = jQuery('[data-question='+id_question+'] [selected]').prop('id');

       answers.push(result);

   });

   var data = {
       action: 'quizbook_results',
       answer: answers
   }
   $.ajax({
        url: admin_url.ajax_url,
        type: 'post',
        data: data

   }).done(function(answers){

   });
});

 
 })(jQuery);