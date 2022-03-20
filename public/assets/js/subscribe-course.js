$('.add').on('click', function(){
    var rm_btn = `<a class="btn btn-danger remove" style="margin: auto; height: 35px; margin-top: 33px;" href="javascript:;"><i class="fa fa-minus"></i></a>`;
    var $div = $('.subscribe').clone();
    $div.removeClass('subscribe');
    $div.find('.add_btn').html(rm_btn);
    $div.removeClass('add_btn');
   $('.append').append($div);
});

$('body').on('click', '.remove', function(){        
   $(this).parent().parent().remove();
});

$('.attch-course').on('click',function(){
   
   error_flage = false;
   $('.course').each(function(key,html){
      
      $(html).val();
      if($(html).val() == undefined || $(html).val() == null || $(html).val() == ''){
         error_flage = true;
      }
   })

   $('.students').each(function(key,html){
      
      $(html).val();
      if($(html).val() == undefined || $(html).val() == null || $(html).val() == ''){
         error_flage = true;
      }
   })
   if(!error_flage){
      $(this).closest('form').submit();
   }
   else{
      $('.error_msg').removeAttr('hidden');
   }
})
