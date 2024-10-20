import Affiliate from "@/config/Services/AffiliateServices.js";
export const namespaced = true;

export const state = {
    affiliate: [],
    affiliateData: [],
    affiliateInfo: [],
    earnings: [],
    myAffiliates: []
}

export const mutations = {

    SAVE(state, res) {
        state.affiliate = res
    },

    AFFILIATE_DATA(state, data) {
        state.affiliateData = data[0]
        state.affiliateInfo = data[1]
        state.earnings = data[2]
        state.myAffiliates = data[3]
    },
    AFFILIATE_INFO(state, data) {
        state.affiliateInfo = data
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
            commit("AFFILIATE_DATA", e.data.response.extra)
            // commit("AFFILIATE_INFO", e.data.response.extra[1])
        })
    },

    async toggle() {
        await Affiliate.toggle()
    }

}