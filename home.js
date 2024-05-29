
document.getElementById('logo').addEventListener("click",function(){
  window.location.href= 'index.php';
}
);



  const banners = document.querySelectorAll(".banner");
  let currentBannerIndex = 0;

  function showBanner(index) {
    banners.forEach((banner, idx) => {
      if(idx=== index) {
        banner.classList.add('active');
      }else{
        banner.classList.remove('active');
      }
    });
  }

  function nextBanner(){
    currentBannerIndex++;
    if(currentBannerIndex >=banners.length) {
      currentBannerIndex = 0;
    }
    showBanner(currentBannerIndex);
  }

  setInterval(nextBanner, 3000); // Change slide every 3 seconds









// Add event listener for form submission
// loginForm.addEventListener('submit', function(event) {
//     event.preventDefault();

//     var formEmail = document.getElementById('email').value;
//     var formPass = document.getElementById('password').value;

//     if (formEmail === '' || formPass === '') {
//         alert('One or more fields are empty');
//     } else if (formPass === 'your_password') {
//         closeModal();
//         redirectToHome();
//     } else {
//         alert('Invalid credentials');
//     }
// });

// Function to close the modal

// Function to redirect to home.php
function redirectToHome() {
    window.location.href = '/index.php';
}

