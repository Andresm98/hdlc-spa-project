const state = () => ({
    allWork: null,
    work: {
        comm_identity_card: null,
        comm_name: null,
        comm_level: null,
        comm_cellphone: null,
        comm_phone: null,
        comm_email: null,
        date_fndt_comm: null,
        date_fndt_work: null,
        rn_collaborators: null,
        address: null,
    },
});

const getters = {
    workInfo: (state) => {
        return state.work;
    },
    getAllWork: (state) => {
        return state.allWork;
    },
};

const mutations = {
    loadWork(state, payload) {
        state.date_fndt_work = payload;
    },
    addWork(state, payload) {
        state.allWork = payload;
    },
};

const actions = {
    changeWork(context, payload) {
        // setTimeout(() => {
        context.commit("loadWork", payload);
        // }, 2000);
    },
    updateAllWork(context, payload) {
        context.commit("addWork", payload);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
