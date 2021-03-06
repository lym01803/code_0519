<!DOCTYPE html>
<html>

<head>
    <title></title>
    <style>
        canvas {
            width: 100%;
            height: 100%
        }
    </style>
    <script src="https://threejs.org/build/three.min.js"></script>
</head>

<body>
    <script>
        function lym_min(a, b){
            if(a < b){
                return a;
            }
            return b;
        }
        var scene = new THREE.Scene();
        //alert(window.innerWidth);
        var camera = new THREE.OrthographicCamera( window.innerWidth / - 25, window.innerWidth / 25, window.innerHeight / 25, window.innerHeight / - 25, 0.1, 1000 );

        var renderer = new THREE.WebGLRenderer({
            antialias:true,
            alpha:true,
        });

        light = new THREE.DirectionalLight(0xcccccc);
        light.position.set(-10, 30, 30);
        light.distance = 0;
        light.intensity = 1.8;
        scene.add(light);
        light2 = new THREE.AmbientLight(0xcccccc);
        light2.intensity = 0.2;
        scene.add(light2);

        renderer.setSize(window.innerWidth, window.innerHeight);

        document.body.appendChild(renderer.domElement);

        var geo_color=Array(0x00ff00, 0x0000ff, 0xff0000, 0xffff00, 0x00ffff, 0xff00ff);
        var Arr = <?php echo json_encode($_GET); ?>;
        for(var i = 0; i < Arr.length; ++i){
            var item = Arr[i];
            if(item["shape"] == "sphere"){
                var radius = parseFloat(item["radius"]);
                var geometry = new THREE.SphereGeometry(radius, 30, 30);
                var dx = parseFloat(item["x"]);
                var dy = parseFloat(item["y"]);
                var dz = parseFloat(item["z"]);
                geometry.translate(dx, dy, dz);
                var material = new THREE.MeshLambertMaterial({
                    color: geo_color[i%geo_color.length],
                });
                var sphere = new THREE.Mesh(geometry, material);
                scene.add(sphere);
            }
            if(item["shape"] == "cube"){
                var a = parseFloat(item["a"]);
                var b = parseFloat(item["b"]);
                var c = parseFloat(item["c"]);
                var geometry = new THREE.CubeGeometry(a, b, c);
                var dx = parseFloat(item["x"]);
                var dy = parseFloat(item["y"]);
                var dz = parseFloat(item["z"]);
                geometry.translate(dx, dy, dz);
                var material = new THREE.MeshLambertMaterial({
                    color: geo_color[i%geo_color.length],
                });
                var cube = new THREE.Mesh(geometry, material);
                scene.add(cube);
            }
        }
        /*var radius;
        if(Arr.hasOwnProperty("radius")){
            radius = Arr["radius"];
        }
        else{
            radius = 1;
        }

        var geometry = new THREE.SphereGeometry(radius, 30, 30);
        if(Arr.hasOwnProperty("dr")){
            geometry.translate(parseFloat(Arr["dr"]["dx"]), parseFloat(Arr["dr"]["dy"]), parseFloat(Arr["dr"]["dz"]));
        }
        var material = new THREE.MeshLambertMaterial({
            color: 0x00ff00
        });
        var cube = new THREE.Mesh(geometry, material);
        scene.add(cube);*/
        scene.add(light);
        camera.position.set(200,200,200);//设置相机位置
        camera.lookAt(scene.position);
        //camera.position.z = lym_min(window.innerWidth / 25, window.innerHeight / 25);
        //cube.rotation.x += 0.5;
        //cube.rotation.y += 0.5;

        function render() {
            requestAnimationFrame(render);
            renderer.render(scene, camera);
        }
        render();
    </script>
</body>

</html>