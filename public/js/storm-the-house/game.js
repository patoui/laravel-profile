class Enemy {
  constructor(game) {
    const physics = game.physics.add.image(36, 80, 'enemy');

    physics.setVelocity(100, 0);
    physics.setCollideWorldBounds(true);
    physics.setInteractive();

    this.physics = physics;
    this.has_reached_wall = false;
    this.health = 3;
  }

  isDead() {
    return this.health === 0;
  }

  reachedWall() {
    this.has_reached_wall = true;
    this.stop();
    // start firing
  }

  shot() {
    this.health -= (this.health > 0 ? 1 : 0);

    if (this.health === 0) {
      this.stop();
    }
  }

  stop() {
    this.physics.setVelocity(0, 0);
  }
}

function preload() {
  this.load.setBaseURL('/img/games/storm-the-house');

  this.load.image('enemy', 'enemy.png');
  this.load.image('wall', 'wall.jpg');
  this.load.image('house', 'house.png');
}

function create() {
  this.wall_position = 700;
  this.kill_count = 0;
  this.enemies = [];

  // Images
  this.add.image(750, 300, 'house');

  // Statics
  let wallGroup = this.physics.add.staticGroup();
  this.wall = wallGroup.create(this.wall_position, 300, 'wall');

  // Colliders
  let enemyOne = new Enemy(this);
  this.enemyOne = enemyOne;
  this.physics.add.collider(enemyOne.physics, wallGroup);

  this.kill_count_text = this.add.text(260, 0, 'Kill Count: ' + this.kill_count)
    .setFont('32px Arial Black')
    .setFill('#000000')
    .setShadow(1, 1, '#333333', 1);

  this.input.on('gameobjectup', function (pointer, gameobject) {
    if (gameobject === enemyOne.physics) {
      enemyOne.shot();
      this.kill_count += (enemyOne.isDead() ? 1 : 0);
    }
    this.kill_count_text.setText('Kill Count: ' + this.kill_count);
  }, this);
}

function update() {
  if (!this.enemyOne.has_reached_wall && this.enemyOne.physics.x >= (this.wall_position - 10)) {
    this.enemyOne.reachedWall();
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