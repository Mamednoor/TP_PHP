document.getElementById("picture").addEventListener("change", function(evt){
  var p=document.getElementById("preview"); /* Bloc d'affichage de la liste des fichiers */
  p.innerHTML=""; /* Effacer le contenu initial de #preview */
  for (var i=0; i<this.files.length; i++) {
    var f=this.files[i];
    var div=document.createElement("div");
    div.className="image";
    var span=document.createElement("span");
    span.innerHTML=f.name+" ("+getHumanSize(f.size)+")";
    var vignette=document.createElement("img");
    vignette.src = window.URL.createObjectURL(f); 
    /* Attacher les élements HTML au DOM */
    div.appendChild(vignette);
    div.appendChild(span);
    p.appendChild(div);
  }
  p.style.display="flex";  
  img.style="flex"
});
/* Retourne une taille de fichier en mode lisible par un humain */
function getHumanSize(s) {
  s=parseInt(s); /* Pour s'assurer que le paramètre d'entrée est entier */
  if (s<1024) {
    return s+" o";  
  } else if (s<1024*1024) {
    return (s/1024).toFixed(1)+" ko";  
  } else if (s<1024*1024*1024) {
    return (s/1024/1024).toFixed(1)+" Mo";  
  } else {
    return (s/1024/1024/1024).toFixed(1)+" Go";  
  }
}
console.log(getHumanSize(1050));    // 1.0 ko
console.log(getHumanSize(400000));  // 390.6 ko
console.log(getHumanSize(5000000)); // 4.8 Mo
