import { initializeApp } from "firebase/app";
import { getDatabase } from "firebase/database";
import { ref as storageRef, set } from "@firebase/database";
import ChatMessage from "../Api/ChatMessage";


const config = {
  apiKey: "AIzaSyBCBM1lCyKKCoIvZChHVQAjZfPb2uWnghI",
  authDomain: "vuechat-e0d6e.firebaseapp.com",
  databaseURL: "https://vuechat-e0d6e-default-rtdb.europe-west1.firebasedatabase.app",
  projectId: "vuechat-e0d6e",
  storageBucket: "vuechat-e0d6e.appspot.com",
  messagingSenderId: "171803552799",
  appId: "1:171803552799:web:8a2dc1d80dbfee5262392a"
}
const chat = initializeApp(config);
const db = getDatabase(chat);
// const msgs = storageRef(db, 'messages/user3/messages')

const sendMsg1 = () => {
  console.log('btn sendMsg1 clicked');
  const data = {
    "id": 7,
    "chat_id": 9,
    "from": 2,
    "message": "this sent from db.js file..",
    "attachments": ["soura.png", "picture.png", "default.png"],
    "read": true,
    "created_at": "2022-05-28T04:21:47.000000Z",
    "type": 'message'
  }
  const msgs = storageRef(db, 'messages/user4/messages')
  set(msgs, data);
  ChatMessage.push(data);
}
export default {db, sendMsg1} ;