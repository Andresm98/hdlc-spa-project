const state = () => ({
    infofamily: {
        names_father: "",
        names_mother: "",
        nr_sisters: "",
        nr_brothers: "",
        place_of_family: "",
    },
    infofamilybreak: {
        name_family_member: "",
        relation: "",
        cellphone: "",
        phone: "",
    },
});

const getters = {
    getInfoFamily: (state) => {
        return state.infofamily;
    },
    getInfoFamilyBreak: (state) => {
        return state.infofamilybreak;
    },
};

const mutations = {
    addInfoFamily(state, payload) {
        state.infofamily = payload;
        state.getInfoFamily = payload;
    },
    addInfoFamilyBreak(state, payload) {
        state.infofamilybreak = payload;
        state.getInfoFamilyBreak = payload;
    },
};

const actions = {
    updateInfoFamily(context, payload) {
        context.commit("addInfoFamily", payload);
    },
    updateInfoFamilyBreak(context, payload) {
        context.commit("addInfoFamilyBreak", payload);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};
