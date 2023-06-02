<template>
  <div class="dash-dailog">
    <div class="dash-dailog-box">
      <div class="icon">
        <img src="@/assets/images/sheild.png" />
      </div>
      <div class="title">Send All Files</div>
      <p class="description">Lorem Ipsum Dolor Sit Amet, Consetetur</p>
      <form class="dash-form">
        <textarea placeholder="Notes"></textarea>
        <textarea placeholder="Emails,Passwords, And Written Files"></textarea>
        <div class="files-list">
          <div v-for="(file, index) in files" :key="index" class="file">
            <button class="remove-file">X</button>
            <!-- <flat-icon-component
              icon="file"
              type="bold"
            /> -->
            <p class="file-name">{{file.name}}</p>
          </div>
        </div>
        
        <button type="button" class="files-uploader"
          @click="() => $el.querySelector('input[type=file]').click()"
        >
          <input @change="uploadFile" type="file" name="upload-files" hidden multiple>
          <img src="@/assets/images/fi-rr-cloud-upload.png" />
        </button>
        <button type="submit" class="pelorous">Send</button>
      </form>
    </div>
  </div>
</template>

<script>

export default {
data() {
  return {
    files: []
  };
},

methods:{
  uploadFile(e) {
    console.log('upload', e);
    const selectedFiles = Array.from(e.target.files);
      selectedFiles.forEach((file) => {
        this.files.push(file);
      });
  }
}
}
</script>

<style scoped>
.files-list{
  display: flex;
  align-items: baseline;
}
.file{
  /* display: flex; */
  display: inline-block;
  align-items: center;
  justify-content: space-between;
  background: #ebebeb;
  border-radius: 10px;
  padding-inline: 8px;
  height: min-content;
  margin-left: 5px;
}
.remove-file{
  color: #c9c9c9;
  font-size: bold;
  border: none;
  background: rgb(239, 37, 37);
  border-radius: 50%;
  width: 22px;
  height: 22px;
  margin-top: 5px;
}
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
  max-width: 75%;
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
  max-width: 75%;
  display: block;
  margin: auto;
}

.dash-dailog .title {
  font-size: 1.3rem;
  color: #040506;
  font-weight: bold;
}
.dash-dailog .description {
  font-size: 1.1rem;
  color: #c9c9c9;
  text-align: center;
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
  font-size: 1rem;
}
.dash-form textarea {
  min-height: 2.1rem;
}

.dash-form button[type="submit"],
.dash-form input[type="submit"] {
  width: 100%;
  padding: 12px;
  border-radius: 5px;
  background-color: #4e1b56;
  color: #fff;
  font-size: 1.1rem;
  font-weight: bold;
  cursor: pointer;
  border: none;
}

button.files-uploader {
  width: 100%;
  padding: 12px;
  border-radius: 5px;
  background-color: rgba(201, 201, 201, 23%);
  cursor: pointer;
  border: none;
  font-size: 1.1rem;
}
button.files-uploader img {
  width: 24px;
}

.dash-form button[type="submit"].pelorous,
.dash-form input[type="submit"].pelorous {
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

  .dash-dailog .icon {
    max-width: 50px;
  }
}
</style>
