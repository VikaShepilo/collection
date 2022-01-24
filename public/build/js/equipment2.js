function toggle_visibility(id) {
  let e = document.getElementById(id);
  if(e.style.transform == 'rotate(0deg)') {
     e.style.transform = 'rotate(180deg)';
     }
  else
     e.style.transform = 'rotate(0deg)';
}