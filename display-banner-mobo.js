var mobo_display_banner = getCookie("close_mobo_banner43");
if (!mobo_display_banner) {
    document.getElementById("mobo-banner").style.display = "block";
    document.getElementById("hidden-content").style.display = "block";
}
function close_mobo_banner() {
    setCookie("close_mobo_banner43", "1", 2*24*60*60);
    document.getElementById("mobo-banner").style.display = "none";
    document.getElementById("hidden-content").style.display = "none";
}
function setCookie(c_name,value,expiredays){
    c_name = 'zenjs_' + c_name;
    var today = new Date();
    today.setTime( today.getTime() );
    var expires = 30 * 1000 * 60;
    var expires_date = new Date( today.getTime() + (expires) );
    document.cookie = c_name+"="+value+";expires=" + expires_date.toGMTString();
}
function getCookie(c_name){
    if (document.cookie.length>0){
        c_name = 'zenjs_' + c_name;
        c_start=document.cookie.indexOf(c_name + "=");
        if (c_start!=-1){
            c_start=c_start + c_name.length+1;
            c_end=document.cookie.indexOf(";",c_start);
            if (c_end==-1) c_end=document.cookie.length;
            return unescape(document.cookie.substring(c_start,c_end));
        }
    }
    return "";
}