function icon_click(id, select){
    var menu_body = document.querySelector(select);
    var chkbox = document.getElementById(id);
    if(chkbox.checked){
        menu_body.classList.add("active");
        return;
    }
    menu_body.classList.remove("active");
}

function togle_icon(cross, check){
    var chk = document.getElementById(check);
    var crs = document.getElementById(cross);
    if(chk.checked == true){
        crs.checked = false;
        return;
    }
    crs.checked = true;
    return;
}