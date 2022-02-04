const state = () => ({
    address: null,
    politicaDivisionId: null,
    allProvinces: null,
    allCantons: null,
    allParishes: null,
    provinces: {
        id: "",
        name: null,
        level: null,
        lastLevel: null,
    },
    cantons: {
        id: "",
        name: null,
        level: null,
        lastLevel: null,
    },
    parishes: {
        id: "",
        name: null,
        level: null,
        lastLevel: null,
    },
});
const getters = {};
const mutations = {
    addProvinces(state, payload) {
        state.allProvinces = payload;
    },
};
const actions = {
    uploadProvinces(context, payload) {
        context.commit("addProvinces", payload);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
