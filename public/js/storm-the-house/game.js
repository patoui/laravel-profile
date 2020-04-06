class Enemy {
  constructor(game) {
    const physics = game.physics.add.image(36, 80, 'enemy');

    physics.setVelocity(200, 0);
    physics.setCollideWorldBounds(true);
    physics.setInteractive();

    this.physics = physics;
    this.has_reached_wall = false;
    this.is_firing = false;
    this.health = 3;
    this.bullets = undefined;
  }

  isAtWall() {
    return this.has_reached_wall;
  }

  isDead() {
    return this.health === 0;
  }

  isFiring() {
    return this.is_firing;
  }

  isNearWall(wall_position) {
    return this.physics.x >= (wall_position - 30);
  }

  reachedWall(game) {
    this.has_reached_wall = true;
    this.stop();
    this.is_firing = true;
    this.generateBullets(game);
  }

  shot() {
    this.health = Math.max(this.health - 1, 0);

    if (this.isDead()) {
      this.physics.removeInteractive();
      this.stop();
    }
  }

  stop() {
    this.physics.setVelocity(0, 0);
  }

  generateBullets(game) {
    this.bullets = game.add.group({
      classType: Bullet,
      maxSize: 10,
      runChildUpdate: true
    });
    return this.bullets;
  }

  getBullet() {
    return this.bullets.get();
  }

  getX() {
    return this.physics.x;
  }

  getY() {
    return this.physics.y;
  }
}

const Bullet = new Phaser.Class({
  Extends: Phaser.GameObjects.Image,
  initialize:
    function Bullet(scene) {
      Phaser.GameObjects.Image.call(this, scene, 0, 0, 'bullet');
      this.speed = Phaser.Math.GetSpeed(200, 1);
      this.target = undefined;
    },

  fire: function (enemy, target) {
    this.setPosition(enemy.getX() + 10, enemy.getY());
    let y_delta = target.y - enemy.getY();
    let x_delta = target.x - enemy.getX();
    this.target = target;
    this.slope = y_delta / x_delta;
    this.setRotation(Math.atan2(y_delta, x_delta));
    this.setActive(true);
    this.setVisible(true);
  },

  update: function (time, delta) {
    this.x += this.speed * delta;
    this.y += this.speed * this.slope * delta;

    if (this.target && this.x > this.target.x) {
      this.setActive(false);
      this.setVisible(false);
    }
  }
});

function preload() {
  this.load.setBaseURL('/img/games/storm-the-house');

  this.load.image('enemy', 'enemy.png');
  this.load.image('wall', 'wall.jpg');
  this.load.image('house', 'house.png');
  this.load.image('bullet', 'bullet.png');
}

function create() {
  this.kill_count = 0;
  this.enemies = [];
  this.last_fired = 0;

  // Images
  this.house = this.add.image(750, 300, 'house');

  // Statics
  this.staticGroup = this.physics.add.staticGroup();
  this.wall = this.staticGroup.create(700, 300, 'wall');

  // Colliders
  let enemyOne = new Enemy(this);
  this.enemies.push(enemyOne);
  this.enemyOne = enemyOne;
  this.physics.add.collider(enemyOne.physics, this.staticGroup);

  // TODO: generate random enemies per level
  // this.enemies.forEach(function (enemy) {
  //   this.physics.add.collider(enemy.physics, this.staticGroup);
  // }, this);

  this.kill_count_text = this.add.text(260, 0, 'Kill Count: ' + this.kill_count)
    .setFont('32px Arial Black')
    .setFill('#000000')
    .setShadow(1, 1, '#333333', 1);

  this.input.on('gameobjectdown', function (pointer, gameobject) {
    if (!enemyOne.isDead() && gameobject === enemyOne.physics) {
      enemyOne.shot();
      this.kill_count += (enemyOne.isDead() ? 1 : 0);
    }
    this.kill_count_text.setText('Kill Count: ' + this.kill_count);
  }, this);
}

function update(time, delta) {
  if (!this.enemyOne.isAtWall() && this.enemyOne.isNearWall(this.wall.x)) {
    this.enemyOne.reachedWall(this);
  }

  if (this.enemyOne.isFiring() && time > this.last_fired && this.enemyOne.getBullet()) {
    this.enemyOne.getBullet().fire(this.enemyOne, this.house);
    this.last_fired = time + 50;
  }
}

new Phaser.Game({
  type: Phaser.CANVAS,
  width: 800,
  height: 600,
  canvas: document.getElementById('game_canvas'),
  backgroundColor: '#ffffff',
  physics: {default: 'arcade'},
  scene: {
    preload: preload,
    create: create,
    update: update
  }
});