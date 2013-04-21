
$(document).ready(function(){
	$("#jquery_jplayer_1").jPlayer({
		ready: function (event) {
			$(this).jPlayer("setMedia", {
				mp3:"http://stream2.hot2.cache11.vcdn.vn/fsfsdfdsfdserwrwq3/00cdb835aa81a60de7cdd9bddb6773e1/5171b303/2013/03/17/f/f/ff50f79e058ac022fd7f45f15d23870b.mp3",
			}).jPlayer("play");
		},
		swfPath: "js",
		supplied: "mp3",
		wmode: "window"
	});
});