const state = () => ({
    allPermit: null,
    permit: {
        reason: "",
        description: "",
        date_province: "",
        date_general: "",
        date_out: "",
        date_in: "",
    },
});

const getters = {
    getAllPermit: (state) => {
        return state.allPermit;
    },
};

const mutations = {
    addPermit(state, payload) {
        state.allPermit = payload;
    },
};

const actions = {
    updateAllPermit(context, payload) {
        context.commit("addPermit", payload);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};
