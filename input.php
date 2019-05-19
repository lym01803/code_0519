<!DOCTYPE html>
<html>


<script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>

<script>
    var total_div = 0
    function add_an_widget(){
        var item=document.createElement("div");
        item.id=String(total_div);
        total_div+=1;
        item.innerHTML="<select name=\"select\"><option value=\"sphere\">sphere</option></select><br/>\
        radius:<input value=\"1\" name=\"radius\" auto-complete=\"off\"/><br/>\
        x:<input value=\"0\" name=\"x\" auto-complete=\"off\"/><br/>\
        y:<input value=\"0\" name=\"y\" auto-complete=\"off\"/><br/>\
        z:<input value=\"0\" name=\"z\" auto-complete=\"off\"/><br/>\
        <button onclick=\"del_an_widget(parentNode)\">Delete</button><br/>";
        document.body.appendChild(item);
    }
    function del_an_widget(todelete){
        todelete.parentNode.removeChild(todelete); 
    }
    function draw(){
        var shapes = new Object();
        var list = document.getElementsByTagName("div");
        var nums = list.length;
        for(var i = 0; i < nums; ++i){
            var item = list[i];
            shapes[i] = new Object();
            shapes[i]["x"] = document.getElementsByName("x")[i].value;
            shapes[i]["y"] = document.getElementsByName("y")[i].value;
            shapes[i]["z"] = document.getElementsByName("z")[i].value;
            shapes[i]["radius"] = document.getElementsByName("radius")[i].value;
            var sele = document.getElementsByName("select")[i];
            shapes[i]["shape"] = sele.options[sele.selectedIndex].value
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