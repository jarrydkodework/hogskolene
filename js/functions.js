/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery(document).ready(function (e) {


    jQuery(".next-button").click(function (e) {
        var question_now = $(e.target).attr('data-value');

        if ($('#setup_' + question_now + ' :radio:checked').length > 0)
        {
            var answerValue = $('#setup_' + question_now + ' :radio:checked').val();
            var questionVaue=$('#setup_' + question_now + '').attr('data-question');
            
            calculate_answer(answerValue,questionVaue,question_now);
            
        } else
        {
            alert("Please choose an option!");
        }




    });
    
    
        jQuery(".back-button").click(function (e) {
            //alert("back");
        var question_now = $(e.target).attr('data-value');

       $("#setup_"+question_now).show();
             $("#setup_"+(parseInt(question_now)+1)).hide();




    });

});

function calculate_answer(answerValue,questionVaue,counter)
{
    
    var data={
            action:'calculate',
            question:questionVaue,
            answer:answerValue
        };
        
        $.post(ajaxurl, data, function(response) {
             
            // alert(parseInt(counter)+1);
            
            var numItems = $('.questions_div').length;
            //alert(numItems);
            //alert(counter);
         if(numItems != counter){
             $("#setup_"+counter).hide();
             $("#setup_"+(parseInt(counter)+1)).show();
			 $('.answers ul li').responsiveEqualHeightGridDestroy();
			 $('.answers ul li').responsiveEqualHeightGrid();
         }else
         {
              window.location = "../summary/"
         }
             
             
	 	});
    
    
}