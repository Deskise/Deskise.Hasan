<template>
  <div class="dash-dailog" >
    <div class="dash-dailog-box">
      <div class="icon">
        <img src="@/assets/images/sheild.png" />
      </div>
      <div v-show="!sent" class="p-0 m-0 w-100">
        <div class="title">Withdraw Request</div>
          <p class="description">Set the amount to withdraw</p>
          <!-- <p>{{ this.$store.state.user.data.firstname }}</p>
          <p>{{ this.$store.state.user.data.email }}</p> -->
          <form @submit.prevent="" class="dash-form">
            <div class="form-container">
              <label class="form-item" for="Amount">Withdraw Amount:</label>
              <input v-model="amount" class="form-item" type="number" placeholder="Amount" />
              <span class="form-item">
                <font-awesome-component
                icon="dollar-sign"
                :bold="false"
                ></font-awesome-component>
              </span>
              <p class="my-auto notes" :class="{ 'red': overLimit }">Maximum: {{this.withdrawLimit}}$</p>
            </div>
            <button @click="withdraw" type="submit" class="pelorous" :class="{ 'disabled': overLimit }" :disabled="overLimit">Send</button>
            <button @click="back" class="close">Cancel</button>
          </form>
      </div>
      <div v-show="sent">
        <p :class="{ 'red': overLimit }">{{ this.message }}</p>
        <button @click="success" type="submit" class="pelorous mt-4">OK</button>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  data() {
    return {
      sent: false,
      amount: 0,
      withdrawLimit: null,
      message: 'Your withdraw request was sent successfully'
    }
  },

  methods: {
    back() {
      this.$router.go(-1)
    },
      async withdraw() {
      const user = {
        firstName: this.$store.state.user.data.firstname,
        lastName: this.$store.state.user.data.lastname,
        userEmail: this.$store.state.user.data.email,
        amount: this.amount,
      }
      await this.$store.dispatch('payment/createConnectedAccount', user).then((result) => {
        console.log(result);
        const res = this.$store.state.payment.accountLink
        if (res === 0) {
          this.sent = true
        }
        else if (res === 'x') {
          this.message = 'The Requested Withdraw Amount is Greater than the Limit'
          this.sent = true
        } else {
          window.location.href = this.$store.state.payment.accountLink
        }
      }).catch((err) => {
        console.log(err);
      });
    },

    success() {
      this.$router.go(-1);
    },

  },

  computed: {
    overLimit() {
      return this.amount > this.withdrawLimit;
    }
  },

  async created() {
    await this.$store.dispatch('payment/getWithdrawLimit').then((e) => {
      this.withdrawLimit = this.$store.state.payment.withdrawLimit
      console.log(e);
    })
  }

}
</script>

<style scoped>
.close {
  color: #a9a9a9;
  background: none;
  border: none;
  border-bottom: #dc3545 solid 2px;
  margin-top: 15px;
  padding: 2px 20px;
}
.close:hover {
  color: #dc3545;
}
.disabled {
  background-color: #c9c9c9;
  cursor: pointer;
  opacity: 0.5;
  pointer-events: none;
}
.red {
  color: tomato !important;
}
.form-container {
  display: flex;
  align-items: center;
  gap: 15px;
  border-top: #ededed 1px solid;
  padding-block: 25px;
}
  .slide-fade-enter-active {
      transition: all .3s ease;
  }
  .slide-fade-leave-active {
      display: none;
      transition: all .4s cubic-bezier(1.0, 0.5, 0.8, 1.0);
  }
  .slide-fade-enter, .slide-fade-leave-to {
      transform: translateX(10px);
      opacity: 0;
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
  padding: 40px 60px;
  min-width: 750px;
  max-width: 75%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
}

.dash-dailog .dash-dailog-box>*:not(:last-child),
.dash-form>*:not(:last-child) {
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
.dash-dailog .notes {
  font-size: 0.85rem;
  color: #c9c9c9;
  text-align: left;
}

.dash-dailog .dash-form {
  width: 100%;
}

.dash-form textarea,
.dash-form input,
.dash-form select {
  color: rgba(157, 157, 157);
  padding: 8px 20px;
  border: 1px solid rgba(157, 157, 157, 23%);
  border-radius: 5px;
  display: block;
  /* width: 50%; */
  font-size: 1rem;
}

.dash-form textarea {
  min-height: 100px;
}

.dash-form button[type="submit"],
.dash-form input[type="submit"] {
  width: 100%;
  padding: 16px;
  border-radius: 5px;
  background-color: #4e1b56;
  color: #fff;
  font-size: 1.1rem;
  font-weight: bold;
  cursor: pointer;
  border: none;
}

.dash-form button[type="submit"].pelorous,
.dash-form input[type="submit"].pelorous {
  background-color: #3eadb7;
}
.dash-form button[type="submit"].pelorous:hover {
  background-color: #4e1b56;
}
.pelorous{
  width: 70%;
  background-color: #3eadb7;
  padding: 16px;
  /* margin-block: 20px; */
  color: #fff;
  border-radius: 5px;
  font-size: 1.1rem;
  font-weight: bold;
  cursor: pointer;
  border: none;
}
.pelorous:hover{
  background-color: #4e1b56;
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
}</style>
