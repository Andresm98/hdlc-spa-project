import axios from "axios";

const state = () => ({
    count: null,
    profile: {
        id: null,
        identity_card: null,
        iess_card: null,
        driver_license: null,
        date_birth: null,
        date_vocation: null,
        date_admission: null,
        date_send: null,
        date_vote: null,
        date_death: null,
        date_retirement: null,
        cellphone: null,
        phone: null,
        observation: null,
        user_id: null,
        address: {
            address: null,
            political_division_id: null,
        }, address_bt: {
            address_bt: null,
            political_division_id_bt: null,
        },
        profile_books: null,
        page: null,
    },
});

const getters = {
    profileDaughter: (state) => {
        return state.profile;
    },

    actualCount: (state) => {
        return state.count;
    },
    // lastName(state, getters) {
    //     return state.user.fullName.replace(getters.firstName, "");
    // },
    // // prefixedName: (state, getters) => (prefix) => {
    // //     return state.user.fullName.replace(getters.firstName, "");
    // // },
    // prefixedName: (state, getters) => (prefix) => {
    //     return prefix + getters.lastName;
    // },
};

const mutations = {
    // setFirstName(state, newFullName) {
    //     state.user.fullName = newFullName;
    // },
    // changeName(state, payload) {
    //     state.user.id = payload.id;
    // },
    increment(state) {
        state.count = state.count + 12321;
    },
    changeUser(state, payload) {
        state.profile = payload;
    },
    changeUserId(state, payload) {
        state.profile = {};
        state.profile.user_id = payload;
    },
    updateProfile(
        state,
        {
            identity_card,
            iess_card,
            driver_license,
            date_birth,
            date_vocation,
            date_admission,
            date_send,
            date_vote,
            date_death,
            date_retirement,
            cellphone,
            phone,
            observation,
            address,
            address_bt,
            profile_books,
            page
        }
    ) {
        state.profile.identity_card = identity_card;
        state.profile.iess_card = iess_card;
        state.profile.driver_license = driver_license;
        state.profile.date_birth = date_birth;
        state.profile.date_vocation = date_vocation;
        state.profile.date_admission = date_admission;
        state.profile.date_send = date_send;
        state.profile.date_vote = date_vote;
        state.profile.date_death = date_death;
        state.profile.date_retirement = date_retirement;
        state.profile.cellphone = cellphone;
        state.profile.phone = phone;
        state.profile.observation = observation;
        state.profile.address = address;
        state.profile.address_bt = address_bt;
        state.profile.profile_books = profile_books;
        state.profile.page = page;
    },
};
const actions = {
    increment(context) {
        context.commit("increment");
    },
    changeUser(context, payload) {
        // setTimeout(() => {
        context.commit("changeUser", payload);
        // }, 2000);
    },

    changeUserId(context, payload) {
        context.commit("changeUserId", payload);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
