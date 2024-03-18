// js for toggling password visibility
function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    var toggleIcon = document.getElementById("togglePassword");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
    }
}

// script for user dashboard sliding carousel
//step 1: get DOM
let nextDom = document.getElementById('next');
let prevDom = document.getElementById('prev');

let carouselDom = document.querySelector('.carousel');
let SliderDom = carouselDom.querySelector('.carousel .list');
let thumbnailBorderDom = document.querySelector('.carousel .thumbnail');
let thumbnailItemsDom = thumbnailBorderDom.querySelectorAll('.item');
let timeDom = document.querySelector('.carousel .time');

thumbnailBorderDom.appendChild(thumbnailItemsDom[0]);
let timeRunning = 3000;
let timeAutoNext = 7000;

nextDom.onclick = function(){
    showSlider('next');
}

prevDom.onclick = function(){
    showSlider('prev');
}
let runTimeOut;
let runNextAuto = setTimeout(() => {
    next.click();
}, timeAutoNext)
function showSlider(type){
    let  SliderItemsDom = SliderDom.querySelectorAll('.carousel .list .item');
    let thumbnailItemsDom = document.querySelectorAll('.carousel .thumbnail .item');

    if(type === 'next'){
        SliderDom.appendChild(SliderItemsDom[0]);
        thumbnailBorderDom.appendChild(thumbnailItemsDom[0]);
        carouselDom.classList.add('next');
    }else{
        SliderDom.prepend(SliderItemsDom[SliderItemsDom.length - 1]);
        thumbnailBorderDom.prepend(thumbnailItemsDom[thumbnailItemsDom.length - 1]);
        carouselDom.classList.add('prev');
    }
    clearTimeout(runTimeOut);
    runTimeOut = setTimeout(() => {
        carouselDom.classList.remove('next');
        carouselDom.classList.remove('prev');
    }, timeRunning);

    clearTimeout(runNextAuto);
    runNextAuto = setTimeout(() => {
        next.click();
    }, timeAutoNext)
}

//script for the checkout page
function showLoadingSpinner() {
    // Get the phone number from the input field
    const phoneNumber = document.getElementById('phoneNumber').value;

    // Validate if the phone number is provided
    if (!phoneNumber) {
        alert("Please enter your phone number.");
        return;
    }

    // Disable the button to prevent multiple submissions
    document.querySelector('#bookModal button[type="button"]').disabled = true;

    // Hide the form and show the loading spinner
    document.getElementById('loadingSpinner').style.display = 'block';
    document.getElementById('bookingForm').style.display = 'none';

    // Simulate a loading delay (5 seconds)
    setTimeout(() => {
        // Hide the loading spinner and show the payment received message
        document.getElementById('loadingSpinner').style.display = 'none';
        document.getElementById('paymentReceivedMessage').style.display = 'block';

        // Set the phone number in a hidden input field
        const phoneNumberInput = document.createElement('input');
        phoneNumberInput.type = 'hidden';
        phoneNumberInput.name = 'phone_number';
        phoneNumberInput.value = phoneNumber;
        document.getElementById('bookingForm').appendChild(phoneNumberInput);

        // Simulate another delay (2 seconds) before submitting the form
        setTimeout(() => {
            // Manually submit the form
            document.getElementById('bookingForm').submit();
        }, 2000);
    }, 5000); // 5 seconds delay
}