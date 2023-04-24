const imgPosition=document.querySelectorAll(".aspect-ratio-169 img")
const imgContainer=document.querySelector('.aspect-ratio-169')
const dotItem=document.querySelectorAll('.dot')
let imgNumber=imgPosition.length
let index=0
 console.log(imgPosition);
imgPosition.forEach(function(image,index) {
    image.style.left = index*100 +"%";
    dotItem[index].addEventListener("click",function () {
        slider(index)
    })
})
function imgSilde() {
    index++
    if (index >=imgNumber) {
        index=0;
    }
    slider(index)
}
function slider(index) {
    imgContainer.style.left= "-" +index*100+"%";
    // const dotActive=document.querySelector('.active')
    // dotActive.classList.remove('active')
    dotItem[index].classList.add('active')
}
setInterval(imgSilde,5000);
// ----menu slidebar category----
const itemSlideBar=document.querySelectorAll(".category-letf-li")
itemSlideBar.forEach(function (menu,index) {
    menu.addEventListener("click",function() {
        menu.classList.toggle("block")
    })
})


// -----------------product-------------------------------
const bigImg   = document.querySelector(".product-content-left-big-img img")
const smallImg = document.querySelectorAll(".product-content-left-small-img img")
   smallImg.forEach(function (imgItiem,x) {
        imgItiem.addEventListener("click",function(){
            bigImg.src = imgItiem.src
        })
    }
   )
const baoquan=document.querySelector(".baoquan")
const chitiet=document.querySelector(".chitiet")
const thamkhao=document.querySelector(".thamkhao")
    if(baoquan){
        baoquan.addEventListener("click",function () {
            document.querySelector(".product-content-right-product-bottom-content-center-chitiet").style.display = "none"  
            document.querySelector(".product-content-right-product-bottom-content-center-thamkhao").style.display = "none"       
            document.querySelector(".product-content-right-product-bottom-content-center-baoquan").style.display = "block"
          
        })
    } if (chitiet) {
        chitiet.addEventListener("click",function () {
            document.querySelector(".product-content-right-product-bottom-content-center-chitiet").style.display = "block"
            document.querySelector(".product-content-right-product-bottom-content-center-baoquan").style.display = "none" 
            document.querySelector(".product-content-right-product-bottom-content-center-thamkhao").style.display = "none"        
        })
    }
     if (thamkhao) {
        chitiet.addEventListener("click",function () {
            document.querySelector(".product-content-right-product-bottom-content-center-thamkhao").style.display = "block"
            document.querySelector(".product-content-right-product-bottom-content-center-baoquan").style.display = "none"
            document.querySelector(".product-content-right-product-bottom-content-center-chitiet").style.display = "none"         
        })
    }
const buttonHidden=document.querySelector(".product-content-right-product-bottom-top")
if (buttonHidden) {
    buttonHidden.addEventListener("click",function() {
        document.querySelector(".product-content-right-product-bottom-content-big").classList.toggle("active2")
    })
}

