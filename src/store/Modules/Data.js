import about from "@/config/Services/Data/AboutService";
import terms from "@/config/Services/Data/TermsService";
import packageService from "@/config/Services/Data/PackagesService";
import faq from "@/config/Services/Data/FaqService";
import comments from "@/config/Services/Data/CommentsService";

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

  comments: [],

  faq: {},
  search: "",
};
//
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
  FETCH_COMMENTS(state, $comments) {
    state.comments = $comments;
  },
  searchFAQ(state, text) {
    state.search = text;
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
        let QUAS = response.data.response.extra[0];
        // ................................
        let quastions = JSON.parse(JSON.stringify(QUAS.data));
        let faqs = [];
        for (let i = 0; i < quastions.length; i++) {
          if (quastions[i].question.includes(state.search)) {
            faqs.push(quastions[i]);
          }
        }
        QUAS.data = faqs;
        //................................
        commit("FETCH_FAQ", QUAS);
      })
      .catch(() => {});
  },

  async comments({ commit }) {
    await comments
      .fetch()
      .then((response) => {
        let comments = response.data.response.extra;
        commit("FETCH_COMMENTS", comments);
      })
      .catch(() => {});
  },
};

export const getters = {};
