function sortTable(n) {
  let list, rows, s, i, x, y, shouldS, dir, icon, scount = 0;
  list = document.getElementById("myListItem");
  iconId = document.getElementById("icon");
  iconName = document.getElementById("iconName");
  s = true;
  dir = "asc"; 
  while (s) {
    s = false;
    rows = list.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldS = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i+1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldS= true;
          break;
        }
      if (n === 0) iconId.style.transform = "rotate(0deg)";
      if (n === 1) iconName.style.transform = "rotate(0deg)";    
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldS = true;
          break;
        }
      if (n === 0) iconId.style.transform = "rotate(180deg)";
      if (n === 1) iconName.style.transform = "rotate(180deg)";
      }
    }
    if (shouldS) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      s = true;
      scount ++;      
    } else {
      if (scount == 0 && dir == "asc") {
        dir = "desc";
        s = true;
      }
    }
  }
}