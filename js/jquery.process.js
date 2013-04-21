var block = false;
$("#bu_form").submit(function() {
	if (block) return false;
	var by 		= $("#type").val();
	var keyword = $("#search").val();
	if(keyword=="Nhập từ khóa...") {
		alert('Xin mời Nhập từ khóa');
		return false;
	}
	if(keyword.length<2 || keyword.length>70) {
		alert('Từ khóa không hợp lệ');
		return false;
	}
	showLoader("load");
	$.ajax({
		url: 'index.php',
		type: 'POST',
		data: {type:'bu', keyword:keyword, by:by},
		success: function(data){
			showResult("list",data);
		}
	});
	return false;
});
function showLoader(type) {
$("#"+type+"_result").html("<img src='theme/img/load.gif' /> Loading...");
block = true;
}
function showResult(type,data) {
	$("#"+type+"_result").html(data);
	exitContent("load");
	auto_scroll('#'+type+'_result');
	block = false;
}
function exitContent(type) {
	$("#"+type+"_result").html('');
	block = false;
}
function closeContent(type) {
	$("#"+type+"_result").html('');
	block = false;
}
function loadAjax(keyword,page,by,row){
showLoader('load');
    $.ajax({
        url: 'index.php',
        type: 'POST',
        data: "keyword="+keyword+"&page="+page+"&by="+by+"&row="+row,
        dataType: "html",
        success: function(data){
            showResult("list",data);
        }
    });
}
function playAjax(id){
showLoader('load');
    $.ajax({
        url: 'get.php',
        type: 'POST',
        data: "id="+id+"&type=play",
        dataType: "html",
        success: function(data){
            showResult("play",data);
        }
    });
}
function playYoutube(id){
showLoader('load');
    $.ajax({
        url: 'youtube.php',
        type: 'POST',
        data: "id="+id,
        dataType: "html",
        success: function(data){
            showResult("play",data);
        }
    });
}
function topSong(type,page){
showLoader('load');
    $.ajax({
        url: 'index.php',
        type: 'POST',
        data: "page="+page+"&type="+type,
        dataType: "html",
        success: function(data){
            showResult("top",data);
        }
    });
}
function topAlbum(type,page){
showLoader('load');
    $.ajax({
        url: 'index.php',
        type: 'POST',
        data: "page="+page+"&type="+type+"&types=topalbum",
        dataType: "html",
        success: function(data){
            showResult("topalbum",data);
        }
    });
}
function addPl(type,id,name,singer){
showLoader('load');
    $.ajax({
        url: 'playlist.php',
        type: 'POST',
        data: "type="+type+"&id="+id+"&name="+name+"&singer="+singer,
        dataType: "html",
        success: function(data){
			if(data == 'Ca khúc này đã có trong playlist')
			{
				exitContent("load");
				alert(data);
				return false;				
			}
			else if(data == 'Có lỗi xẩy ra , vui lòng thử lại')
			{
				exitContent("load");
				alert(data);
				return false;				
			}
			else if(data == 'Đã xóa toàn bộ ca khúc trong playlist')
			{
				alert(data);
				showPl();				
			}
			else
			{
            	showPl();
			}
        }
    });
}
function showPl(){
showLoader('load');
    $.ajax({
        url: 'playlist.php',
        type: 'POST',
        data: "type=show",
        dataType: "html",
        success: function(data){
            showResult("playlist",data);
        }
    });
}
function playPl(){
showLoader('load');
    $.ajax({
        url: 'playlist.php',
        type: 'POST',
        data: "type=play",
        dataType: "html",
        success: function(data){
            showResult("play",data);
        }
    });
}
function playAlbum(id){
showLoader('load');
    $.ajax({
        url: 'index.php',
        type: 'POST',
        data: "type=playalbum&id="+id,
        dataType: "html",
        success: function(data){
            showResult("play",data);
        }
    });
}
function killErrors() {
return true;
}
window.onerror = killErrors;