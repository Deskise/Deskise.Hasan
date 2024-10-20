
import firebase from './firebase';

const auth = firebase.auth();


export function signIn(email, password) {
  return auth.signInWithEmailAndPassword(email, password)
    .then((userCredential) => {
      const user = userCredential.user;
      console.log('User signed in:', user);
    })
    .catch((error) => {
      const errorCode = error.code;
      const errorMessage = error.message;
      console.error('Error signing in:', errorCode, errorMessage);
    });
}
