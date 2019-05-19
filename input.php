<!DOCTYPE html>
<html>


<script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>

<script>
    var total_div = 0
    function add_an_widget(){
        var item=document.createElement("div");
        item.id=String(total_div);
        total_div+=1;
        var p_id="attrs"+item.id;
        item.innerHTML="<br/><select id=\"select"+item.id+"\" onchange=\"change_div(parentNode.id)\">\
        <option value=\"sphere\">sphere</option>\
        <option value=\"cube\">cube</option>\
        </select><br/>\
        <p style = \"margin: 2px 0px; padding-bottom:0px;\" id="+p_id+">\
        radius:<input value=\"1\" id=\"radius"+item.id+"\" autocomplete=\"off\"/><br/>\
        </p>\
        x:<input value=\"0\" id=\"x"+item.id+"\" autocomplete=\"off\"/><br/>\
        y:<input value=\"0\" id=\"y"+item.id+"\" autocomplete=\"off\"/><br/>\
        z:<input value=\"0\" id=\"z"+item.id+"\" autocomplete=\"off\"/><br/>\
        <button onclick=\"del_an_widget(parentNode)\">Delete</button><br/>";
        document.body.appendChild(item);
    }
    function change_div(id_str){
        //alert(1);
        var sele = document.getElementById("select"+id_str);
        var type = sele.options[sele.selectedIndex].value;
        var tochange = document.getElementById("attrs"+id_str);
        if(type == "sphere"){
            tochange.innerHTML = "radius:<input value=\"1\" id=\"radius"+id_str+"\" autocomplete=\"off\"/><br/>";
        }
        if(type == "cube"){
            tochange.innerHTML = "a:<input value=\"1\" id=\"cube_a"+id_str+"\" autocomplete=\"off\"/><br/>\
            b:<input value=\"1\" id=\"cube_b"+id_str+"\" autocomplete=\"off\"/><br/>\
            c:<input value=\"1\" id=\"cube_c"+id_str+"\" autocomplete=\"off\"/><br/>";
        }
    }
    function del_an_widget(todelete){
        todelete.parentNode.removeChild(todelete); 
    }
    function draw(){
        var shapes = new Object();
        var list = document.getElementsByTagName("div");
        var nums = list.length;
        //alert(nums);
        for(var i = 0; i < nums; ++i){
            var item = list[i];
            shapes[i] = new Object();
            //alert(document.getElementsByName("x").length);
            shapes[i]["x"] = document.getElementById("x"+item.id).value;
            shapes[i]["y"] = document.getElementById("y"+item.id).value;
            shapes[i]["z"] = document.getElementById("z"+item.id).value;
            //shapes[i]["radius"] = document.getElementsByName("radius")[i].value;
            var sele = document.getElementById("select"+item.id);
            shapes[i]["shape"] = sele.options[sele.selectedIndex].value
            if(shapes[i]["shape"] == "sphere"){
                //alert(item.id);
                shapes[i]["radius"] = document.getElementById("radius"+item.id).value;
            }
            if(shapes[i]["shape"] == "cube"){
                shapes[i]["a"] = document.getElementById("cube_a"+item.id).value;
                shapes[i]["b"] = document.getElementById("cube_b"+item.id).value;
                shapes[i]["c"] = document.getElementById("cube_c"+item.id).value;
            }
        }
        var urlstr = jQuery.param(shapes);
        //alert(urlstr);
        parent.document.getElementById("rightframe").src = "output.php?" + urlstr;
    }
</script>

<body>
    <button onclick="add_an_widget()">添加</button>
    <button onclick="draw()">绘图</button>
</body>

</html>