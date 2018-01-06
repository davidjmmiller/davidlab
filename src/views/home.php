<p>Este es el contenido</p>
<p>Lenguaje: <?php echo $_SESSION['lang'] ?></p>

<a id="btn-login" href="/user/login" class="btn btn-default">Login</a>

<div class="row">
    <img id="imagen" src="/img/landscape.jpg" alt="Landscape">
</div>

<style>
    body { margin: 0;  perspective: 1000px;}
    canvas { width: 200px; height: 200px }
    #imagen {
        /*transform: rotateY(45deg);*/
        /*transform: translate3d(100px,200px, -100px);*/
        width: 400px;
        transition: transform 1s ease-in-out, border 1s ease-in-out;
        border: 1px solid black;
        animation-name: slide;
        animation-duration: 3s;
        animation-timing-function: ease-in-out;
        animation-direction: alternate;
        animation-iteration-count: infinite;
        animation-delay: 3s;
        animation-fill-mode: forwards;
    }
    #imagen:hover{
        transform: scale(1.2);
        border: 5px solid black;
    }
    
    @keyframes slide {
        from {
            transform: translateX(0);
        }
        to {
            transform: translateX(400px);
        }
    }
    
</style>
<script>
    var scene = new THREE.Scene();
    var camera = new THREE.PerspectiveCamera( 75, window.innerWidth/window.innerHeight, 0.1, 1000 );

    var renderer = new THREE.WebGLRenderer();
    renderer.setSize( 400, 200 );
    document.body.appendChild( renderer.domElement );

    var geometry = new THREE.BoxGeometry( 3, 1, 3 );
    var material = new THREE.MeshBasicMaterial( { color: 0x11aadd } );
    var cube = new THREE.Mesh( geometry, material );
    scene.add( cube );

    camera.position.z = 4;

    var animate = function () {
        requestAnimationFrame( animate );

        //cube.rotation.x += 0.05;
        cube.rotation.y += 0.05;

        renderer.render(scene, camera);
    };

    animate();
</script>