const state = () => ({
    allActivity: null,
    activity: {
        comm_name_activity: null,
        comm_description_activity: null,
        comm_date_activity: null,
        comm_nr_daughters: null,
        comm_nr_beneficiaries: null,
        comm_nr_collaborators: null,
    },
});

const getters = {
    getAllActivity: (state) => {
        return state.allActivity;
    },
};

const mutations = {
    addActivity(state, payload) {
        state.allActivity = payload;
    },
};

const actions = {
    updateAllActivity(context, payload) {
        context.commit("addActivity", payload);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};
