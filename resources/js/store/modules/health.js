const state = () => ({
    allHealth: null,
    health: {
        consult_date: "",
        actual_health: "",
        chronic_diseases: "",
        other_health_problems: "",
    },
});

const getters = {
    getAllHealth: (state) => {
        return state.allHealth;
    },
};

const mutations = {
    addHealth(state, payload) {
        state.allHealth = payload;
    },
};

const actions = {
    updateAllHealth(context, payload) {
        context.commit("addHealth", payload);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
