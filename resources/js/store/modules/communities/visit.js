const state = () => ({
    allVisit: null,
    visit: {
        comm_reason_visit: null,
        comm_type_visit: null,
        comm_description_visit: null,
        comm_date_init_visit: null,
        comm_date_end_visit: null,
    },
});

const getters = {
    getAllVisit: (state) => {
        return state.allResume;
    },
};

const mutations = {
    addVisit(state, payload) {
        state.allResume = payload;
    },
};

const actions = {
    updateAllVisit(context, payload) {
        context.commit("addVisit", payload);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};
