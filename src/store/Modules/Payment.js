import Payment from "@/config/Services/PaymentServices.js";
export const namespaced = true;

export const state = {

  soldProduct: [],
  buyerId: null,
  intent: null,
  accountLink: null,
  withdrawLimit: null
}

export const mutations = {

  SAVE(state, data) {
    state.soldProduct = data
    state.buyerId = data.chat_id
  },
  INTENT(state, data) {
    state.intent = data
  },

  ACOUNT_LINK(state, data) {
    state.accountLink = data
  },

  WITHDRAW_LIMIT(state, data) {
    state.withdrawLimit = data
  }

}

export const actions = {

  async checkout({ commit }, data) {
    console.log(data);
    await Payment.checkout(data).then((e) => {
      commit("SAVE", e.data)
      console.log(e.data);
    })
  },

  async createIntent({commit}, data) {
    await Payment.createIntent(data).then((e) => {
      commit("INTENT", e.data)
    })
  },

  async confirm({ commit }) {
    await Payment.confirm().then((e) => {
      commit("INTENT", e.data)
    })
  },

  async createConnectedAccount({commit}, user) {
    await Payment.createConnectedAccount(user).then((e) => {
      commit('ACOUNT_LINK', e.data)
    })
  },

  async getWithdrawLimit({commit}) {
    await Payment.getWithdrawLimit().then((e) => {
      commit('WITHDRAW_LIMIT', e.data)
    })
  }

}