import Affiliate from "@/config/Services/AffiliateServices.js";
export const namespaced = true;

export const state = {
    affiliate: [],
    affiliateData: []
}

export const mutations = {

    SAVE(state, res) {
        state.affiliate = res
    },

    AFFILIATE_DATA(state, data) {
        state.affiliateData = data
    }
}

export const actions = {

    async save({commit}, data) {
        console.log('from model', data);
        await Affiliate.save(data).then((e) => {
            commit("SAVE", e.data.response)
        })
    },

    async getAffiliats({commit}) {
        await Affiliate.getAffiliats().then((e)=> {
            commit("AFFILIATE_DATA", e.data.response.extra[0])
        })
    },

    async toggle() {
        await Affiliate.toggle()
    }

}