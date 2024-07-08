var mainImg = document.getElementById("mainImg");
var smallImg = document.getElementsByClassName("small-img");

smallImg[0] = function () {
  mainImg.src = smallImg[0].src;
};
