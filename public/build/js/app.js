let paso=1;function iniciarApp(){tabs()}function mostrarSeccion(){}function tabs(){document.querySelectorAll(".tabs button").forEach(t=>{t.addEventListener("click",(function(t){paso=parseInt(t.target.dataset.paso),mostrarSeccion()}))})}document.addEventListener("DOMContentLoaded",(function(){iniciarApp()}));