$(function(){
  $('.email-box').mouseover(function(){
    //gets the current placeholder
    this.holder=$(this).attr('placeholder');
    $(this).attr('placeholder', 'email |');
  });
  $('.email-box').mouseout(function(){
    $(this).attr('placeholder', this.holder); //sets it back to the initial value
  });
})

