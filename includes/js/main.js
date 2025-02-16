let send_freind_request_class = document.querySelectorAll(`.send-freind-request-class`)
let remove_freind_request_class=document.querySelectorAll(`.remove-freind-request-class`)

// ####################### send freind request ##################################

send_freind_request_class.forEach(function(e) {
  e.onclick = function() {
    let potintial_freind_id = parseInt(e.previousElementSibling.innerHTML)

    let send_freind_request =  new XMLHttpRequest();

    send_freind_request.open("post", "", true);

    send_freind_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
    send_freind_request.send(`potintial_friend_id=${potintial_freind_id}`);


    e.classList.toggle(`add-icon`)
    e.classList.toggle(`check-mark`)
    e.classList.toggle(`remove-freind-request-class`)
    e.classList.toggle(`send-freind-request-class`)
   

  };
});


// ####################### unsend freind request ##################################


remove_freind_request_class.forEach(function(e) {
  e.onclick = function() {
    let removabl_freind_id = parseInt(e.previousElementSibling.innerHTML)

    let remove_freind_request =  new XMLHttpRequest();

    remove_freind_request.open("post", "", true);

    remove_freind_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
    remove_freind_request.send(`remove_friend_id=${removabl_freind_id}`);


    e.classList.toggle(`add-icon`)
    e.classList.toggle(`check-mark`)
    e.classList.toggle(`remove-freind-request-class`)
    e.classList.toggle(`send-freind-request-class`)
   

  };
});


// ############################ accepte friend request ###########################################

let accepte_the_request = document.querySelectorAll(`.accepte-the-request`)

accepte_the_request.forEach(function(e) {
  e.onclick = function() { 

    let friend_will_be_add_id =  parseInt(e.previousElementSibling.innerHTML)

    console.log(friend_will_be_add_id)
    
    let accepte_the_request2 =  new XMLHttpRequest();

    accepte_the_request2.open("post", "", true);

    accepte_the_request2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
    accepte_the_request2.send(`accepte-the-friend-request=${friend_will_be_add_id}`);


    e.parentElement.remove()

  } } )
  
  
  // ############################ refuse friend request ###########################################
  
  let refuse_the_request = document.querySelectorAll(`.refuse-the-request`)
  
  refuse_the_request.forEach(function(e) {
    e.onclick = function() { 
      let friend_will_be_refused_id =  parseInt(e.previousElementSibling.previousElementSibling.innerHTML)

    
    let refuse_the_request2 =  new XMLHttpRequest();

    refuse_the_request2.open("post", "", true);

    refuse_the_request2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
    refuse_the_request2.send(`refuse-the-friend-request=${friend_will_be_refused_id}`);

    e.parentElement.remove()


    } } )

//  ################# delete my account ####################

oo.addEventListener("click" , function() {
  var xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
    

    }
  }
  

  xhr.open("post", "", true);

  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.send("delete=true");
  
  // window.location.href = 'deletuser.php'

}) 


var pay=document.querySelector(`#pay`)

var card_info=document.querySelector(`#card_info`)

var cancel_payment=document.querySelector(`#cancel_payment`)

pay.onclick= function(){
card_info.classList.toggle(`hidden`)}

cancel_payment.onclick= function(){
  card_info.classList.toggle(`hidden`)}




// ######################### web socket ########################

// var socket = new WebSocket("ws://localhost:8080");

// socket.onopen = function(event) {
//     console.log("Connection opened");
//     socket.send("Hello Server!");
// };

// socket.onmessage = function(event) {
//     console.log("Received message: " + event.data);
// };

// socket.onclose = function(event) {
//     console.log("Connection closed");
// };

// socket.onerror = function(error) {
//     console.log("Error: " + error);
// };




let conn = new WebSocket('ws://127.0.0.1:8484');
conn.onopen = function(e) {
    console.log("Connection established!");
};
conn.onmessage = function(e) {
    console.log(e.data);
};

console.log("ارتفاع الشاشة الفعلي: " + window.innerHeight + " بكسل");
console.log("ارتفاع الشاشة الفعلي: " + window.innerWidth + " بكسل");

