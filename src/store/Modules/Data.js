import about from "@/Services/Data/AboutService";
import terms from "@/Services/Data/TermsService";
import packageService from "@/Services/Data/PackagesService";
import faq from "@/Services/Data/FaqService";

export const namespaced = true;

export const state = {
  about: {
    page: null,
    home: null,
  },

  terms: {
    terms: null,
    privacy: null,
  },

  packages: [],

  faq: {},
};

export const mutations = {
  ABOUT(state, { $for, aboutText }) {
    state.about[$for] = aboutText;
  },
  TERM(state, { $for, termText }) {
    state.terms[$for] = termText;
  },
  FETCH_PACKAGES(state, $packages) {
    state.packages = $packages;
  },
  FETCH_FAQ(state, $faqs) {
    if (state.faq.data === undefined) {
      state.faq = $faqs;
    } else {
      state.faq.current_page = $faqs.current_page;
      state.faq.next_page_url = $faqs.next_page_url;
      state.faq.data.push(...$faqs.data);
    }
  },
};

export const actions = {
  async about({ commit }, $for) {
    let aboutText;
    await about.fetch($for).then((response) => {
      aboutText = response.data.response.extra[0].about;
      commit("ABOUT", {
        $for,
        aboutText,
      });
    });
    return aboutText;
  },

  async terms({ commit }, $for) {
    let termText;
    await terms.fetch($for).then((response) => {
      termText = response.data.response.extra[0].data;
      commit("TERM", {
        $for,
        termText,
      });
    });
    return termText;
  },

  async packages({ commit }) {
    await packageService
      .fetch()
      .then((response) => {
        let packages = response.data.response.extra;
        commit("FETCH_PACKAGES", packages);
      })
      .catch(() => {});
  },

  async faqs({ commit }, { page }) {
    await faq
      .fetch(page)
      .then((response) => {
        let faqs = response.data.response.extra[0];
        commit("FETCH_FAQ", faqs);
      })
      .catch(() => {});
  },
};

export const getters = {};
