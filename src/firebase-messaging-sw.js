
importScripts('https://www.gstatic.com/firebasejs/8.6.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.6.1/firebase-messaging.js');

firebase.initializeApp({
  apiKey: "AIzaSyBP_J7gz-86qcjMKCVb5yLqB2LsmAMsdGE",
  authDomain: "veujs-151f0.firebaseapp.com",
  projectId: "veujs-151f0",
  storageBucket: "veujs-151f0.appspot.com",
  messagingSenderId: "302337432209",
  appId: "1:302337432209:web:98823b8e95d7789be3bd30",
  measurementId: "G-JQ3PEFESQ2"
});

const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
  const notificationTitle = 'Background Message Title';
  const notificationOptions = {
    body: payload.data.status,
    icon: '/firebase-logo.png'
  };

  return self.registration.showNotification(notificationTitle, notificationOptions);
});
