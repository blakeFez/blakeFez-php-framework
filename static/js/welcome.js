$(function(){
	var height = document.body.clientHeight,
		width = document.body.clientWidth,
		currentT = 0,
		currentL = 0,
		t,l,
		toBottom = true,
		toRight = true,
		letterW = $('#blakeFez').width(),
		letterH = $('#blakeFez').height();
	
	function moveLetter(){
		setInterval(function(){
			t = Math.round(Math.random() * 100);
			l = Math.round(Math.random() * 100);
			if(toBottom){
				if(currentT + t + letterH < height){
					currentT += t;
				}else{
					currentT = height - letterH;
					toBottom = false;
				}
			}else{
				if(currentT - t > 0){
					currentT -= t;
				}else{
					currentT = 0;
					toBottom = true;
				}
			}
			$('#blakeFez').css('top',currentT);
			
			if(toRight){
				if(currentL + l + letterW < width){
					currentL += l;
				}else{
					currentL = width - letterW;
					toRight = false;
				}
			}else{
				if(currentL - l > 0){
					currentL -= l;
				}else{
					currentL = 0;
					toRight = true;
				}
			}
			$('#blakeFez').css('left',currentL);
		},300);
	};
	moveLetter();
});