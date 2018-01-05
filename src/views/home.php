<p>Este es el contenido</p>
<p>Lenguaje: <?php echo $_SESSION['lang'] ?></p>


<style>
    body { margin: 0; }
    canvas { width: 200px; height: 200px }
</style>
<script>
    var scene = new THREE.Scene();
    var camera = new THREE.PerspectiveCamera( 75, window.innerWidth/window.innerHeight, 0.1, 1000 );

    var renderer = new THREE.WebGLRenderer();
    renderer.setSize( 400, 200 );
    document.body.appendChild( renderer.domElement );

    var geometry = new THREE.BoxGeometry( 1, 1, 1 );
    var material = new THREE.MeshBasicMaterial( { color: 0x11aadd } );
    var cube = new THREE.Mesh( geometry, material );
    scene.add( cube );

    camera.position.z = 2;

    var animate = function () {
        requestAnimationFrame( animate );

        cube.rotation.x += 0.05;
        cube.rotation.y += 0.05;

        renderer.render(scene, camera);
    };

    animate();
</script>