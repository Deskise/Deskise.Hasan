export const namespaced = true;

export const state = {
    data: null,
    //{
    //     id: null,
    //     firstname: null,
    //     lastname: null,
    //     bio: null,
    //     img: null,
    //     email: null,
    //     backup_email: null,
    //     phone: null,
    //     backup_phone: null,
    //     location: null,
    //     uuid: null,
    //     facebook_login: false,
    //     google_login: false,
    //     token: null,
    //     token_type: "Bearer",
    // }
};

export const mutations = {};

export const actions = {};

export const getters = {
    isLoggedIn: (state) => {
        return state.data === null ||
            typeof state.data !== "object" ||
            state.data.token === null
            ? false
            : true;
    },
};
