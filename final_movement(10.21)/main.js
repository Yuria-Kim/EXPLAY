



$(document).ready(function(){
	fullset();
	quickClick();
});

function fullset(){
	var pageindex = $("#fullpage > .fullsection").size(); //fullpage 안에 섹션이(.fullsection) 몇개인지 확인하기
	for(var i=1;i<=pageindex;i++){
		$("#fullpage > .quick > ul").append("<li></li>");
	}
	$("#fullpage .quick ul :first-child").addClass("on"); //일단 화면이 로드 되었을때는 퀵버튼에 1번째에 불이 들어오게
	
	//마우스 휠 이벤트
	$(window).bind("mousewheel", function(event){
		var page = $(".quick ul li.on");
		//alert(page.index()+1);  // 현재 on 되어있는 페이지 번호
		if($("body").find("#fullpage:animated").length >= 1) return false;
		
		//마우스 휠을 위로
		if(event.originalEvent.wheelDelta >= 0) {
			var before=page.index();
			if(page.index() >= 0) page.prev().addClass("on").siblings(".on").removeClass("on");//퀵버튼옮기기
			var pagelength=0;
			for(var i=1; i<(before); i++)
			{
				pagelength += $(".full"+i).height();
			}
			if(page.index() > 0){ //첫번째 페이지가 아닐때 (index는 0부터 시작임)
				page=page.index()-1;
				$("#fullpage").animate({"top": -pagelength + "px"}, 500, "swing");
			}else{
				// alert("첫번째페이지 입니다.");
			}	
		}else{ // 마우스 휠을 아래로	
			var nextPage=parseInt(page.index()+1); //다음페이지번호
			var lastPageNum=parseInt($(".quick ul li").size()); //마지막 페이지번호
			//현재페이지번호 <= (마지막 페이지 번호 - 1)
			//이럴때 퀵버튼옮기기
			if(page.index() <= $(".quick ul li").size()-1){ 
				page.next().addClass("on").siblings(".on").removeClass("on");
			}
			
			if(nextPage < lastPageNum){ //마지막 페이지가 아닐때만 animate !
				var pagelength=0;
				for(var i = 1; i<(nextPage+1); i++){ 
					//총 페이지 길이 구하기
					//ex) 현재 1번페이지에서 2번페이지로 내려갈때는 1번페이지 길이 + 2번페이지 길이가 더해짐
					pagelength += $(".full"+i).height();
				}
				$("#fullpage").animate({"top": -pagelength + "px"}, 500, "swing");
			}
			else{ // 현재 마지막 페이지 일때는
				// alert("마지막 페이지 입니다!");
			};		
			
		}
		var logoTop = parseInt($("fullpage").css("top")) + 5; //조절할 위치
		$(".logo").css("top", logoTop + "px");
	});

	$(window).resize(function(){ 
		//페이지가 100%이기때문에 브라우저가 resize 될때마다 스크롤 위치가 그대로 남아있는것을 방지하기 위해
		var resizeindex = $(".quick ul li.on").index()+1;
		
		var pagelength=0;
		for(var i = 1; i<resizeindex; i++){ 
			//총 페이지 길이 구하기
			//ex) 현재 1번페이지에서 2번페이지로 내려갈때는 1번페이지 길이 + 2번페이지 길이가 더해짐
			pagelength += $(".full"+i).height();
		}

		$("#fullpage").animate({"top": -pagelength + "px"},0);
	});
}


// 사이드 퀵버튼 클릭 이동
function quickClick(){
	$(".quick li").click(function(){
		var gnbindex = $(this).index()+1;
		var length=0;
		for(var i=1; i<(gnbindex); i++)
		{
			length+=$(".full"+i).height();
		}
		if($("body").find("#fullpage:animated").length >= 1) return false;
		$(this).addClass("on").siblings("li").removeClass("on");
		
		$("#fullpage").animate({"top": -length + "px"}, 400, "swing");
		return false;
	});
}
setTimeout(transition, 1000);

$('.js-trigger-transition').on('click', function(e) {
  e.preventDefault();
  transition();
});

function transition() {
  var tl = new TimelineMax();
  
  tl.to(CSSRulePlugin.getRule('body:before'), 0.2, {cssRule: {top: '50%' }, ease: Power2.easeOut}, 'close')
  .to(CSSRulePlugin.getRule('body:after'), 0.2, {cssRule: {bottom: '50%' }, ease: Power2.easeOut}, 'close')
  .to($('.loader'), 0.2, {opacity: 1})
  .to(CSSRulePlugin.getRule('body:before'), 0.2, {cssRule: {top: '0%' }, ease: Power2.easeOut}, '+=1.5', 'open')
  .to(CSSRulePlugin.getRule('body:after'), 0.2, {cssRule: {bottom: '0%' }, ease: Power2.easeOut}, '-=0.2', 'open')
  .to($('.loader'), 0.2, {opacity: 0}, '-=0.2');
}

// // 페이지 전환효과
// $('#page_change').click(function() {
// 	// animate content
// 	$('#fullpage').addClass('animate_content');
// 	$('.wrap').fadeOut(100).delay(2800).fadeIn();
  
// 	setTimeout(function() {
// 	  $('#fullpage').removeClass('animate_content');
// 	}, 3200);
  
// 	//remove fadeIn class after 1500ms
// 	setTimeout(function() {
// 	  $('#fullpage').removeClass('fadeIn');
// 	}, 1500);
  
//   });
  
//   // on click show page after 1500ms
//   $('.logo').click(function() {
// 	setTimeout(function() {
// 	  $('.logo').addClass('fadeIn');
// 	}, 1500);
//   });
  
//   $('.projects_link').click(function() {
// 	setTimeout(function() {
// 	  $('.projects').addClass('fadeIn');
// 	}, 1500);
//   });
  
//   $('.skills_link').click(function() {
// 	setTimeout(function() {
// 	  $('.skills').addClass('fadeIn');
// 	}, 1500);
//   });
  


// // 이미지 더하기
// $(document).ready(function () {
//     var pageContainers = $(".page-container");
//     var currentPage = 0;
  
//     $(window).on("mousewheel", function (e) {
//       // 마우스 휠 방향에 따라 페이지 전환
//       if (e.originalEvent.wheelDelta / 120 > 0) {
//         // 위로 휠을 올릴 때
//         if (currentPage > 0) {
//           currentPage--;
//           scrollToPage(currentPage);
//         }
//       } else {
//         // 아래로 휠을 내릴 때
//         if (currentPage < pageContainers.length - 1) {
//           currentPage++;
//           scrollToPage(currentPage);
//         }
//       }
//     });
  
//     function scrollToPage(pageIndex) {
//       var pageHeight = $(window).height();
//       var newPosition = -pageIndex * pageHeight;
//       pageContainers.animate({ top: newPosition }, 800, "swing");
//     }
//   });

