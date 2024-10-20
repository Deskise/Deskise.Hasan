
import firebase from 'firebase/app';
import 'firebase/messaging';

const firebaseConfig = {
    apiKey: "AIzaSyBP_J7gz-86qcjMKCVb5yLqB2LsmAMsdGE",
    authDomain: "veujs-151f0.firebaseapp.com",
    projectId: "veujs-151f0",
    storageBucket: "veujs-151f0.appspot.com",
    messagingSenderId: "302337432209",
    appId: "1:302337432209:web:98823b8e95d7789be3bd30",
    measurementId: "G-JQ3PEFESQ2"
};

firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

export const requestForToken = () => {
  return messaging.getToken({vapidKey: 'YOUR_VAPID_KEY'}).then((currentToken) => {
    if (currentToken) {
      console.log('current token for client: ', currentToken);
      // Perform any other necessary operations with the token
    } else {
      console.log('No registration token available. Request permission to generate one.');
    }
  }).catch((err) => {
    console.log('An error occurred while retrieving token. ', err);
  });
};

export const onMessageListener = () =>
  new Promise((resolve) => {
    messaging.onMessage((payload) => {
      resolve(payload);
    });
  });

export default firebase;
