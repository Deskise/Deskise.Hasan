import { initializeApp } from "firebase/app";
import { getDatabase } from "firebase/database";
// import { ref as storageRef, set } from "@firebase/database";
// import ChatMessage from "../Api/ChatMessage";


const chatApp = {
  apiKey: "AIzaSyBCBM1lCyKKCoIvZChHVQAjZfPb2uWnghI",
  authDomain: "vuechat-e0d6e.firebaseapp.com",
  databaseURL: "https://vuechat-e0d6e-default-rtdb.europe-west1.firebasedatabase.app",
  projectId: "vuechat-e0d6e",
  storageBucket: "vuechat-e0d6e.appspot.com",
  messagingSenderId: "171803552799",
  appId: "1:171803552799:web:8a2dc1d80dbfee5262392a"
}

// const msgs = storageRef(db, 'messages/user3/messages')

const notifications = {
  apiKey: "AIzaSyC8_pp1WJSTtYcYjoFrUi4c_6m8V9fRjCs",
  authDomain: "notifications-a4985.firebaseapp.com",
  databaseURL: "https://notifications-a4985-default-rtdb.firebaseio.com",
  projectId: "notifications-a4985",
  storageBucket: "notifications-a4985.appspot.com",
  messagingSenderId: "215769236601",
  appId: "1:215769236601:web:c565881735e796b63480a8"
};

const chat = initializeApp(chatApp, "chat");
const db = getDatabase(chat);

const app = initializeApp(notifications, "notificatins");
const notificatins = getDatabase(app);


export default {db, notificatins} ;