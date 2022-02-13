import axios from "axios";

const state = () => ({
    count: null,
    profile: {
        id: null,
        identity_card: null,
        date_birth: null,
        date_vocation: null,
        date_admission: null,
        date_send: null,
        date_vote: null,
        cellphone: null,
        phone: null,
        observation: null,
        user_id: null,
        address: {
            address: null,
            political_division_id: null,
        },
        political_division_id: null,
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
            date_birth,
            date_vocation,
            date_admission,
            date_send,
            date_vote,
            cellphone,
            phone,
            observation,
            political_division_id,
            address,
        }
    ) {
        state.profile.identity_card = identity_card;
        state.profile.date_birth = date_birth;
        state.profile.date_vocation = date_vocation;
        state.profile.date_admission = date_admission;
        state.profile.date_send = date_send;
        state.profile.date_vote = date_vote;
        state.profile.cellphone = cellphone;
        state.profile.phone = phone;
        state.profile.observation = observation;
        state.profile.address = address;
        state.profile.political_division_id = political_division_id;
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
