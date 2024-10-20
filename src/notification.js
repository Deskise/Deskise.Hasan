
function sendNotification(message) {
    if (Notification.permission === "granted") {
      navigator.serviceWorker.ready.then(function(registration) {
        registration.showNotification(message);
      });
    }
  }
  
  export function requestPermission() {
    if ("Notification" in window) {
      Notification.requestPermission().then(permission => {
        if (permission === "granted") {
          console.log("Notification permission granted.");
        }
      });
    }
  }
  
  export default sendNotification;
  