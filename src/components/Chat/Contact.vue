<template>
  <div class="contacts">
    <span id="close-contacts"><i class="fa fa-times"></i></span>
    <div class="contacts-search">
      <div class="icon"><i class="fa fa-search"></i></div>
      <input placeholder="Search Message" />
    </div>
    <ul class="list-contacts">
      <li class="contact-item">
        <a href="javascript:void(0)" class="contanct">
          <div class="contact-image">
            <img src="@/assets/contact-image.png" />
          </div>
          <div class="contact-name-message">
            <div class="contact-name">Ricardo Lopez</div>
            <div class="contact-last-message">
              Three Ways To Get Travel Disco…
            </div>
          </div>
          <div class="contact-time-count">
            <div class="contact-last-messages-time">11:23 am</div>
            <div class="contact-last-messages-count">4</div>
          </div>
        </a>
      </li>
    </ul>
  </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
.contacts {
  max-width: 350px;
  padding: 20px;
  background-color: #fff;

  .contacts-search {
    position: relative;
    input {
      display: block;
      width: 100%;
      border: none;
      color: #9d9d9d;
      font-size: 12px;
      padding: 12px;
      padding-left: 24px;
      background-color: rgba(62, 173, 183, 0.05);
      border-radius: 4px;
    }
    .icon {
      color: #9d9d9d;
      font-size: 24px;
      position: absolute;
      top: calc(50% - 12px);
      left: 0px;
    }
  }

  .list-contacts {
    .contact-item {
      padding: 18px 0px;
      border-bottom: 1px solid rgba(16, 27, 79, 0.1);
      margin-bottom: 20px;
      a {
        display: flex;
        justify-content: space-between;
      }
      .contact-image {
        width: 40px;
        height: 40px;
        overflow: hidden;
        margin-right: 16px;
        img {
          border-radius: 50%;
          max-width: 100%;
          display: block;
          margin: auto;
        }
      }
      .contact-name {
        padding-top: 8px;
        font-size: 16px;
        color: #4e1b56;
        margin-bottom: 14px;
      }
      .contact-last-message {
        font-size: 12px;
        color: #9b9b9b;
      }
      .contact-time-count {
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
      }
      .contact-last-messages-time {
        font-size: 12px;
        color: #9d9d9d;
      }
      .contact-last-messages-count {
        width: 22px;
        height: 22px;
        line-height: 22px;
        background-color: #3eadb7;
        border-radius: 50%;
        color: #fff;
        text-align: center;
      }
    }
  }
}
</style>
