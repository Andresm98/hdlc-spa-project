const state = () => ({
    allSacrament: null,
    sacrament: {
        sacrament_name: "",
        sacrament_date: "",
        observation: "",
    },
});

const getters = {
    getAllSacrament: (state) => {
        return state.allSacrament;
    },
};

const mutations = {
    addSacrament(state, payload) {
        state.allSacrament = payload;
    },
};

const actions = {
    updateAllSacrament(context, payload) {
        context.commit("addSacrament", payload);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};
