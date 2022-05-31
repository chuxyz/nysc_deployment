// JavaScript Document
$(function(){
setInterval(swap,3000);
$('#new-record').click(function(){
	$('body').css({'overflow':'hidden'});
	$('#transparent').fadeTo('slow',0.5,function(){
		$('#pop-up').fadeIn();
		});
	});
$('#pop-up img,#upload').click(function(){
	$('#pop-up').fadeOut('slow',function(){
		$('#transparent').fadeOut();
		});
	});
$("input#names").focus(function(){
	var initVal = $(this).val();
	if(initVal == 'Enter Your Surname'){
	$(this).val("").css({'color':'#000'});
	}
	else return;
	});
$("input#names").blur(function(){
	var initVal = "Enter Your Surname";
	var finalVal = $(this).val();
	if(finalVal == ""){
		$(this).val(initVal).css({'color':'#DBB7B7'});
	}
	});
$("form#callup").submit(function(){
	if($("input#names").val() == 'Enter Your Surname'){
	$("input#names").val("");
	}
	return;
	});
$("#print").click(function(){
	window.print();
	});
});



function swap(){
	var num = Math.random() * 10 - 2;
	var num2 = Math.round(num);
	if(num2 == NaN){
		num2 = 3;
	}
	if(num2>5.5){
		num2 = 5;
	}
	if(num2<0){
		num2 = 0;
	}
	var img = new Array("images/nysc1.png","images/nysc2.png","images/nysc3.png","images/nysc4.png","images/nysc5.png","images/nysc6.png");
	//alert(img[num2]+num2+" "+num);
    $("#imgBox img").hide().fadeIn(2000).attr({"src":""+img[num2]+""});
}
