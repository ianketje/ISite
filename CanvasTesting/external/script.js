(function(){
	$(document).ready(function(){
		var game = {};
		
		game.stars = [];
		
		game.width = 550;
		game.height = 600;
		
		game.keys = [];
		
		game.projectiles = [];
		
		game.enemies = [];
		
		game.images = [];
		game.doneImages = 0;
		game.requiredImages = 0;
		
		game.gameOver = false;
		game.gameWon = false;
		
		game.count = 21;
		game.division = 42;
		game.left = false;
		game.enemyspeed = 2;
		
		game.explodeSound = new Audio("external/boom.wav");
		game.failSound = new Audio("external/fail.wav");
		game.winSound = new Audio("external/win.mp3");
		game.fireSound = new Audio("external/fire.mp3");
		
		game.moving = false;
		
		game.fullShootTimer = 30;
		game.shootTimer = game.fullShootTimer;
		
		game.player = {
			x: game.width / 2 - 40,
			y: game.height - 100,
			width: 40,
			height: 60,
			speed: 3,
			rendered: false
			
		};
		
		game.contextBackground = document.getElementById("BackgroundCanvas").getContext("2d");
		game.contextPlayer = document.getElementById("PlayerCanvas").getContext("2d");
		game.contextEnemies = document.getElementById("EnemiesCanvas").getContext("2d");
		
		
		$(document).keydown(function(e){
			game.keys[e.keyCode ? e.keyCode : e.which] = true;
		});
		
		$(document).keyup(function(e){
			delete game.keys[e.keyCode ? e.keyCode : e.which];
		});
		
		function addBullet(){
			game.projectiles.push({
				x: game.player.x + 10,
				y: game.player.y,
				size: 20,
				speed: 5,
				image: 2
			});
		}
		
		function init(){
			for(i = 0; i < 500; i++){
				game.stars.push({
					x: Math.floor(Math.random() * game.width),
					y: Math.floor(Math.random() * game.height),
					size: Math.random() * 5,
					speed: Math.random() * 4 + 1
				});
			}
			
			for(y = 0; y < 5; y++){
				for(x = 0; x < 6; x++){
					game.enemies.push({
						x: (x * 70) + 75,
						y: (y * 70) + 10,
						width: 40,
						height: 60,
						image: 1,
						dead: false,
						deadTime: 30
					});
				}
			}
			
			loop();
			setTimeout(function(){
				game.moving = true;
			}, 1000 * 10);
		}
		
		function addStars(n){
			for(i = 0; i < n; i++){
				game.stars.push({
					x: Math.floor(Math.random() * game.width),
					y: game.height + 10,
					size: Math.random() * 5,
					speed: Math.random() * 4 + 1
				});
			}
		}
		
		function update(){
			addStars(1);
			
			if(game.count > 1000000000){
				game.count = 0;
			}
			
			game.count++;
			
			if(game.shootTimer > 0){
				game.shootTimer--;
			}
			
			for(i in game.stars){
				if(game.stars[i].y <= -5){
					game.stars.splice(i, 1)
				}
				game.stars[i].y -= game.stars[i].speed / 2;
			}
			
			/* Keys
				w     - 87
				a     - 65
				s     - 83
				d     - 68
				space - 32
			*/
			
			if(game.keys[87] && !game.gameOver && !game.gameWon){
				if(game.player.y >= game.height / 2+100){
					game.player.y -= game.player.speed;	
					game.player.rendered = false;
				}				
			}
			
			if(game.keys[65] && !game.gameOver && !game.gameWon){
				if(game.player.x >= -10){
					game.player.x -= game.player.speed;
					game.player.rendered = false;
				}
			}
			
			if(game.keys[83] && !game.gameOver && !game.gameWon){
				if(game.player.y <= game.height - game.player.height + 10){
					game.player.y += game.player.speed;		
					game.player.rendered = false;		
				}
			}
			
			if(game.keys[68] && !game.gameOver && !game.gameWon){
				if(game.player.x <= game.width - game.player.width + 10){
					game.player.x += game.player.speed;	
					game.player.rendered = false;
				}				
			}
			
			if(game.keys[32] && game.shootTimer <= 0 && !game.gameOver && !game.gameWon){
				addBullet();
				game.fireSound.play();
				game.shootTimer = game.fullShootTimer;
			}
			
			if(game.count % game.division == 0){
				game.left = !game.left;
			}
			
			for(i in game.enemies){
				if(game.left){
					game.enemies[i].x -= game.enemyspeed;
				}else{
					game.enemies[i].x += game.enemyspeed;					
				}
				
				if(game.moving){
					game.enemies[i].y++;
					game.enemyspeed = 0.5;
				}
				
				if(game.enemies[i].y >= game.height){
					game.gameOver = true;
				}
			}
			
			for(i in game.projectiles){
				game.projectiles[i].y -= game.projectiles[i].speed;
				if(game.projectiles[i].y <= -game.projectiles[i].size){
					game.projectiles.splice(i, 1);
				}
			}
		
			for(e in game.enemies){
				for(p in game.projectiles){
					if(collision(game.enemies[e], game.projectiles[p])){
						game.enemies[e].dead = true;
						game.enemies[e].image = 3;
						game.explodeSound.play();
						game.contextEnemies.clearRect(game.projectiles[p].x, game.projectiles[p].y, game.projectiles[p].size, game.projectiles[p].size);
						game.projectiles.splice(p, 1);
					}
				}
			}
			
			for(i in game.enemies){
				if(game.enemies[i].dead){
					game.enemies[i].deadTime--;
				}
				if(game.enemies[i].dead && game.enemies[i].deadTime <= 0){
					game.contextEnemies.clearRect(game.enemies[i].x, game.enemies[i].y, game.enemies[i].width, game.enemies[i].height);
					game.enemies.splice(i, 1);
				}
			}
		
			if(game.enemies.length <= 0){
				game.gameWon = true;
			}
		}
		
		function render(){
			game.contextBackground.clearRect(0,0,game.width,game.height);
			game.contextBackground.fillStyle = "white";
			for(i in game.stars){
				var star = game.stars[i];
				game.contextBackground.fillRect(star.x, star.y, star.size, star.size);
			}
			
			if(!game.player.rendered){
				game.contextPlayer.clearRect(game.player.x, game.player.y, game.player.width, game.player.height);
				game.contextPlayer.drawImage(game.images[0], game.player.x, game.player.y, game.player.width, game.player.height);
				game.player.rendered = true;
			}
			
			for(i in game.enemies){
				var enemy = game.enemies[i];
				game.contextEnemies.clearRect(enemy.x, enemy.y, enemy.width, enemy.height);
				game.contextEnemies.drawImage(game.images[enemy.image], enemy.x, enemy.y, enemy.width, enemy.height);
			}
		
			for(i in game.projectiles){
				var proj = game.projectiles[i];
				game.contextEnemies.clearRect(proj.x, proj.y, proj.size, proj.size);
				game.contextEnemies.drawImage(game.images[proj.image], proj.x, proj.y, proj.size, proj.size);
			}
			
			if(game.gameOver){
				game.failSound.play();
				game.contextPlayer.font = "bold 50px monaco";
				game.contextPlayer.fillStyle = "white";
				game.contextPlayer.fillText("Game over", game.width/2-130, game.height/2-25)
			}
			
			if(game.gameWon){
				game.winSound.play();
				game.contextPlayer.font = "bold 50px monaco";
				game.contextPlayer.fillStyle = "white";
				game.contextPlayer.fillText("Game won!", game.width/2-130, game.height/2-25)
			}
		}
		
		function loop(){
			requestAnimFrame(function(){
				loop();
			});
			update();
			render();
		}
		
		function initImages(paths){
			game.requiredImages = paths.length;
			for(i in paths){
				var img = new Image();
				img.src = paths[i];
				game.images[i] = img;
				game.images[i].onload = function(){
					game.doneImages++;
				}
			}
		}
		
		function collision(first, second){
			return !(first.x > second.x + second.width   ||
				first.x + first.width < second.x         ||
				first.y > second.y + second.height       ||
				first.y + first.height < second.y);
		}
		
		function checkImages(){
			if(game.doneImages >= game.requiredImages){
				init();
			}else{
				setTimeout(function(){
					checkImages();
				}, 1);
			}
		}
		
		game.contextBackground.font = "bold 50px monaco";
		game.contextBackground.fillStyle = "white";
		game.contextBackground.fillText("Loading", game.width/2-100, game.height/2-25)
		initImages(["external/player.png", "external/enemy.png", "external/bullet.png", "external/boom.png"]);
		checkImages();
		
	});
})();

//Some Paul Irish luf <3
window.requestAnimFrame = (function(){
  return  window.requestAnimationFrame       ||
          window.webkitRequestAnimationFrame ||
          window.mozRequestAnimationFrame    ||
          window.oRequestAnimationFrame      ||
          window.msRequestAnimationFrame     ||
          function( callback ){
            window.setTimeout(callback, 1000 / 60);
          };
})();