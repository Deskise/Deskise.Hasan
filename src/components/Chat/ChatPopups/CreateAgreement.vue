<template>
  <div class="dash-dailog">
    <div class="dash-dailog-box">
      <div class="icon">
        <img src="@/assets/images/sheild.png" />
      </div>
      <div class="title">Create An Agreement</div>
      <p class="description">Write Down The Agreement And All The Details</p>
      <form class="dash-form">
        <textarea placeholder="Agreement Details"></textarea>
        <input placeholder="Price" />
        <input placeholder="The type of files to be delivered" />
        <textarea placeholder="Notes"></textarea>
        <button type="submit" class="pelorous">Send</button>
      </form>
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
