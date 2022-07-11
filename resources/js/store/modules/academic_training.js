const state = () => ({
    allAcademic: null,
    academic: {
        name_title: "",
        institution: "",
        date_title: "",
        observation: "",
    },
});

const getters = {
    getAllAcademic: (state) => {
        return state.allAcademic;
    },
};

const mutations = {
    addAcademic(state, payload) {
        state.allAcademic = payload;
    },
};

const actions = {
    updateAllAcademic(context, payload) {
        context.commit("addAcademic", payload);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};
