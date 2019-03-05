var camera, scene, renderer,
	geometry, material, mesh,
	posX=0, posY=0, currentPos, prevPos=0;

init();
animate();

function init() {
    // stats = new Stats();
    // stats.setMode(0);
    // stats.domElement.style.position = 'absolute';
    // stats.domElement.style.left = '0px';
    // stats.domElement.style.top = '0px';
    // document.body.appendChild(stats.domElement);

    clock = new THREE.Clock();

    renderer = new THREE.WebGLRenderer();
    renderer.setSize( window.innerWidth, window.innerHeight );

    scene = new THREE.Scene();

    camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 1, 10000 );

	if(window.innerWidth/window.innerHeight < 1) camera.position.z = 1200;
	else camera.position.z = 1000;

	scene.add( camera );

    geometry = new THREE.CubeGeometry( 200, 200, 200 );
    material = new THREE.MeshLambertMaterial( { color: 0xaa6666, wireframe: false } );
    mesh = new THREE.Mesh( geometry, material );
    //scene.add( mesh );
    cubeSineDriver = 0;

    textGeo = new THREE.PlaneGeometry(300,300);
    THREE.ImageUtils.crossOrigin = ''; //Need this to pull in crossdomain images from AWS
    textTexture = THREE.ImageUtils.loadTexture('assets/images/srijanLogo.png');
    textMaterial = new THREE.MeshLambertMaterial({color: 0xffffff, opacity: 1, map: textTexture, transparent: true, blending: THREE.AdditiveBlending})
    text = new THREE.Mesh(textGeo,textMaterial);
    text.position.z = 800;
    scene.add(text);

    light = new THREE.DirectionalLight(0xffffff,0.5);
    light.position.set(-1,0,1);
    scene.add(light);

    smokeTexture = THREE.ImageUtils.loadTexture('assets/images/Smoke-Element.png');
    smokeMaterial = new THREE.MeshLambertMaterial({color: 0x00aadd, map: smokeTexture, transparent: true});
    smokeGeo = new THREE.PlaneGeometry(300,300);
    smokeParticles = [];


    for (p = 0; p < 150; p++) {
        var particle = new THREE.Mesh(smokeGeo,smokeMaterial);
        particle.position.set(Math.random()*500-250,Math.random()*500-250,Math.random()*1000-150);
        particle.rotation.z = Math.random() * 360;
        scene.add(particle);
        smokeParticles.push(particle);
    }

    document.getElementById('hero').appendChild( renderer.domElement );
	window.addEventListener( 'resize', onWindowResize, false );
    if( navigator.userAgent.toLowerCase().indexOf('firefox') > -1 ) {
		window.addEventListener('scroll', function(event){
			currentPos = event.pageY;
			camera.position.z = camera.position.z + (currentPos - prevPos)/3;
			prevPos = currentPos;
		});
	}
	// document.getElementById('hero').addEventListener('mousemove', onMouseMove);
	// document.getElementById('hero').addEventListener('mouseleave', onMouseLeave);
}

function animate() {

    // note: three.js includes requestAnimationFrame shim
    // stats.begin();
    delta = clock.getDelta();
    requestAnimationFrame( animate );
    evolveSmoke();
    render();
    // stats.end();
}

function evolveSmoke() {
    var sp = smokeParticles.length;
    while(sp--) {
        smokeParticles[sp].rotation.z += (delta * 0.2);
    }
}

function render() {

    mesh.rotation.x += 0.005;
    mesh.rotation.y += 0.01;
    cubeSineDriver += .01;
	mesh.position.z = 100 + (Math.sin(cubeSineDriver) * 500);

	// if(camera.position.x < posX) camera.position.x += 0.3;
	// else if(camera.position.x > posX) camera.position.x -= 0.3;

	// if(camera.position.y < posY) camera.position.y += 0.15;
	// else if(camera.position.y > posY) camera.position.y -= 0.15;

    renderer.render( scene, camera );

}

function onWindowResize() {
	camera.aspect = window.innerWidth / window.innerHeight;
	camera.updateProjectionMatrix();
	renderer.setSize( window.innerWidth, window.innerHeight );
	if(window.innerWidth/window.innerHeight < 1) camera.position.z = 1200;
	else camera.position.z = 1000;
}

function onMouseMove(event){
	posX = -event.clientX/75;
	posY = +event.clientY/50;
}

function onMouseLeave(){
	posX = 0;
	posY = 0;
}
