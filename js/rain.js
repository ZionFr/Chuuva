const rain = document.querySelector('.rain');

let count = 0;
const maxDrops = 100;
const interval = setInterval(() => {
  const drop = document.createElement('div');
  drop.classList.add('drop');
  drop.style.left = `${Math.random() * 100}vw`;
  drop.style.animationDuration = `${Math.random() * 0.5 + 0.5}s`;
  drop.style.animationDelay = `${Math.random() * 1}s`;
  rain.appendChild(drop);
  
  count++;
  if (count >= maxDrops) clearInterval(interval);
}, 50);