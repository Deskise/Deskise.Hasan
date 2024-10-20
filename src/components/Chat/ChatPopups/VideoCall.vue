<template>
  <div class="dash-dailog">
    <div class="dash-dailog-box video-call-box">
      <div class="video-call">
        <div class="screen">
          <div class="reciver-avatar">
            <img src="@/assets/images/reciver-call-avatar.png" />
          </div>
          <div class="contact-info">
            <div class="name">Hilda Hansen</div>
            <div class="status">Call you</div>
            <div class="time">01:02:00</div>
          </div>
        </div>
        <div class="call-actions">
          <button class="close"><i class="fa fa-times"></i></button>
          <button class="mute"><i class="fa fa-microphone-slash"></i></button>
          <button class="video"><i class="fa fa-video"></i></button>
        </div>
        <div class="sender-avatar">
          <img src="@/assets/images/sender-call-avatar.png" />
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
.dash-dailog {
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  background-color: rgba(201, 201, 201, 20%);
  z-index: 100;
  display: flex;
  justify-content: center;
  align-items: center;
}

.dash-dailog .dash-dailog-box {
  background: #fff;
  border-radius: 20px;
  padding: 50px 70px;
  min-width: 750px;
  max-width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
}
.dash-dailog .dash-dailog-box > *:not(:last-child),
.dash-form > *:not(:last-child) {
  margin-bottom: 15px;
}

.dash-dailog .icon {
  max-width: 70px;
}
.dash-dailog .icon img {
  max-width: 100%;
  display: block;
  margin: auto;
}

.dash-dailog .title {
  font-size: 28px;
  color: #040506;
  font-weight: bold;
}
.dash-dailog .description {
  font-size: 24px;
  color: #c9c9c9;
  text-align: center;
}

.dash-dailog .description.thanks {
  max-width: 420px;
}

.dash-dailog .dash-form {
  width: 100%;
}

.dash-form textarea,
.dash-form input,
.dash-form select {
  color: rgba(157, 157, 157, 23%);
  padding: 14px 30px;
  border: 1px solid rgba(157, 157, 157, 23%);
  border-radius: 5px;
  display: block;
  width: 100%;
  font-size: 20px;
}
.dash-form textarea {
  min-height: 160px;
}

.dash-form button[type="submit"],
.dash-form input[type="submit"] {
  width: 100%;
  padding: 16px;
  border-radius: 5px;
  background-color: #4e1b56;
  color: #fff;
  font-size: 20px;
  font-weight: bold;
  cursor: pointer;
  border: none;
}

button.files-uploader {
  width: 100%;
  padding: 16px;
  border-radius: 5px;
  background-color: rgba(201, 201, 201, 23%);
  cursor: pointer;
  border: none;
}
button.files-uploader img {
  width: 24px;
}

.dash-form button[type="submit"].pelorous,
.dash-form input[type="submit"].pelorous {
  background-color: #3eadb7;
}

.dailog-buttons-actions {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 15px;
  width: 100%;
  flex-wrap: wrap;
}
.dailog-buttons-actions button {
  padding: 15px;
  text-align: center;
  border-radius: 5px;
  font-size: 20px;
  font-weight: bold;
  color: #fff;
  border: none;
  width: calc(50% - (15px / 2));
  flex-grow: 1;
}
.dailog-buttons-actions button.ending {
  background-color: #fb5b5b;
}

.dailog-buttons-actions button.back-conversation {
  background-color: #3eadb7;
}

@media (max-width: 800px) {
  .dash-dailog .dash-dailog-box {
    min-width: calc(100% - 20px);
    padding: 40px 10px;
  }

  .dash-dailog .title {
    font-size: 22px;
  }

  .dash-dailog .description,
  .dash-form textarea,
  .dash-form input,
  .dash-form select {
    font-size: 18px;
  }
}

@media (max-width: 500px) {
  .dash-dailog .icon {
    max-width: 50px;
  }

  .dailog-buttons-actions button {
    width: 100%;
  }
}

.dash-dailog .dash-dailog-box.voice-call-box {
  min-width: auto;
}

.dash-dailog .voice-call {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  font-size: 18px;
}
.dash-dailog .voice-call .avatar {
  max-width: 136px;
}

.dash-dailog .voice-call img {
  max-width: 100%;
  margin: auto;
}

.dash-dailog .voice-call > *:not(:last-child) {
  margin-bottom: 15px;
}

.dash-dailog .voice-call .contact {
  color: #101b4f;
}

.dash-dailog .voice-call .time,
.dash-dailog .voice-call .status {
  color: #3eadb7;
}
.dash-dailog .call-actions {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 18px;
}
.dash-dailog .call-actions button {
  text-align: center;
  width: 35px;
  height: 35px;
  line-height: 35px;
  color: #fff;
  overflow: hidden;
  border-radius: 50%;
  border: none;
  cursor: pointer;
  font-size: 18px;
}

.dash-dailog .call-actions button.close {
  background-color: #fb5b5b;
}
.dash-dailog .call-actions button.mute,
.dash-dailog .call-actions button.video {
  background-color: #e590b5;
}

.dash-dailog .video-call .screen {
  position: relative;
  margin-bottom: 15px;
}
.dash-dailog .video-call .reciver-avatar {
  max-width: 100%;
}

.dash-dailog .video-call .reciver-avatar img,
.dash-dailog .video-call .sender-avatar img {
  max-width: 100%;
  display: block;
  margin: auto;
}

.dash-dailog .video-call .contact-info {
  font-size: 18px;
  color: #fff;
  position: absolute;
  top: 20px;
  left: 20px;
  z-index: 1;
  text-align: left;
}

.dash-dailog .video-call-box {
  position: relative;
}
.dash-dailog .video-call-box .sender-avatar {
  position: absolute;
  width: 270px;
  height: 200px;
  border: 3px solid #fff;
  border-radius: 5px;
  bottom: 20px;
  right: 20px;
  z-index: 1;
  background-color: #fff;
}

@media (max-width: 750px) {
  .dash-dailog .video-call-box .sender-avatar {
    bottom: initial;
    top: 20px;
  }
}

@media (max-width: 550px) {
  .dash-dailog .video-call-box .sender-avatar {
    width: 120px;
    height: 120px;
  }
}
</style>
