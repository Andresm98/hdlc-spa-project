const state = () => ({
    allResume: null,
    resume: {
        comm_name_resume: null,
        comm_annexed_resume: null,
        comm_observation_resume: null,
        comm_date_resume: null,
    },
});

const getters = {
    getAllResume: (state) => {
        return state.allResume;
    },
};

const mutations = {
    addResume(state, payload) {
        state.allResume = payload;
    },
};

const actions = {
    updateResume(context, payload) {
        context.commit("addResume", payload);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};
