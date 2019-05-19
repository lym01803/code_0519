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
        item.innerHTML="<br/><select name=\"select\" onchange=\"change_div(parentNode.id)\">\
        <option value=\"sphere\">sphere</option>\
        <option value=\"cube\">cube</option>\
        </select><br/>\
        <p style = \"margin: 2px 0px; padding-bottom:0px;\" id="+p_id+">\
        radius:<input value=\"1\" name=\"radius\" autocomplete=\"off\"/><br/>\
        </p>\
        x:<input value=\"0\" name=\"x\" autocomplete=\"off\"/><br/>\
        y:<input value=\"0\" name=\"y\" autocomplete=\"off\"/><br/>\
        z:<input value=\"0\" name=\"z\" autocomplete=\"off\"/><br/>\
        <button onclick=\"del_an_widget(parentNode)\">Delete</button><br/>";
        document.body.appendChild(item);
    }
    function change_div(id_str){
        var sele = document.getElementsByName("select")[parseInt(id_str)];
        var type = sele.options[sele.selectedIndex].value;
        var tochange = document.getElementById("attrs"+id_str);
        if(type == "sphere"){
            tochange.innerHTML = "radius:<input value=\"1\" name=\"radius\" autocomplete=\"off\"/><br/>";
        }
        if(type == "cube"){
            tochange.innerHTML = "a:<input value=\"1\" name=\"cube_a\" autocomplete=\"off\"/><br/>\
            b:<input value=\"1\" name=\"cube_b\" autocomplete=\"off\"/><br/>\
            c:<input value=\"1\" name=\"cube_c\" autocomplete=\"off\"/><br/>";
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
            shapes[i]["x"] = document.getElementsByName("x")[i].value;
            shapes[i]["y"] = document.getElementsByName("y")[i].value;
            shapes[i]["z"] = document.getElementsByName("z")[i].value;
            //shapes[i]["radius"] = document.getElementsByName("radius")[i].value;
            var sele = document.getElementsByName("select")[i];
            shapes[i]["shape"] = sele.options[sele.selectedIndex].value
            if(shapes[i]["shape"] == "sphere"){
                shapes[i]["radius"] = document.getElementsByName("radius")[i].value;
            }
            if(shapes[i]["shape"] == "cube"){
                shapes[i]["a"] = document.getElementsByName("cube_a")[i].value;
                shapes[i]["b"] = document.getElementsByName("cube_b")[i].value;
                shapes[i]["c"] = document.getElementsByName("cube_c")[i].value;
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