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

    if(baoquan){
        baoquan.addEventListener("click",function () {
            document.querySelector(".product-content-right-product-bottom-content-center-chitiet").style.display = "none"         
            document.querySelector(".product-content-right-product-bottom-content-center-baoquan").style.display = "block"
          
        })
    } if (chitiet) {
        chitiet.addEventListener("click",function () {
            document.querySelector(".product-content-right-product-bottom-content-center-chitiet").style.display = "block"
            document.querySelector(".product-content-right-product-bottom-content-center-baoquan").style.display = "none" 
                 
        })
    }
    
const buttonHidden=document.querySelector(".product-content-right-product-bottom-top")
if (buttonHidden) {
    buttonHidden.addEventListener("click",function() {
        document.querySelector(".product-content-right-product-bottom-content-big").classList.toggle("active2")
    })
}

// chat bot 
class Chatbox {
    constructor() {
        this.args = {
            openButton: document.querySelector('.chatbox__button'),
            chatBox: document.querySelector('.chatbox__support'),
            sendButton: document.querySelector('.send__button')
        }

        this.state = false;
        this.messages = [];
    }

    display() {
        const {openButton, chatBox, sendButton} = this.args;

        openButton.addEventListener('click', () =>{ this.toggleState(chatBox)})

        sendButton.addEventListener('click', () => {this.onSendButton(chatBox)})

        const node = chatBox.querySelector('input');
        node.addEventListener("keyup", ({key}) => {
            if (key === "Enter") {
                this.onSendButton(chatBox)
            }
        })
    }

    toggleState(chatbox) {
        this.state = !this.state;

        // show or hides the box
        if(this.state) {
            chatbox.classList.add('chatbox--active')
        } else {
            chatbox.classList.remove('chatbox--active')
        }
    }

    onSendButton(chatbox) {
        var textField = chatbox.querySelector('input');
        let text1 = textField.value
        if (text1 === "") {
            return;
        }

        let msg1 = { name: "User", message: text1 }
        this.messages.push(msg1);

        fetch('http://127.0.0.1:5000/predict', {
            method: 'POST',
            body: JSON.stringify({ message: text1 }),
            mode: 'cors',
            headers: {
              'Content-Type': 'application/json'
            },
          })
          .then(r => r.json())
          .then(r => {
            let msg2 = { name: "Sam", message: r.answer };
            this.messages.push(msg2);
            this.updateChatText(chatbox)
            textField.value = ''

        }).catch((error) => {
            console.error('Error:', error);
            this.updateChatText(chatbox)
            textField.value = ''
          });
    }

    updateChatText(chatbox) {
        var html = '';
        this.messages.slice().reverse().forEach(function(item, index) {
            if (item.name === "Sam")
            {
                html += '<div class="messages__item messages__item--visitor">' + item.message + '</div>'
            }
            else
            {
                html += '<div class="messages__item messages__item--operator">' + item.message + '</div>'
            }
          });

        const chatmessage = chatbox.querySelector('.chatbox__messages');
        chatmessage.innerHTML = html;
    }
}


const chatbox = new Chatbox();
chatbox.display();