var ajaxku2;
function ajaxkota2(id){
    ajaxku2 = buatajax();
    var url="lib/select_kota2.php";
    url=url+"?q="+id;
    url=url+"&sid="+Math.random();
    ajaxku2.onreadystatechange=stateChanged2;
    ajaxku2.open("GET",url,true);
    ajaxku2.send(null);
}

function ajaxkec2(id){
    ajaxku2 = buatajax();
    var url="lib/select_kota2.php";
    url=url+"?kec="+id;
    url=url+"&sid="+Math.random();
    ajaxku2.onreadystatechange=stateChangedKec2;
    ajaxku2.open("GET",url,true);
    ajaxku2.send(null);
}

function ajaxkel2(id){
    ajaxku2 = buatajax();
    var url="lib/select_kota2.php";
    url=url+"?kel="+id;
    url=url+"&sid="+Math.random();
    ajaxku2.onreadystatechange=stateChangedKel2;
    ajaxku2.open("GET",url,true);
    ajaxku2.send(null);
}

function buatajax(){
    if (window.XMLHttpRequest){
    return new XMLHttpRequest();
    }
    if (window.ActiveXObject){
    return new ActiveXObject("Microsoft.XMLHTTP");
    }
    return null;
}
function stateChanged2(){
    var data;
    if (ajaxku2.readyState==4){
    data=ajaxku2.responseText;
    if(data.length>=0){
    document.getElementById("kota2").innerHTML = data
    }else{
    document.getElementById("kota2").value = "<option selected>Pilih Kota/Kab</option>";
    }
    }
}

function stateChangedKec2(){
    var data;
    if (ajaxku2.readyState==4){
    data=ajaxku2.responseText;
    if(data.length>=0){
    document.getElementById("kec2").innerHTML = data
    }else{
    document.getElementById("kec2").value = "<option selected>Pilih Kecamatan</option>";
    }
    }
}

function stateChangedKel2(){
    var data;
    if (ajaxku2.readyState==4){
    data=ajaxku2.responseText;
    if(data.length>=0){
    document.getElementById("kel").innerHTML = data
    }else{
    document.getElementById("kel").value = "<option selected>Pilih Kelurahan/Desa</option>";
    }
    }
}